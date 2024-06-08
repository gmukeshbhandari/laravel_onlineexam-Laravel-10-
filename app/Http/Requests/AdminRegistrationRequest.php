<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use App\Models\Province;
use App\Models\District;
use App\Models\Village;
use App\Models\Ward;

class AdminRegistrationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {  
            return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $email = $this->input('adminemailregister');
        $province_name = $this->input('province');
        $district_name = $this->input('district');
        $village_name = $this->input('village');

        
        $province_id = Province::where('Province',$province_name)->value('id');
        $district_id = District::where('province_id',$province_id)->where('District',$district_name)->value('id');
        $village_id = Village::where('district_id',$district_id)->where('Village', $village_name)->value('id');
        return [
            'institutename' => ['required','max:60','regex:/^[a-zA-Z ]+$/'], //regex validatation - alphabet and space only
            'adminemailregister' => ['required','email','max:200','string','unique:users,email','unique:admins,email','unique:super_admins,email'],
            'adminusernameregister' => ['alpha_dash','required','min:3','max:30','unique:users,user_username','unique:admins,institute_username','unique:deleted_accounts,username'],
            'password' => ['required','min:8','max:72','same:confirmpassword'],
            'confirmpassword' => ['required','max:72'],
            'country'   => ['required', Rule::in(['Afghanistan','Aland Islands','Albania','Algeria','American Samoa','Andorra','Angola','Anguilla','Antarctica','Antigua and Barbuda','Argentina','Armenia','Aruba','Ascension Island','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bermuda','Bhutan','Bolivia','Bosnia and Herzegovina','Botswana','Bouvet Island','Brazil','British Indian Ocean Territory','British Virgin Islands','Brunei','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Canada','Canary Islands','Cape Verde','Caribbean Netherlands','Cayman Islands','Central African Republic','Ceuta and Melilla','Chad','Chile','China','Christmas Island','Clipperton Island','Cocos  Islands','Colombia','Comoros','Congo - Brazzaville','Congo - Kinshasa','Cook Islands','Costa Rica','Cote d\'Ivoire','Croatia','Cuba','Curacao','Cyprus','Czechia','Denmark','Diego Garcia','Djibouti','Dominica','Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Ethiopia','Falkland Islands','Faroe Islands','Fiji','Finland','France','French Guiana','French Polynesia','French Southern Territories','Gabon','Gambia','Georgia','Germany','Ghana','Gibraltar','Greece','Greenland','Grenada','Guadeloupe','Guam','Guatemala','Guernsey','Guinea','Guinea-Bissau','Guyana','Haiti','Heard and McDonald Islands','Honduras','Hong Kong','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Isle of Man','Israel','Italy','Jamaica','Japan','Jersey','Jordan','Kazakhstan','Kenya','Kiribati','Kosovo','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg','Macau','Macedonia','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Martinique','Mauritania','Mauritius','Mayotte','Mexico','Micronesia','Moldova','Monaco','Mongolia','Montenegro','Montserrat','Morocco','Mozambique','Myanmar (Burma)','Namibia','Nauru','Nepal','Netherlands','New Caledonia','New Zealand','Nicaragua','Niger','Nigeria','Niue','Norfolk Island','Northern Mariana Islands','North Korea','Norway','Oman','Pakistan','Palau','Palestine','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Pitcairn Islands','Poland','Portugal','Puerto Rico','Qatar','Reunion','Romania','Russia','Rwanda','Samoa','San Marino','Sao Tome and Principe','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Sint Maarten','Slovakia','Slovenia','Solomon Islands','Somalia','South Africa','South Georgia and South Sandwich Islands','South Korea','South Sudan','Spain','Sri Lanka','St. Barthelemy','St. Helena','St. Kitts and Nevis','St. Lucia','St. Martin','St. Pierre and Miquelon','St. Vincent and Grenadines','Sudan','Suriname','Svalbard and Jan Mayen','Swaziland','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Timor-Leste','Togo','Tokelau','Tonga','Trinidad and Tobago','Tristan da Cunha','Tunisia','Turkey','Turkmenistan','Turks and Caicos Islands','Tuvalu','U.S. Outlying Islands','U.S. Virgin Islands','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Vanuatu','Vatican City','Venezuela','Vietnam','Wallis and Futuna','Western Sahara','Yemen','Zambia','Zimbabwe'])],
        //     'district'  => ['required_if:country,Nepal',
        //      Rule::in(['Bhojpur','Dhankuta','Ilam','Jhapa','Khotang','Morang','Okhaldhunga','Panchthar','Sankhuwasabha','Solukhumbu','Sunsari','Taplejung','Terhathum','Udayapur','Bara','Dhanusa','Mahottari','Parsa','Rautahat','Saptari','Sarlahi','Siraha','Bhaktapur','Chitwan','Dhading','Dolakha','Kathmandu','Kavrepalanchok','Lalitpur','Makwanpur','Nuwakot','Ramechhap','Rasuwa','Sindhuli','Sindhupalchok','Baglung','Gorkha','Kaski','Lamjung','Manang','Mustang','Myagdi','Nawalparasi - East of Bardaghat Susta','Parbat','Syangja','Tanahun','Arghakhanchi','Banke','Bardiya','Dang','Gulmi','Kapilvastu','Nawalparasi - West of Bardaghat Susta','Palpa','Pyuthan','Rolpa','Rukum - East Part','Rupandehi','Dailekh','Dolpa','Humla','Jajarkot','Jumla','Kalikot','Mugu','Rukum - West Part','Salyan','Surkhet','Achham','Baitadi','Bajhang','Bajura','Dadeldhura','Darchula','Doti','Kailali','Kanchanpur']),
        //     ],
        //     'village'  => ['required_if:country,Nepal',
        //     Rule::in(['Aamchowk','Arun','Bhojpur','Hatuwagadhi','Pauwadungma','Ramprasadrai','Salpasilichho','Shadananda','Tyamkemaiyum','Chhathar Jorpati','Choubise','Dhankuta','Pakhribas','Sangurigadhi','Shahidbhumi','Chulachuli','Deumai','Ilam','Mai','Mai Jogmai','Mangsebung','Phakphokthum','Rong','Sandakpur','Suryodaya','Arjundhara','Barhadashi','Bhadrapur','Birtamod','Buddha Shanti','Damak','Gauradaha','Gaurigunj','Haldibari','Jhapa','Kachankawal','Kamal','Kankai','Mechinagar','Shivasatakshi','Aiselukharka','Barahapokhari','Diprung','Halesi Tuwachung','Jantedhunga','Kepilasgadhi','Khotehang','Rawa Besi','Rupakot Majhuwagadhi','Sakela','Belbari','Biratnagar','Budhiganga','Dhanapalthan','Gramthan','Jahada','Kanepokhari','Katahari','Kerabari','Letang','Miklajung','Pathari Shanishchare','Rangeli','Ratuwamai','Sunawarshi','Sundarharaicha','Urlabari','Champadevi','Chishankhugadhi','Khijidemba','Likhu','Manebhanjyang','Molung','Siddhicharan','Sunkoshi','Hilihang','Kummayak','Phalelung','Phalgunanda','Phidim','Tumbewa','Yangwarak','Bhotkhola','Chainpur','Chichila','Dharmadevi','Khandbari','Makalu','Panchkhapan','Savapokhari','Silichong','Dudhkoshi','Khumbu Pasanglhamu','Likhupike','Mahakulung','Nechasalyan','Solududhkunda','Sotang','Thulung Dudhkoshi','Baraha','Barju','Bhokraha','Dewanganj','Dharan','Duhabi','Gadhi','Harinagara','Inaruwa','Itahari','Koshi','Ramdhuni','Aathrai Triveni','Maiwa Khola','Meringden','Mikwa Khola','Pathibhara Yangwarak','Phaktanglung','Phungling','Sidingwa','Sirijangha','Aathrai','Chhathar','Laligurans','Menchhayayem','Myanglung','Phedap','Belaka','Chaudandigadhi','Katari','Limchungbung','Rautamai','Tapli','Triyuga','Udayapurgadhi','Aadarsha Kotwal','Baragadhi','Bishrampur','Devtal','Jeetpur Simara','Kalaiya','Karaiyamai','Kolhabi','Mahagadimai','Nijgadh','Pachrauta','Parwanipur','Pheta','Prasauni','Simraungadh','Suwarna','Bateshwor','Bideha','Dhanauji','Dhanushadham','Ganeshman Charnath','Hansapur','Janaknandini','Janakpur','Kamala','Kshireshwornath','Laxminiya','Mithila','Mithila Bihari','Mukhiyapatti Musaharmiya','Nagrain','Sabaila','Shahidnagar','Aurahi','Balwa','Bardibas','Bhagaha','Ekdara','Gaushala','Jaleshwor','Loharpatti','Mahottari','Manra Shiswa','Matihani','Pipra','Ramgopalpur','Samsi','Sonma','Bahudarmai','Bindabasini','Birgunj','Chhipaharmai','Dhobini','Jagarnathpur','Jira Bhawani','Kalikamai','Pakaha Mainpur','Parsagadhi','Paterwa Sugauli','Pokhariya','Sakhuwa Prasauni','Thori','Baudhimai','Brindawan','Chandrapur','Dewahi Gonahi','Durga Bhagawati','Gadhimai','Garuda','Gaur','Gujara','Ishnath','Katahariya','Madhav Narayan','Maulapur','Paroha','Phatuwabijaypur','Rajdevi','Rajpur','Yamunamai','Agnisair Krishnasawaran','Balanbihul','Bishnupur','Bodebarsain','Chhinnamasta','Dakneshwori','Hanumannagar Kankalini','Kanchanrup','Khadak','Mahadeva','Rajbiraj','Rajgadh','Rupani','Saptakoshi','Shambhunath','Surunga','Tilathi Koiladi','Tirahut','Bagmati','Balra','Barhathwa','Basbariya','Bishnu','Brahmapuri','Chakraghatta','Chandranagar','Dhankaul','Godaita','Harion','Haripur','Haripurwa','Ishworpur','Kaudena','Kawilasi','Lalbandi','Malangwa','Parsa','Ramnagar','Anarma','Bariyapatti','Bhagwanpur','Dhangadhimai','Golbazar','Kalyanpur','Karjanha','Lahan','Laxmipur Patari','Mirchaiya','Naraha','Nawarajpur','Sakhuwanankarkatti','Siraha','Sukhipur','Bhaktapur','Changunarayan','Madhyapur Thimi','Suryabinayak','Bharatpur','Ichchhakamana','Khairhani','Madi','Rapti','Ratnanagar','Benighat Rorang','Dhunibeshi','Gajuri','Galchhi','Gangajamuna','Jwalamukhi','Khaniyabas','Neelakantha','Netrawati','Rubi Valley','Siddhalek','Thakre','Tripurasundari','Baiteshwor','Bhimeshwor','Bigu','Gaurishankar','Jiri','Kalinchowk','Melung','Shailung','Tamakoshi','Budhanilkantha','Chandragiri','Dakshinkali','Gokarneshwor','Kageshwori Manohara','Kathmandu','Kirtipur','Nagarjun','Shankharapur','Tarakeshwor','Tokha','Banepa','Bethanchowk','Bhumlu','Chaurideurali','Dhulikhel','Khanikhola','Mahabharat','Mandandeupur','Namobuddha','Panauti','Panchkhal','Roshi','Temal','Godawari','Konjyosom','Lalitpur','Mahalaxmi','Mahankal','Bakaiya','Bhimphedi','Hetauda','Indrasarowar','Kailash','Makawanpurgadhi','Manahari','Raksirang','Thaha','Belkotgadhi','Bidur','Dupcheshwor','Kakani','Kispang','Meghang','Panchakanya','Shivapuri','Suryagadhi','Tadi','Doramba','Gokulganga','Khandadevi','Likhu Tamakoshi','Manthali','Ramechhap','Sunapati','Umakunda','Gosaikunda','Kalika','Naukunda','Aamachhodingmo','Uttargaya','Dudhauli','Ghyanglekh','Golanjor','Hariharpurgadhi','Kamalamai','Marin','Phikkal','Tinpatan','Bahrabise','Balephi','Bhotekoshi','Chautara Sangachowkgadhi','Helambu','Indrawati','Jugal','Lisankhupakhar','Melamchi','Panchpokhari Thangpal','Badigad','Baglung','Bareng','Dhorpatan','Galkot','Jaimini','Kathekhola','Nisikhola','Tamankhola','Tarakhola','Aarughat','Ajirkot','Barpak Sulikot','Bhimsen','Chumanuwri','Dharche','Gandaki','Gorkha','Palungtar','Shahid Lakhan','Siranchok','Annapurna','Machhapuchhre','Pokhara','Rupa','Besishahar','Dordi','Dudhpokhari','Kwholasothar','Madhyanepal','Marsyangdi','Rainas','Sundarbazar','Chame','Manang Ngisyang','Narpa Bhumi','Nason','Bahragau Muktichhetra','Lo-Ghekar Damodarkunda','Gharapjhong','Lomanthang','Thasang','Beni','Dhawalagiri','Malika','Mangala','Raghuganga','Binayi Tribeni','Bulingtar','Bungdikali','Devchuli','Gaindakot','Hupsekot','Kawasoti','Madhyabindu','Bihadi','Jaljala','Kushma','Mahashila','Modi','Paiyun','Phalewas','Aandhikhola','Arjunchaupari','Bheerkot','Biruwa','Chapakot','Galyang','Harinas','Phedikhola','Putalibazar','Waling','Aanbookhaireni','Bandipur','Bhanu','Bhimad','Devghat','Ghiring','Myagde','Rishing','Shuklagandaki','Vyas','Bhumikasthan','Chhatradev','Malarani','Panini','Sandhikharka','Shitaganga','Baijanath','Duduwa','Janaki','Khajura','Kohalpur','Narainapur','Nepalgunj','Rapti Sonari','Badhaiyatal','Bansgadhi','Barbardiya','Geruwa','Gulariya','Madhuwan','Rajapur','Thakurbaba','Babai','Bangalachuli','Dangisharan','Gadhawa','Ghorahi','Lamahi','Shantinagar','Tulsipur','Chandrakot','Chhatrakot','Dhurkot','Gulmi Darbar','Ishma','Kaligandaki','Madane','Musikot','Resunga','Ruru','Satyawati','Banganga','Bijaynagar','Buddhabhumi','Kapilvastu','Krishnanagar','Maharajgunj','Mayadevi','Shivraj','Shuddhodhan','Yasodhara','Bardghat','Palhinandan','Pratappur','Ramgram','Sarawal','Sunwal','Susta','Baganaskali','Mathagadhi','Nisdi','Purbakhola','Rainadevi Chhahara','Rambha','Rampur','Ribdikot','Tansen','Tinau','Airawati','Gaumukhi','Jhimruk','Mallarani','Mandavi','Naubahini','Pyuthan','Sarumarani','Swargadwari','Paribartan','Lungri','Rolpa','Runtigadhi','Gangadev','Sunchhahari','Sunil Smriti','Thabang','Triveni','Bhume','Putha Uttarganga','Sisne','Butwal','Devdaha','Gaidahawa','Kanchan','Kotahimai','Lumbini Sanskritik','Marchawari','Omsatiya','Rohini','Sainamaina','Sammarimai','Siddharthanagar','Siyari','Tilottama','Aathabis','Bhagawatimai','Bhairabi','Chamunda Bindrasaini','Dullu','Dungeshwor','Gurans','Mahabu','Narayan','Naumule','Thantikandh','Chharka Tangsong','Dolpobuddha','Jagdulla','Kaike','Mudkechula','Shephoksundo','Thuli Bheri','Adanchuli','Chankheli','Kharpunath','Namkha','Sarkegad','Simkot','Tajakot','Barekot','Bheri','Chhedagad','Junichaande','Kushe','Shibalaya','Nalgad','Chandannath','Guthichaur','Hima','Kankasundari','Patarasi','Sinja','Tatopani','Tila','Shuva Kalika','Khandachakra','Mahawai','Narharinath','Pachaljharana','Palata','Raskot','Sanni Triveni','Tilagufa','Chhayanath Rara','Khatyad','Mugum Karmarong','Soru',	'Aathbiskot','Banphikot','Chaurjahari','Sani Bheri','Tribeni','Bagchaur','Bangad Kupinde','Chhatreshwori','Darma','Kalimati','Kapurkot','Kumakh','Shaarada','Siddha Kumakh','Barahatal','Bheriganga','Birendranagar','Chaukune','Chingad','Gurbhakot','Lekbeshi','Panchapuri','Simta','Bannigadhi Jaygadh','Chaurpati','Dhakari','Kamalbazar','Mangalsen','Mellekh','Panchadewal Binayak','Ramaroshan','Sanfebagar','Turmakhad','Dasharathchand','Dilasaini','Dogdakedar','Melauli','Pancheshwor','Patan','Purchaudi','Shivanath','Sigas','Sunarya','Bitthadchir','Bungal','Chhabispathivera','Durgathali','Jayaprithvi','Saipal','Kedarasyu','Khaptadchhanna','Masta','Surma','Talkot','Thalara','Badimalika','Budhinanda','Khaptad Chhededaha','Gaumul','Himali','Jagannath','Swamikartik Khapar','Aalital','Ajayameru','Amargadhi','Bhageshwor','Ganyapadhura','Navadurga','Parshuram','Apihimal','Duhun','Lekam','Mahakali','Malikarjun','Marma','Naugad','Shailyashikhar','Vyans','Aadarsha','Badikedar','Bogatan Phudsil','Dipayal Silgadhi','Jorayal','K. I. Singh','Purbichauki','Sayal','Shikhar','Bardgoriya','Bhajani','Chure','Dhangadhi','Gauriganga','Ghodaghodi','Joshipur','Kailari','Lamkichuha','Mohanyal','Tikapur','Bedkot','Belauri','Beldandi','Bheemdatta','Krishnapur','Laljhadi','Punarbas','Shuklaphanta']),
        //     ],
        //     'province'  => ['required_if:country,Nepal',
        //     Rule::in(['Koshi', 'Madhesh','Bagmati','Gandaki','Lumbini','Karnali','Sudhurpaschim']),
        //     ],
        //     'wardno'  => ['required_if:country,Nepal',
        //     Rule::in(['1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31','32','33']),
        // ],
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
        'wardno' => ['nullable','required_if:country,Nepal',
        function ($attribute, $value, $fail) use($village_id) {   
            $village_id_in_ward_exist = Ward::where('Ward',$value)->where('village_id',$village_id)->exists();
            if(!$village_id_in_ward_exist){
                $fail("The selected village is invalid for the chosen district.");
            }
    },
    ],
        'streetaddress' => ['nullable','required_if:country,Nepal','alpha_dash','max:60'],

            'verification_code' => [
            'required',
            function ($attribute, $value, $fail) use ($email) {
                $exists = DB::table('verify_users')
                    ->where('email', $email)
                    ->where('token', $value)
                    ->where('Status', '1')
                    ->exists();

                    
                if (!$exists) {
                    $fail('The verification code is invalid.');
                }
            },
            ],
        ];
        
    }

      /**
 * Get custom attributes for validator errors.
 *
 * @return array<string, string>
 */
public function attributes(): array
{
    return [
        'institutename' => 'Institute Name',
        'adminemailregister' => 'Email',
        'adminusernameregister' => 'Username',
        'password' => 'New password',
        'confirmpassword' => 'confirm password',
        'country' => 'country',
        'province' => 'province',
        'district' => 'district',
        'village' => 'village',
        'wardno' => 'ward',
        'streetaddress' => 'Address',
        'verification_code' => 'verification code',
 
    ];
}

    public function messages()
    {
        return [
            // 'required_if' => 'The :attribute field is required.',
        ];
    }

}
