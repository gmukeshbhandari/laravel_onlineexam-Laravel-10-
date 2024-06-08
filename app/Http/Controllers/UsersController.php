<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Users;
use App\Models\SuperAdmin;
use App\Models\DeletedAccount;
use App\Models\VerifyUser;
use App\Models\Feedback;
use App\Models\Country;
use App\Models\Province;
use App\Models\District;
use App\Models\Village;
use App\Models\Ward;
use App\Models\LoginDetail;
use App\Models\ResetPasswords;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Validator;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ResetPasswordRequest;
use App\Http\Requests\AdminRegistrationRequest;
use App\Rules\CheckEmail;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Mail\VerifyEmail;
use Carbon\Carbon;
use App\Mail\ResetPassword;
use App\Rules\ResetPass;
use App\Rules\CurrentPassword;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cookie;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Check if user is already authenticated
        if (Auth::guard('customuser')->check())
        {
             // Get the currently authenticated user
            $user = Auth::guard('customuser')->user();
            $userinfo = Users::where('email',$user->email)->first();
            if ($userinfo)
            {
                $isVerified = $userinfo->Verified;
                if ($isVerified == 0)
                {
                    $errormsg =  "Please confirm Your account by clicking link send to your email.";
                    Auth::guard('customuser')->logout();
                    return redirect()->route('user_homepage')->with('errormsg',$errormsg);
                }
                else
                {
                    return redirect()->route('user_dashboard');
                }
            }
        }
        $u_email = Cookie::get('u_email');
        $u_password = Cookie::get('u_password');
        return view('users.userhome')->with(['u_email' => $u_email, 'u_password' => $u_password]);
    }

    public function checkLogin(Request $request)
    {
        if (Auth::guard('customuser')->check())
        {
            return redirect()->route('user_dashboard');
        }

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'password.required' => 'Password is required.',
        ]);

        //if (Auth::guard('customuser')->attempt(['email' => $request->input('email'),'password' => $request->input('password')], $request->has('rememberuserlogin')))
       if (Auth::guard('customuser')->attempt(['email' => $request->input('email'),'password' => $request->input('password'),]))
        {
            if($request->input('rememberuserlogin'))
            {
                Cookie::queue(Cookie::make('u_email', $request->input('email'), 46080)); //1 month = 46080 minute
                Cookie::queue(Cookie::make('u_password', $request->input('password'), 46080)); //1 month = 46080 minute
            }
            else
            {
                // setcookie('u_email',"");
                // setcookie('u_password',"");
                Cookie::queue(Cookie::forget('u_email'));
                Cookie::queue(Cookie::forget('u_password'));
            }
            $user = Auth::guard('customuser')->user();
            $isVerified = $user->Verified;

            if ($isVerified == 0)
            {
                $errormsg =  "Please confirm Your account by clicking link send to your email.";
                Auth::guard('customuser')->logout();
                return redirect()->route('user_homepage')->with('errormsg',$errormsg);
            }

            if ($isVerified == 1)
            {
                if($user->flag_en_dis == 0)
                {
                    $errormsg =  "Account Disabled. Contact Your Institute";
                    Auth::guard('customuser')->logout();
                    return redirect()->route('user_homepage')->with('errormsg',$errormsg);
                }
                else
                {
                    Users::where('email', Auth::guard('customuser')->user()->email)->update(['flag_one_device' => '1']);
                    $username = Users::where('email',Auth::guard('customuser')->user()->email)->value('user_username');
                    $logintype = 'Log In with Password';
                    $usertype = 'user';
                    $this->loginDetails($request, $username, $logintype, $usertype);
                    return redirect()->route('user_dashboard');
                }
            }
        }
        else
        {
            return back()->with('errormsg','Invalid Email or Password');
        }

    }

    public function register(Request $request)
    {
        if(Auth::guard('customuser')->check())
        {
            return redirect()->route('user_dashboard');
        }
        return view('users.userregister');
    }

    public function registerCheck(Request $request)
    {
        if (Auth::guard('customuser')->check())
        {
           return redirect()->route('user_dashboard');
        }

        $province_name = $request->input('province');
        $district_name = $request->input('district');
        $village_name = $request->input('village');

        $province_id = Province::where('Province',$province_name)->value('id');
        $district_id = District::where('province_id',$province_id)->where('District',$district_name)->value('id');
        $village_id = Village::where('district_id',$district_id)->where('Village', $village_name)->value('id');

        $custom_attributes = [
            'user_image' => 'image',
            'first_name' => 'first name',
            'last_name' => 'last name',
            'middle_name' => 'middle name',
            'email' => 'email',
            'username' => 'username',
            'institute_username' => 'Institute username',
            'gender' => 'gender',
            'password' => 'password',
            'confirmpassword' => 'confirm password',
            'country' => 'country',
            'province' => 'province',
            'district' => 'district',
            'village' => 'village',
            'ward_no' => 'ward',
            'street_address' => 'street address',
        ];

        $custom_messages = [
            'user_image.image' => 'The file must be an image file.',
            'user_image.size' => 'Image should be less than 2 MB.',
            'user_image.mimes' => 'The image must be of type: jpg, png, bmp.',
            'first_name.required' => 'What\'s your first name?',
            'first_name.alpha' => 'The name must only contain letters.',
            'first_name.max' => 'Your first name cannot be more than 50 character',
            'middle_name.alpha' => 'The name must only contain letters.',
            'middle_name.max' => 'Your middle name cannot be more than 50 character',
            'last_name.required' => 'What\'s your last name?',
            'last_name.alpha' => 'The name must only contain letters.',
            'last_name.max' => 'Your last name cannot be more than 50 character',
            'email.required' => 'Email address is required.',
            'email.email' => 'Invalid Email.',
            'email.max' => 'Oops! Your email address is too long. Please make sure it is no more than 200 characters.',
            'email.string' => 'Invalid Email.',
            'email.unique' => 'Email not available.',
            'username.required' => 'Choose a username!',
            'username.alpha_dash' => 'The username must only contain letters, numbers, dashes, and underscores.',
            'username.min' => 'Username must be between 3 to 30 characters.',
            'username.max' => 'Username must be between 3 to 30 characters.',
            'username.unique' => 'Username not available.',
            'institute_username.required' => 'Please enter your college username for registration.',
            'institute_username.exists' => 'This institute is not registered.',
            'gender.required' => 'Please specify your gender.',
            'gender.in' => 'Invalid Selection. Something went wrong.',
            'password.required' => 'For your account\'s security, a password is required.',
            'password.min' => 'Password must have minimum of 8 character',
            'password.max' => 'Password must not exceed 72 character.',
            'password.same' => 'The password and confirm password do not match.',
            'confirmpassword.required' => 'For your account\'s security, a password confirmation is required.',
            'confirmpassword.max' => 'Password must not exceed 72 character.',
            'country.required' => 'Let us know which country you\'re in.',
            'country.in' => 'Invalid Selection. Something went wrong.',
            'province.required_if' => 'For users in Nepal: Province information is required.',
            'province.in' => 'Invalid Selection. Something went wrong.',
            'district.required_if' => 'For users in Nepal: District information is required.',
            'district.in' => 'Invalid Selection. Something went wrong.',
            'village.required_if' => 'For users in Nepal: Village information is required.',
            'village.in' => 'Invalid Selection. Something went wrong.',
            'ward_no.required_if' => 'For users in Nepal: Ward information is required.',
            'ward_no.in' => 'Invalid Selection. Something went wrong.',
            'street_address.required_if' => 'For users in Nepal: Street Address is required.',
            'street_address.alpha_dash' => 'The address must only contain letters, numbers, dashes, and underscores.',
            'street_address.max' => 'Address must not exceed 60 character.',
        ];


            $validator = Validator::make($request->all(), [
            'user_image' => ['nullable','image','max:2048','mimes:jpg,jpeg,png,bmp'],
            'first_name' => ['required','alpha','max:50'],
            'middle_name' => ['nullable','alpha','max:50'],
            'last_name' => ['required','alpha','max:50'],
            'email' => ['required','email','max:200','string','unique:users,email','unique:admins,email','unique:super_admins,email'],
            'username' => ['required','alpha_dash','min:3','max:30','unique:users,user_username','unique:admins,institute_username','unique:deleted_accounts,username'],
            'institute_username' => ['required','exists:admins,institute_username'],
            'gender' => ['required', Rule::in(['Male', 'Female','Non-Binary','Prefer not to say'])],
            'password' => ['required','min:8','max:72','same:confirmpassword'],
            'confirmpassword' => ['required','max:72'],
            'country' => ['required', Rule::in(['Afghanistan','Aland Islands','Albania','Algeria','American Samoa','Andorra','Angola','Anguilla','Antarctica','Antigua and Barbuda','Argentina','Armenia','Aruba','Ascension Island','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bermuda','Bhutan','Bolivia','Bosnia and Herzegovina','Botswana','Bouvet Island','Brazil','British Indian Ocean Territory','British Virgin Islands','Brunei','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Canada','Canary Islands','Cape Verde','Caribbean Netherlands','Cayman Islands','Central African Republic','Ceuta and Melilla','Chad','Chile','China','Christmas Island','Clipperton Island','Cocos  Islands','Colombia','Comoros','Congo - Brazzaville','Congo - Kinshasa','Cook Islands','Costa Rica','Cote d\'Ivoire','Croatia','Cuba','Curacao','Cyprus','Czechia','Denmark','Diego Garcia','Djibouti','Dominica','Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Ethiopia','Falkland Islands','Faroe Islands','Fiji','Finland','France','French Guiana','French Polynesia','French Southern Territories','Gabon','Gambia','Georgia','Germany','Ghana','Gibraltar','Greece','Greenland','Grenada','Guadeloupe','Guam','Guatemala','Guernsey','Guinea','Guinea-Bissau','Guyana','Haiti','Heard and McDonald Islands','Honduras','Hong Kong','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Isle of Man','Israel','Italy','Jamaica','Japan','Jersey','Jordan','Kazakhstan','Kenya','Kiribati','Kosovo','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg','Macau','Macedonia','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Martinique','Mauritania','Mauritius','Mayotte','Mexico','Micronesia','Moldova','Monaco','Mongolia','Montenegro','Montserrat','Morocco','Mozambique','Myanmar (Burma)','Namibia','Nauru','Nepal','Netherlands','New Caledonia','New Zealand','Nicaragua','Niger','Nigeria','Niue','Norfolk Island','Northern Mariana Islands','North Korea','Norway','Oman','Pakistan','Palau','Palestine','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Pitcairn Islands','Poland','Portugal','Puerto Rico','Qatar','Reunion','Romania','Russia','Rwanda','Samoa','San Marino','Sao Tome and Principe','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Sint Maarten','Slovakia','Slovenia','Solomon Islands','Somalia','South Africa','South Georgia and South Sandwich Islands','South Korea','South Sudan','Spain','Sri Lanka','St. Barthelemy','St. Helena','St. Kitts and Nevis','St. Lucia','St. Martin','St. Pierre and Miquelon','St. Vincent and Grenadines','Sudan','Suriname','Svalbard and Jan Mayen','Swaziland','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Timor-Leste','Togo','Tokelau','Tonga','Trinidad and Tobago','Tristan da Cunha','Tunisia','Turkey','Turkmenistan','Turks and Caicos Islands','Tuvalu','U.S. Outlying Islands','U.S. Virgin Islands','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Vanuatu','Vatican City','Venezuela','Vietnam','Wallis and Futuna','Western Sahara','Yemen','Zambia','Zimbabwe'])],
            // 'province' => ['required_if:country,Nepal', Rule::in(['Koshi','Madhesh','Bagmati','Gandaki','Lumbini','Karnali','Sudhurpaschim'])],
            // 'district'  => ['required_if:country,Nepal', Rule::in(['Bhojpur','Dhankuta','Ilam','Jhapa','Khotang','Morang','Okhaldhunga','Panchthar','Sankhuwasabha','Solukhumbu','Sunsari','Taplejung','Terhathum','Udayapur','Bara','Dhanusa','Mahottari','Parsa','Rautahat','Saptari','Sarlahi','Siraha','Bhaktapur','Chitwan','Dhading','Dolakha','Kathmandu','Kavrepalanchok','Lalitpur','Makwanpur','Nuwakot','Ramechhap','Rasuwa','Sindhuli','Sindhupalchok','Baglung','Gorkha','Kaski','Lamjung','Manang','Mustang','Myagdi','Nawalparasi - East of Bardaghat Susta','Parbat','Syangja','Tanahun','Arghakhanchi','Banke','Bardiya','Dang','Gulmi','Kapilvastu','Nawalparasi - West of Bardaghat Susta','Palpa','Pyuthan','Rolpa','Rukum - East Part','Rupandehi','Dailekh','Dolpa','Humla','Jajarkot','Jumla','Kalikot','Mugu','Rukum - West Part','Salyan','Surkhet','Achham','Baitadi','Bajhang','Bajura','Dadeldhura','Darchula','Doti','Kailali','Kanchanpur'])],
            // 'village' => ['required_if:country,Nepal', Rule::in(['Aamchowk','Arun','Bhojpur','Hatuwagadhi','Pauwadungma','Ramprasadrai','Salpasilichho','Shadananda','Tyamkemaiyum','Chhathar Jorpati','Choubise','Dhankuta','Pakhribas','Sangurigadhi','Shahidbhumi','Chulachuli','Deumai','Ilam','Mai','Mai Jogmai','Mangsebung','Phakphokthum','Rong','Sandakpur','Suryodaya','Arjundhara','Barhadashi','Bhadrapur','Birtamod','Buddha Shanti','Damak','Gauradaha','Gaurigunj','Haldibari','Jhapa','Kachankawal','Kamal','Kankai','Mechinagar','Shivasatakshi','Aiselukharka','Barahapokhari','Diprung','Halesi Tuwachung','Jantedhunga','Kepilasgadhi','Khotehang','Rawa Besi','Rupakot Majhuwagadhi','Sakela','Belbari','Biratnagar','Budhiganga','Dhanapalthan','Gramthan','Jahada','Kanepokhari','Katahari','Kerabari','Letang','Miklajung','Pathari Shanishchare','Rangeli','Ratuwamai','Sunawarshi','Sundarharaicha','Urlabari','Champadevi','Chishankhugadhi','Khijidemba','Likhu','Manebhanjyang','Molung','Siddhicharan','Sunkoshi','Hilihang','Kummayak','Phalelung','Phalgunanda','Phidim','Tumbewa','Yangwarak','Bhotkhola','Chainpur','Chichila','Dharmadevi','Khandbari','Makalu','Panchkhapan','Savapokhari','Silichong','Dudhkoshi','Khumbu Pasanglhamu','Likhupike','Mahakulung','Nechasalyan','Solududhkunda','Sotang','Thulung Dudhkoshi','Baraha','Barju','Bhokraha','Dewanganj','Dharan','Duhabi','Gadhi','Harinagara','Inaruwa','Itahari','Koshi','Ramdhuni','Aathrai Triveni','Maiwa Khola','Meringden','Mikwa Khola','Pathibhara Yangwarak','Phaktanglung','Phungling','Sidingwa','Sirijangha','Aathrai','Chhathar','Laligurans','Menchhayayem','Myanglung','Phedap','Belaka','Chaudandigadhi','Katari','Limchungbung','Rautamai','Tapli','Triyuga','Udayapurgadhi','Aadarsha Kotwal','Baragadhi','Bishrampur','Devtal','Jeetpur Simara','Kalaiya','Karaiyamai','Kolhabi','Mahagadimai','Nijgadh','Pachrauta','Parwanipur','Pheta','Prasauni','Simraungadh','Suwarna','Bateshwor','Bideha','Dhanauji','Dhanushadham','Ganeshman Charnath','Hansapur','Janaknandini','Janakpur','Kamala','Kshireshwornath','Laxminiya','Mithila','Mithila Bihari','Mukhiyapatti Musaharmiya','Nagrain','Sabaila','Shahidnagar','Aurahi','Balwa','Bardibas','Bhagaha','Ekdara','Gaushala','Jaleshwor','Loharpatti','Mahottari','Manra Shiswa','Matihani','Pipra','Ramgopalpur','Samsi','Sonma','Bahudarmai','Bindabasini','Birgunj','Chhipaharmai','Dhobini','Jagarnathpur','Jira Bhawani','Kalikamai','Pakaha Mainpur','Parsagadhi','Paterwa Sugauli','Pokhariya','Sakhuwa Prasauni','Thori','Baudhimai','Brindawan','Chandrapur','Dewahi Gonahi','Durga Bhagawati','Gadhimai','Garuda','Gaur','Gujara','Ishnath','Katahariya','Madhav Narayan','Maulapur','Paroha','Phatuwabijaypur','Rajdevi','Rajpur','Yamunamai','Agnisair Krishnasawaran','Balanbihul','Bishnupur','Bodebarsain','Chhinnamasta','Dakneshwori','Hanumannagar Kankalini','Kanchanrup','Khadak','Mahadeva','Rajbiraj','Rajgadh','Rupani','Saptakoshi','Shambhunath','Surunga','Tilathi Koiladi','Tirahut','Bagmati','Balra','Barhathwa','Basbariya','Bishnu','Brahmapuri','Chakraghatta','Chandranagar','Dhankaul','Godaita','Harion','Haripur','Haripurwa','Ishworpur','Kaudena','Kawilasi','Lalbandi','Malangwa','Parsa','Ramnagar','Anarma','Bariyapatti','Bhagwanpur','Dhangadhimai','Golbazar','Kalyanpur','Karjanha','Lahan','Laxmipur Patari','Mirchaiya','Naraha','Nawarajpur','Sakhuwanankarkatti','Siraha','Sukhipur','Bhaktapur','Changunarayan','Madhyapur Thimi','Suryabinayak','Bharatpur','Ichchhakamana','Khairhani','Madi','Rapti','Ratnanagar','Benighat Rorang','Dhunibeshi','Gajuri','Galchhi','Gangajamuna','Jwalamukhi','Khaniyabas','Neelakantha','Netrawati','Rubi Valley','Siddhalek','Thakre','Tripurasundari','Baiteshwor','Bhimeshwor','Bigu','Gaurishankar','Jiri','Kalinchowk','Melung','Shailung','Tamakoshi','Budhanilkantha','Chandragiri','Dakshinkali','Gokarneshwor','Kageshwori Manohara','Kathmandu','Kirtipur','Nagarjun','Shankharapur','Tarakeshwor','Tokha','Banepa','Bethanchowk','Bhumlu','Chaurideurali','Dhulikhel','Khanikhola','Mahabharat','Mandandeupur','Namobuddha','Panauti','Panchkhal','Roshi','Temal','Godawari','Konjyosom','Lalitpur','Mahalaxmi','Mahankal','Bakaiya','Bhimphedi','Hetauda','Indrasarowar','Kailash','Makawanpurgadhi','Manahari','Raksirang','Thaha','Belkotgadhi','Bidur','Dupcheshwor','Kakani','Kispang','Meghang','Panchakanya','Shivapuri','Suryagadhi','Tadi','Doramba','Gokulganga','Khandadevi','Likhu Tamakoshi','Manthali','Ramechhap','Sunapati','Umakunda','Gosaikunda','Kalika','Naukunda','Aamachhodingmo','Uttargaya','Dudhauli','Ghyanglekh','Golanjor','Hariharpurgadhi','Kamalamai','Marin','Phikkal','Tinpatan','Bahrabise','Balephi','Bhotekoshi','Chautara Sangachowkgadhi','Helambu','Indrawati','Jugal','Lisankhupakhar','Melamchi','Panchpokhari Thangpal','Badigad','Baglung','Bareng','Dhorpatan','Galkot','Jaimini','Kathekhola','Nisikhola','Tamankhola','Tarakhola','Aarughat','Ajirkot','Barpak Sulikot','Bhimsen','Chumanuwri','Dharche','Gandaki','Gorkha','Palungtar','Shahid Lakhan','Siranchok','Annapurna','Machhapuchhre','Pokhara','Rupa','Besishahar','Dordi','Dudhpokhari','Kwholasothar','Madhyanepal','Marsyangdi','Rainas','Sundarbazar','Chame','Manang Ngisyang','Narpa Bhumi','Nason','Bahragau Muktichhetra','Lo-Ghekar Damodarkunda','Gharapjhong','Lomanthang','Thasang','Beni','Dhawalagiri','Malika','Mangala','Raghuganga','Binayi Tribeni','Bulingtar','Bungdikali','Devchuli','Gaindakot','Hupsekot','Kawasoti','Madhyabindu','Bihadi','Jaljala','Kushma','Mahashila','Modi','Paiyun','Phalewas','Aandhikhola','Arjunchaupari','Bheerkot','Biruwa','Chapakot','Galyang','Harinas','Phedikhola','Putalibazar','Waling','Aanbookhaireni','Bandipur','Bhanu','Bhimad','Devghat','Ghiring','Myagde','Rishing','Shuklagandaki','Vyas','Bhumikasthan','Chhatradev','Malarani','Panini','Sandhikharka','Shitaganga','Baijanath','Duduwa','Janaki','Khajura','Kohalpur','Narainapur','Nepalgunj','Rapti Sonari','Badhaiyatal','Bansgadhi','Barbardiya','Geruwa','Gulariya','Madhuwan','Rajapur','Thakurbaba','Babai','Bangalachuli','Dangisharan','Gadhawa','Ghorahi','Lamahi','Shantinagar','Tulsipur','Chandrakot','Chhatrakot','Dhurkot','Gulmi Darbar','Ishma','Kaligandaki','Madane','Musikot','Resunga','Ruru','Satyawati','Banganga','Bijaynagar','Buddhabhumi','Kapilvastu','Krishnanagar','Maharajgunj','Mayadevi','Shivraj','Shuddhodhan','Yasodhara','Bardghat','Palhinandan','Pratappur','Ramgram','Sarawal','Sunwal','Susta','Baganaskali','Mathagadhi','Nisdi','Purbakhola','Rainadevi Chhahara','Rambha','Rampur','Ribdikot','Tansen','Tinau','Airawati','Gaumukhi','Jhimruk','Mallarani','Mandavi','Naubahini','Pyuthan','Sarumarani','Swargadwari','Paribartan','Lungri','Rolpa','Runtigadhi','Gangadev','Sunchhahari','Sunil Smriti','Thabang','Triveni','Bhume','Putha Uttarganga','Sisne','Butwal','Devdaha','Gaidahawa','Kanchan','Kotahimai','Lumbini Sanskritik','Marchawari','Omsatiya','Rohini','Sainamaina','Sammarimai','Siddharthanagar','Siyari','Tilottama','Aathabis','Bhagawatimai','Bhairabi','Chamunda Bindrasaini','Dullu','Dungeshwor','Gurans','Mahabu','Narayan','Naumule','Thantikandh','Chharka Tangsong','Dolpobuddha','Jagdulla','Kaike','Mudkechula','Shephoksundo','Thuli Bheri','Adanchuli','Chankheli','Kharpunath','Namkha','Sarkegad','Simkot','Tajakot','Barekot','Bheri','Chhedagad','Junichaande','Kushe','Shibalaya','Nalgad','Chandannath','Guthichaur','Hima','Kankasundari','Patarasi','Sinja','Tatopani','Tila','Shuva Kalika','Khandachakra','Mahawai','Narharinath','Pachaljharana','Palata','Raskot','Sanni Triveni','Tilagufa','Chhayanath Rara','Khatyad','Mugum Karmarong','Soru',	'Aathbiskot','Banphikot','Chaurjahari','Sani Bheri','Tribeni','Bagchaur','Bangad Kupinde','Chhatreshwori','Darma','Kalimati','Kapurkot','Kumakh','Shaarada','Siddha Kumakh','Barahatal','Bheriganga','Birendranagar','Chaukune','Chingad','Gurbhakot','Lekbeshi','Panchapuri','Simta','Bannigadhi Jaygadh','Chaurpati','Dhakari','Kamalbazar','Mangalsen','Mellekh','Panchadewal Binayak','Ramaroshan','Sanfebagar','Turmakhad','Dasharathchand','Dilasaini','Dogdakedar','Melauli','Pancheshwor','Patan','Purchaudi','Shivanath','Sigas','Sunarya','Bitthadchir','Bungal','Chhabispathivera','Durgathali','Jayaprithvi','Saipal','Kedarasyu','Khaptadchhanna','Masta','Surma','Talkot','Thalara','Badimalika','Budhinanda','Khaptad Chhededaha','Gaumul','Himali','Jagannath','Swamikartik Khapar','Aalital','Ajayameru','Amargadhi','Bhageshwor','Ganyapadhura','Navadurga','Parshuram','Apihimal','Duhun','Lekam','Mahakali','Malikarjun','Marma','Naugad','Shailyashikhar','Vyans','Aadarsha','Badikedar','Bogatan Phudsil','Dipayal Silgadhi','Jorayal','K. I. Singh','Purbichauki','Sayal','Shikhar','Bardgoriya','Bhajani','Chure','Dhangadhi','Gauriganga','Ghodaghodi','Joshipur','Kailari','Lamkichuha','Mohanyal','Tikapur','Bedkot','Belauri','Beldandi','Bheemdatta','Krishnapur','Laljhadi','Punarbas','Shuklaphanta'])],
            // 'ward_no' => ['required_if:country,Nepal',Rule::in(['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33'])],

            'province' => ['nullable','required_if:country,Nepal',Rule::in(['Koshi','Madhesh','Bagmati','Gandaki','Lumbini','Karnali','Sudhurpaschim'])],
            'district'  => ['nullable','required_if:country,Nepal',

            function ($attribute, $value, $fail) use($province_id) {
                $province_id_in_district_exist = District::where('District',$value)->where('province_id',$province_id)->exists();
                if(!$province_id_in_district_exist){
                    $fail("The selected district is invalid for the chosen province.");
                }
            },
        ],
            'village' => ['nullable','required_if:country,Nepal',
            function ($attribute, $value, $fail) use($district_id) {
            $district_id_in_village_exist = Village::where('Village',$value)->where('district_id',$district_id)->exists();
                if(!$district_id_in_village_exist){
                    $fail("The selected district is invalid for the chosen province.");
                }
            },
            ],
            'ward_no' => ['nullable','required_if:country,Nepal',
            function ($attribute, $value, $fail) use($village_id) {
                $village_id_in_ward_exist = Ward::where('Ward',$value)->where('village_id',$village_id)->exists();
                if(!$village_id_in_ward_exist){
                    $fail("The selected village is invalid for the chosen district.");
                }
        },
        ],
            'street_address' => ['nullable','required_if:country,Nepal','alpha_dash','max:60'],
            ],$custom_messages);




            $validator->setAttributeNames($custom_attributes);


            //  handling uploaded image if uploaded so that it can be store back


            if ($validator->fails()) {
                // \Log::info('Validation Errors: ' . json_encode($validator->errors()));
                // if ($request->isMethod('ajax'))
                if($request->ajax()){
                    return response()->json(['errors' => $validator->errors()], 422);
                }
                // if (!$request->isMethod('ajax')) {
                    // This is not an AJAX request
                    // Your code here
                // }
            }

            $date = date('Y-m-d H:i:s');


                //  $maxrank = DB::table('admin')
                //     ->select(DB::raw('MAX(rank) as max_rank'))
                //     ->union(DB::table('users')->select('rank'))
                //     ->max('max_rank');
                //     if (is_null($maxRank)){
                //         $rank = 1;
                //     }
                //     else{
                //         $rank = $maxrank;
                //     }

            $highestRankinAdmin = Admin::max('Rank');
            $highestRankinUsers = Users::max('Rank');

            if ($highestRankinAdmin === null && $highestRankinUsers === null)
            {
                $rank = 1;
            }
            if ($highestRankinAdmin !== null || $highestRankinUsers !== null)
            {
                if ($highestRankinAdmin > $highestRankinUsers)
                {
                    $currentrank = $highestRankinAdmin;
                    $rank = $currentrank + 1;
                }
                elseif ($highestRankinUsers  > $highestRankinAdmin)
                {
                    $currentrank = $highestRankinUsers;
                    $rank = $currentrank + 1;
                }
            }

            if ($request->hasFile('user_image')) {
                // If image is present in the request, move it to images/uploaded/feedback
                $imagePath = $request->file('user_image')->store('images/uploaded/user', 'public');
                $image_location = '/storage/'.$imagePath;
                // dd($image_location);
            }
            else{
                $image_location = '';
            }

            $users = Users::create([
                'Rank' => $rank,
                'First_Name' => $request->input('first_name'),
                'Middle_Name' => $request->input('middle_name'),
                'Last_Name' => $request->input('last_name'),
                'image_file_path' => $image_location,
                'email' => $request->input('email'),
                'password' => bcrypt($request->input('password')),
                'user_username' => $request->input('username'),
                'institute_username' => $request->input('institute_username'),
                'Gender' => $request->input('gender'),
                'Country' => $request->input('country'),
                'Province_Name_Nepal' => $request->input('province'),
                'District_Nepal' => $request->input('district'),
                'Village_Nepal' => $request->input('village'),
                'Ward_No_Nepal' => $request->input('ward_no'),
                'Street_Address_Nepal' => $request->input('street_address'),
                'Last_First_Name_Update' => $date,
                'Last_Last_Name_Update' => $date,
                'Last_Password_Update' => $date,
            ]);

            if (empty($request->input('Middle_Name'))){
                $users->Verified = '1';
                $users->save();
            }
            else{
                $users->Verified = '1';
                $users->Last_Middle_Name_Update = $date;
                $users->save();
            }

        $updateverifyuserdetail = VerifyUser::where('email',$request->input('email'))->first();
        if($updateverifyuserdetail)
        {
            $updateverifyuserdetail->Status = '0';
            $updateverifyuserdetail->save();
        }



      $this->loginDetails($request, $request->input('username'),'Account Creation', 'user');
      Session::put('errormsg', 'Congratulations on successfully signing up! 🎉 Feel free to log in now. We are thrilled to have you with us!');
      return response()->json(['message' => 'success']);
    }


    public function userDashboard()
    {
        $info = $this->getUserInfo();
        $userinfo = $info['user_info'];
        $fullname =  $info['name'];
        return view('users.user-dashboard', compact('userinfo','fullname'));
    }



    function getUserInfo()
    {
        $user_info = Auth::guard('customuser')->user();
        $name = $this->combineNames($user_info);
        return [
            'user_info' => $user_info,
            'name' => $name,
        ];
    }

    function combineNames($userinfo)
    {
        $first_name = Users::where('First_name', $userinfo->First_Name)->value('First_Name');
        $middle_name = Users::where('Middle_Name', $userinfo->Middle_Name)->value('Middle_Name');
        $last_name = Users::where('Last_Name', $userinfo->Last_Name)->value('Last_Name');

        $nameParts = [$first_name, $middle_name, $last_name];
         // Remove any empty parts and concatenate with a space
        $filteredNameParts = array_filter($nameParts, function ($part) {
            return !empty($part);
        });
         // Combine the names into a full name and return back
        return implode(' ', $filteredNameParts);
    }

    function loginDetails($request, $username, $logintype, $usertype)
    {
            $useragent = Str::limit($request->userAgent(), 250);
            $agentInfo = $this->configureAgent();

            LoginDetail::create([
            'username' => $username,
            'IP_Address' => request()->ip(),
            'User_Agent' =>$useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => $logintype,
            'User_Type' => $usertype,
            'Browser' => $agentInfo['browser'],
            'Platform' => $agentInfo['platform'],
            'Device' => $agentInfo['device'],
            ]);
    }

    function configureAgent()
    {
        $agent = new Agent();
        $browser = $agent->browser(); // chrome, edge
        $platform = $agent->platform(); //AndroidOS, iOS, OS X wher iOS = Apple Mobile Device like iPhone, iPad, iPod and OS X = Apple Desktop and Laptop like iMac, MacBook, and Mac Pro
        $device = $agent->device(); // iPhone, iPad, Xiaomi, Samsung, WebKit, Pixel, OnePlus, SamsungTablet, Macintosh
        return [
            'browser' => $browser,
            'platform' => $platform,
            'device' => $device,
        ];
    }


    function addDeletedAccounToDatabase($request)
    {
            $user = Auth::guard('customuser')->user();
            $agentInfo = $this->configureAgent();
            $useragent = Str::limit($request->userAgent(), 250);

            DeletedAccount::create([
                'email' => $user->email,
                'username' => $user->user_username,
                'Deleted_Date_Time' => date('Y-m-d H:i:s'),
                'IP_Address' => request()->ip(),
                'User_Agent' =>$useragent,
                'Account_Type' => 'user',
                'Browser' => $agentInfo['browser'],
                'Platform' => $agentInfo['platform'],
                'Device' => $agentInfo['device'],
            ]);
    }

    function log_out($request,$logintype)
    {
        Users::where('email', Auth::guard('customuser')->user()->email)->update(['flag_one_device' => '0']);
        $username = Users::where('email',Auth::guard('customuser')->user()->email)->value('user_username');
        $usertype = 'user';
        $this->loginDetails($request, $username, $logintype, $usertype);
    }

    public function changePassword()
    {

    }

    public function accountDetails(Request $request)
    {

        $info = $this->getUserInfo();
        $perPage = $request->input('per_page', 10);
        $userinfo = $info['user_info'];
        $fullname =  $info['name'];
        // $logindetails = LoginDetail::where('username',$userinfo->user_username)->get();
        $logindetails = LoginDetail::where('username',$userinfo->user_username)->paginate($perPage);
        return view('users.accountdetails', compact('userinfo','fullname','logindetails'));
    }

    public function deleteAccount()
    {
        $info = $this->getUserInfo();
        $userinfo = $info['user_info'];
        $fullname =  $info['name'];
        $userinfo = Auth::guard('customuser')->user();
        return view('users.deleteaccount', compact('userinfo','fullname'));
    }

    public function deleteAccountCheck(Request $request)
    {
        $currentGuard = 'customuser';
        $custommessages = [
            'password.required' => 'Password is required.',
        ];

            $validator = Validator::make($request->all(), [
                'password' => ['required',new CurrentPassword($currentGuard)],
            ], $custommessages);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }


        $user = Users::find(Auth::guard('customuser')->user()->id);
        $user_username = $user->user_username;
        $this->addDeletedAccounToDatabase($request);
        $this->log_out($request,"Log Out - Account Deleted");
        Auth::guard('customuser')->logout();

        if ($user->delete())
        {
            // Delete all records in login details of this admin
            LoginDetail::where('username', $user_username)->delete();
             //User::where('user_username', Auth::guard('customuser')->user()->user_username)->delete();
            return redirect()->route('user_homepage')->with('errormsg', "Account Deleted Successfully.");
        }
        else
        {
            return redirect()->route('user_homepage')->with('errormsg', "Sorry! Something went wrong. Account deletion failed.");
        }
    }

    public function logout(Request $request)
    {
        $this->log_out($request,"Log Out");
        Auth::guard('customuser')->logout();
        // Cookie::forget('remember_customuser');
        return redirect()->route('user_homepage')->with('errormsg', "You've Been Successfully Logged Out.");
    }
}



