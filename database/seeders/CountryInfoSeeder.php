<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Country;
use App\Models\Province;
use App\Models\District;
use App\Models\Village;
use App\Models\Ward;
use App\Models\ElectionCenter;
use Illuminate\Support\Facades\Log;


class CountryInfoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
            $countries = [
                ['Country' => 'Afghanistan'],
                ['Country' => 'Aland Islands'],
                ['Country' => 'Albania'],
                ['Country' => 'Algeria'],
                ['Country' => 'American Samoa'],
                ['Country' => 'Andorra'],
                ['Country' => 'Angola'],
                ['Country' => 'Anguilla'],
                ['Country' => 'Antarctica'],
                ['Country' => 'Antigua and Barbuda'],
                ['Country' => 'Argentina'],
                ['Country' => 'Armenia'],
                ['Country' => 'Aruba'],
                ['Country' => 'Ascension Island'],
                ['Country' => 'Australia'],
                ['Country' => 'Austria'],
                ['Country' => 'Azerbaijan'],
                ['Country' => 'Bahamas'],
                ['Country' => 'Bahrain'],
                ['Country' => 'Bangladesh'],
                ['Country' => 'Barbados'],
                ['Country' => 'Belarus'],
                ['Country' => 'Belgium'],
                ['Country' => 'Belize'],
                ['Country' => 'Benin'],
                ['Country' => 'Bermuda'],
                ['Country' => 'Bhutan'],
                ['Country' => 'Bolivia'],
                ['Country' => 'Bosnia and Herzegovina'],
                ['Country' => 'Botswana'],
                ['Country' => 'Bouvet Island'],
                ['Country' => 'Brazil'],
                ['Country' => 'British Indian Ocean Territory'],
                ['Country' => 'British Virgin Islands'],
                ['Country' => 'Brunei'],
                ['Country' => 'Bulgaria'],
                ['Country' => 'Burkina Faso'],
                ['Country' => 'Burundi'],
                ['Country' => 'Cambodia'],
                ['Country' => 'Cameroon'],
                ['Country' => 'Canada'],
                ['Country' => 'Canary Islands'],
                ['Country' => 'Cape Verde'],
                ['Country' => 'Caribbean Netherlands'],
                ['Country' => 'Cayman Islands'],
                ['Country' => 'Central African Republic'],
                ['Country' => 'Ceuta and Melilla'],
                ['Country' => 'Chad'],
                ['Country' => 'Chile'],
                ['Country' => 'China'],
                ['Country' => 'Christmas Island'],
                ['Country' => 'Clipperton Island'],
                ['Country' => 'Cocos  Islands'],
                ['Country' => 'Colombia'],
                ['Country' => 'Comoros'],
                ['Country' => 'Congo - Brazzaville'],
                ['Country' => 'Congo - Kinshasa'],
                ['Country' => 'Cook Islands'],
                ['Country' => 'Costa Rica'],
                ['Country' => 'Cote d’Ivoire'],
                ['Country' => 'Croatia'],
                ['Country' => 'Cuba'],
                ['Country' => 'Curacao'],
                ['Country' => 'Cyprus'],
                ['Country' => 'Czechia'],
                ['Country' => 'Denmark'],
                ['Country' => 'Diego Garcia'],
                ['Country' => 'Djibouti'],
                ['Country' => 'Dominica'],
                ['Country' => 'Dominican Republic'],
                ['Country' => 'Ecuador'],
                ['Country' => 'Egypt'],
                ['Country' => 'El Salvador'],
                ['Country' => 'Equatorial Guinea'],
                ['Country' => 'Eritrea'],
                ['Country' => 'Estonia'],
                ['Country' => 'Ethiopia'],
                ['Country' => 'Falkland Islands'],
                ['Country' => 'Faroe Islands'],
                ['Country' => 'Fiji'],
                ['Country' => 'Finland'],
                ['Country' => 'France'],
                ['Country' => 'French Guiana'],
                ['Country' => 'French Polynesia'],
                ['Country' => 'French Southern Territories'],
                ['Country' => 'Gabon'],
                ['Country' => 'Gambia'],
                ['Country' => 'Georgia'],
                ['Country' => 'Germany'],
                ['Country' => 'Ghana'],
                ['Country' => 'Gibraltar'],
                ['Country' => 'Greece'],
                ['Country' => 'Greenland'],
                ['Country' => 'Grenada'],
                ['Country' => 'Guadeloupe'],
                ['Country' => 'Guam'],
                ['Country' => 'Guatemala'],
                ['Country' => 'Guernsey'],
                ['Country' => 'Guinea'],
                ['Country' => 'Guinea-Bissau'],
                ['Country' => 'Guyana'],
                ['Country' => 'Haiti'],
                ['Country' => 'Heard and McDonald Islands'],
                ['Country' => 'Honduras'],
                ['Country' => 'Hong Kong'],
                ['Country' => 'Hungary'],
                ['Country' => 'Iceland'],
                ['Country' => 'India'],
                ['Country' => 'Indonesia'],
                ['Country' => 'Iran'],
                ['Country' => 'Iraq'],
                ['Country' => 'Ireland'],
                ['Country' => 'Isle of Man'],
                ['Country' => 'Israel'],
                ['Country' => 'Italy'],
                ['Country' => 'Jamaica'],
                ['Country' => 'Japan'],
                ['Country' => 'Jersey'],
                ['Country' => 'Jordan'],
                ['Country' => 'Kazakhstan'],
                ['Country' => 'Kenya'],
                ['Country' => 'Kiribati'],
                ['Country' => 'Kosovo'],
                ['Country' => 'Kuwait'],
                ['Country' => 'Kyrgyzstan'],
                ['Country' => 'Laos'],
                ['Country' => 'Latvia '],
                ['Country' => 'Lebanon'],
                ['Country' => 'Lesotho'],
                ['Country' => 'Liberia'],
                ['Country' => 'Libya'],
                ['Country' => 'Liechtenstein'],
                ['Country' => 'Lithuania'],
                ['Country' => 'Luxembourg'],
                ['Country' => 'Macau'],
                ['Country' => 'Macedonia'],
                ['Country' => 'Madagascar'],
                ['Country' => 'Malawi'],
                ['Country' => 'Malaysia'],
                ['Country' => 'Maldives'],
                ['Country' => 'Mali'],
                ['Country' => 'Malta'],
                ['Country' => 'Marshall Islands'],
                ['Country' => 'Martinique'],
                ['Country' => 'Mauritania'],
                ['Country' => 'Mauritius'],
                ['Country' => 'Mayotte'],
                ['Country' => 'Mexico'],
                ['Country' => 'Micronesia'],
                ['Country' => 'Moldova'],
                ['Country' => 'Monaco'],
                ['Country' => 'Mongolia'],
                ['Country' => 'Montenegro'],
                ['Country' => 'Montserrat'],
                ['Country' => 'Morocco'],
                ['Country' => 'Mozambique'],
                ['Country' => 'Myanmar(Burma)'],
                ['Country' => 'Namibia'],
                ['Country' => 'Nauru'],
                ['Country' => 'Nepal'],
                ['Country' => 'Netherlands'],
                ['Country' => 'New Caledonia'],
                ['Country' => 'New Zealand'],
                ['Country' => 'Nicaragua'],
                ['Country' => 'Niger'],
                ['Country' => 'Nigeria'],
                ['Country' => 'Niue'],
                ['Country' => 'Norfolk Island'],
                ['Country' => 'Northern Mariana Islands'],
                ['Country' => 'North Korea'],
                ['Country' => 'Norway'],
                ['Country' => 'Oman'],
                ['Country' => 'Pakistan'],
                ['Country' => 'Palau'],
                ['Country' => 'Palestine'],
                ['Country' => 'Panama'],
                ['Country' => 'Papua New Guinea'],
                ['Country' => 'Paraguay'],
                ['Country' => 'Peru'],
                ['Country' => 'Philippines'],
                ['Country' => 'Pitcairn Islands'],
                ['Country' => 'Poland'],
                ['Country' => 'Portugal'],
                ['Country' => 'Puerto Rico'],
                ['Country' => 'Qatar'],
                ['Country' => 'Reunion'],
                ['Country' => 'Romania'],
                ['Country' => 'Russia'],
                ['Country' => 'Rwanda'],
                ['Country' => 'Samoa'],
                ['Country' => 'San Marino'],
                ['Country' => 'Sao Tome and Principe'],
                ['Country' => 'Saudi Arabia'],
                ['Country' => 'Senegal'],
                ['Country' => 'Serbia'],
                ['Country' => 'Seychelles'],
                ['Country' => 'Sierra Leone'],
                ['Country' => 'Singapore'],
                ['Country' => 'Sint Maarten'],
                ['Country' => 'Slovakia'],
                ['Country' => 'Slovenia'],
                ['Country' => 'Solomon Islands'],
                ['Country' => 'Somalia'],
                ['Country' => 'South Africa'],
                ['Country' => 'South Georgia and South Sandwich Islands'],
                ['Country' => 'South Korea'],
                ['Country' => 'South Sudan'],
                ['Country' => 'Spain'],
                ['Country' => 'Sri Lanka'],
                ['Country' => 'St. Barthelemy'],
                ['Country' => 'St. Helena'],
                ['Country' => 'St. Kitts an Nevis'],
                ['Country' => 'St. Lucia'],
                ['Country' => 'St. Martin'],
                ['Country' => 'St. Pierre and Miquelon'],
                ['Country' => 'St. Vincent and Grenadines'],
                ['Country' => 'Sudan '],
                ['Country' => 'Suriname'],
                ['Country' => 'Svalbard and Jan Mayen'],
                ['Country' => 'Swaziland'],
                ['Country' => 'Sweden'],
                ['Country' => 'Switzerland'],
                ['Country' => 'Syria'],
                ['Country' => 'Taiwan'],
                ['Country' => 'Tajikistan'],
                ['Country' => 'Tanzania'],
                ['Country' => 'Thailand'],
                ['Country' => 'Timor-Leste'],
                ['Country' => 'Togo'],
                ['Country' => 'Tokelau'],
                ['Country' => 'Tonga'],
                ['Country' => 'Trinidad and Tobago'],
                ['Country' => 'Tristan da Cunha'],
                ['Country' => 'Tunisia'],
                ['Country' => 'Turkey'],
                ['Country' => 'Turkmenistan'],
                ['Country' => 'Turks and Caicos Islands'],
                ['Country' => 'Tuvalu'],
                ['Country' => 'U.S. Outlying Islands'],
                ['Country' => 'U.S. Virgin Islands'],
                ['Country' => 'Uganda'],
                ['Country' => 'Ukraine'],
                ['Country' => 'United Arab Emirates'],
                ['Country' => 'United Kingdom'],
                ['Country' => 'United States'],
                ['Country' => 'Uruguay'],
                ['Country' => 'Uzbekistan'],
                ['Country' => 'Vanuatu'],
                ['Country' => 'Vatican City'],
                ['Country' => 'Venezuela'],
                ['Country' => 'Vietnam'],
                ['Country' => 'Wallis and Futuna'],
                ['Country' => 'Western Sahara'],
                ['Country' => 'Yemen'],
                ['Country' => 'Zambia'],
                ['Country' => 'Zimbabwe'],
            ];

            foreach($countries as $countryData){
                Country::create($countryData);
            }

            $nepal_country_id = Country::where('Country','Nepal')->value('id');

            $provinces = [
                ['Province' => 'Koshi', 'country_id' => $nepal_country_id],
                ['Province' => 'Madhesh', 'country_id' => $nepal_country_id],
                ['Province' => 'Bagmati', 'country_id' => $nepal_country_id],
                ['Province' => 'Gandaki', 'country_id' => $nepal_country_id],
                ['Province' => 'Lumbini', 'country_id' => $nepal_country_id],
                ['Province' => 'Karnali', 'country_id' => $nepal_country_id],
                ['Province' => 'Sudhurpaschim', 'country_id' => $nepal_country_id],
            ];

            foreach($provinces as $provincedata){
                Province::create($provincedata);
            }

            $province_koshi_id = Province::where('Province','Koshi')->value('id');
            $province_madhesh_id = Province::where('Province','Madhesh')->value('id');
            $province_bagmati_id = Province::where('Province','Bagmati')->value('id');
            $province_gandaki_id = Province::where('Province','Gandaki')->value('id');
            $province_lumbini_id = Province::where('Province','Lumbini')->value('id');
            $province_karnali_id = Province::where('Province','Karnali')->value('id');
            $province_sudurpaschim_id = Province::where('Province','Sudhurpaschim')->value('id');
            
           
            $district_bhojpur = District::create( ['District' => 'Bhojpur', 'province_id' => $province_koshi_id]);
            $district_dhankuta= District::create( ['District' => 'Dhankuta', 'province_id' => $province_koshi_id]);
            $district_ilam = District::create( ['District' => 'Ilam', 'province_id' => $province_koshi_id]);
            $district_jhapa = District::create( ['District' => 'Jhapa', 'province_id' => $province_koshi_id]);
            $district_khotang = District::create( ['District' => 'Khotang', 'province_id' => $province_koshi_id]);
            $district_morang = District::create( ['District' => 'Morang', 'province_id' => $province_koshi_id]);
            $district_okhaldhunga = District::create( ['District' => 'Okhaldhunga', 'province_id' => $province_koshi_id]);
            $district_panchthar = District::create( ['District' => 'Panchthar', 'province_id' => $province_koshi_id]);
            $district_sankhuwasabha = District::create( ['District' => 'Sankhuwasabha', 'province_id' => $province_koshi_id]);
            $district_solukhumbu = District::create( ['District' => 'Solukhumbu', 'province_id' => $province_koshi_id]);
            $district_sunsari = District::create( ['District' => 'Sunsari', 'province_id' => $province_koshi_id]);
            $district_taplejung = District::create( ['District' => 'Taplejung', 'province_id' => $province_koshi_id]);
            $district_terhathum = District::create( ['District' => 'Terhathum', 'province_id' => $province_koshi_id]);
            $district_udayapur = District::create( ['District' => 'Udayapur', 'province_id' => $province_koshi_id]);

            $district_saptari = District::create( ['District' => 'Saptari', 'province_id' => $province_madhesh_id]);
            $district_siraha = District::create( ['District' => 'Siraha', 'province_id' => $province_madhesh_id]);
            $district_dhanusa = District::create( ['District' => 'Dhanusa', 'province_id' => $province_madhesh_id]);
            $district_mahottari = District::create( ['District' => 'Mahottari', 'province_id' => $province_madhesh_id]);
            $district_sarlahi = District::create( ['District' => 'Sarlahi', 'province_id' => $province_madhesh_id]);
            $district_bara = District::create( ['District' => 'Bara', 'province_id' => $province_madhesh_id]);
            $district_parsa = District::create( ['District' => 'Parsa', 'province_id' => $province_madhesh_id]);
            $district_rautahat = District::create( ['District' => 'Rautahat', 'province_id' => $province_madhesh_id]);
    
            $district_sindhuli = District::create( ['District' => 'Sindhuli', 'province_id' => $province_bagmati_id]);
            $district_ramechhap = District::create( ['District' => 'Ramechhap', 'province_id' => $province_bagmati_id]);
            $district_dolakha = District::create( ['District' => 'Dolakha', 'province_id' => $province_bagmati_id]);
            $district_bhaktapur = District::create( ['District' => 'Bhaktapur', 'province_id' => $province_bagmati_id]);
            $district_dhading = District::create( ['District' => 'Dhading', 'province_id' => $province_bagmati_id]);
            $district_kathmandu = District::create( ['District' => 'Kathmandu', 'province_id' => $province_bagmati_id]);
            $district_kavrepalanchok = District::create( ['District' => 'Kavrepalanchok', 'province_id' => $province_bagmati_id]);
            $district_lalitpur = District::create( ['District' => 'Lalitpur', 'province_id' => $province_bagmati_id]);
            $district_nuwakot = District::create( ['District' => 'Nuwakot', 'province_id' => $province_bagmati_id]);
            $district_rasuwa = District::create( ['District' => 'Rasuwa', 'province_id' => $province_bagmati_id]);
            $district_sindhupalchok = District::create( ['District' => 'Sindhupalchok', 'province_id' => $province_bagmati_id]);
            $district_chitwan = District::create( ['District' => 'Chitwan', 'province_id' => $province_bagmati_id]);
            $district_makwanpur = District::create( ['District' => 'Makwanpur', 'province_id' => $province_bagmati_id]);

            $district_baglung = District::create( ['District' => 'Baglung', 'province_id' => $province_gandaki_id]);
            $district_gorkha = District::create( ['District' => 'Gorkha', 'province_id' => $province_gandaki_id]);
            $district_kaski = District::create( ['District' => 'Kaski', 'province_id' => $province_gandaki_id]);
            $district_lamjung = District::create( ['District' => 'Lamjung', 'province_id' => $province_gandaki_id]);
            $district_manang = District::create( ['District' => 'Manang', 'province_id' => $province_gandaki_id]);
            $district_mustang = District::create( ['District' => 'Mustang', 'province_id' => $province_gandaki_id]);
            $district_myagdi = District::create( ['District' => 'Myagdi', 'province_id' => $province_gandaki_id]);
            $district_nawalpur = District::create( ['District' => 'Nawalparasi - East of Bardaghat Susta', 'province_id' => $province_gandaki_id]);
            $district_parbat = District::create( ['District' => 'Parbat', 'province_id' => $province_gandaki_id]);
            $district_syangja = District::create( ['District' => 'Syangja', 'province_id' => $province_gandaki_id]);
            $district_tanahun = District::create( ['District' => 'Tanahun', 'province_id' => $province_gandaki_id]);

            $district_kapilvastu = District::create( ['District' => 'Kapilvastu', 'province_id' => $province_lumbini_id]);
            $district_parasi = District::create( ['District' => 'Nawalparasi - West of Bardaghat Susta', 'province_id' => $province_lumbini_id]);
            $district_rupandehi = District::create( ['District' => 'Rupandehi', 'province_id' => $province_lumbini_id]);
            $district_arghakhanchi = District::create( ['District' => 'Arghakhanchi', 'province_id' => $province_lumbini_id]);
            $district_gulmi = District::create( ['District' => 'Gulmi', 'province_id' => $province_lumbini_id]);
            $district_palpa = District::create( ['District' => 'Palpa', 'province_id' => $province_lumbini_id]);
            $district_dang = District::create( ['District' => 'Dang', 'province_id' => $province_lumbini_id]);
            $district_pyuthan = District::create( ['District' => 'Pyuthan', 'province_id' => $province_lumbini_id]);
            $district_rolpa = District::create( ['District' => 'Rolpa', 'province_id' => $province_lumbini_id]);
            $district_eastern_rukum = District::create( ['District' => 'Rukum - East Part', 'province_id' => $province_lumbini_id]);
            $district_banke = District::create( ['District' => 'Banke', 'province_id' => $province_lumbini_id]);
            $district_bardiya = District::create( ['District' => 'Bardiya', 'province_id' => $province_lumbini_id]);

            $district_western_rukum = District::create( ['District' => 'Rukum - West Part', 'province_id' => $province_karnali_id]);
            $district_salyan = District::create( ['District' => 'Salyan', 'province_id' => $province_karnali_id]);
            $district_dolpa = District::create( ['District' => 'Dolpa', 'province_id' => $province_karnali_id]);
            $district_humla = District::create( ['District' => 'Humla', 'province_id' => $province_karnali_id]);
            $district_jumla = District::create( ['District' => 'Jumla', 'province_id' => $province_karnali_id]);
            $district_kalikot = District::create( ['District' => 'Kalikot', 'province_id' => $province_karnali_id]);
            $district_mugu = District::create( ['District' => 'Mugu', 'province_id' => $province_karnali_id]);
            $district_surkhet = District::create( ['District' => 'Surkhet', 'province_id' => $province_karnali_id]);
            $district_dailekh = District::create( ['District' => 'Dailekh', 'province_id' => $province_karnali_id]);
            $district_jajarkot = District::create( ['District' => 'Jajarkot', 'province_id' => $province_karnali_id]);

            $district_kailali = District::create( ['District' => 'Kailali', 'province_id' => $province_sudurpaschim_id]);
            $district_achham = District::create( ['District' => 'Achham', 'province_id' => $province_sudurpaschim_id]);
            $district_doti = District::create( ['District' => 'Doti', 'province_id' => $province_sudurpaschim_id]);
            $district_bajhang = District::create( ['District' => 'Bajhang', 'province_id' => $province_sudurpaschim_id]);
            $district_bajura = District::create( ['District' => 'Bajura', 'province_id' => $province_sudurpaschim_id]);
            $district_kanchanpur = District::create( ['District' => 'Kanchanpur', 'province_id' => $province_sudurpaschim_id]);
            $district_dadeldhura = District::create( ['District' => 'Dadeldhura', 'province_id' => $province_sudurpaschim_id]);
            $district_baitadi = District::create( ['District' => 'Baitadi', 'province_id' => $province_sudurpaschim_id]);
            $district_darchula = District::create( ['District' => 'Darchula', 'province_id' => $province_sudurpaschim_id]);
            

           // $Bhojpur_villages =  ["Aamchowk","Arun","Bhojpur","Hatuwagadhi","Pauwadungma","Ramprasadrai","Salpasilichho","Shadananda","Tyamkemaiyum"];
            

            // foreach ($Bhojpur_villages as $bhojpur_village_name) {
            //     $village = Village::create(['Village' => $bhojpur_village_name, 'district_id' => $district_bhojpur->id]);
            //     // ${'village_' . strtolower($bhojpur_village_name) . '_id'} = $village->id;
                
            //     $village_wards = [];

            //     if ($bhojpur_village_name === "Aamchowk"){
            //         $village_wards = [1,2,3,4,5,6,7,8,9,10];
            //     }
            //     elseif($bhojpur_village_name === "Arun"){
            //         $village_wards = [1,2,3,4,5,6,7];
            //     }
            //     elseif($bhojpur_village_name === "Bhojpur"){
            //         $village_wards = [1,2,3,4,5,6,7,8,9,10,11,12];
            //     }
            //     elseif($bhojpur_village_name === "Hatuwagadhi"){
            //         $village_wards = [1,2,3,4,5,6,7,8,9];
            //     }
            //     elseif($bhojpur_village_name === "Pauwadungma"){
            //         $village_wards = [1,2,3,4,5,6];
            //     }
            //     elseif($bhojpur_village_name === "Ramprasadrai"){
            //         $village_wards = [1,2,3,4,5,6,7,8];
            //     }
            //     elseif($bhojpur_village_name === "Salpasilichho"){
            //         $village_wards = [1,2,3,4,5,6];
            //     }
            //     elseif($bhojpur_village_name === "Shadananda"){
            //         $village_wards = [1,2,3,4,5,6,7,8,9,10,11,12,13,14];
            //     }
            //     elseif($bhojpur_village_name === "Tyamkemaiyum"){
            //         $village_wards = [1,2,3,4,5,6,7,8,9];
            //     }
                
            //     foreach ($village_wards as $village_ward_no){
            //         $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
            //     }  
            // }

            $Bhojpur_villages = [
                "Aamchowk" => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10],
                "Arun" => [1, 2, 3, 4, 5, 6, 7],
                "Bhojpur" => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12],
                "Hatuwagadhi" => [1, 2, 3, 4, 5, 6, 7, 8, 9],
                "Pauwadungma" => [1, 2, 3, 4, 5, 6],
                "Ramprasadrai" => [1, 2, 3, 4, 5, 6, 7, 8],
                "Salpasilichho" => [1, 2, 3, 4, 5, 6],
                "Shadananda" => [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14],
                "Tyamkemaiyum" => [1, 2, 3, 4, 5, 6, 7, 8, 9],
            ];
            foreach ($Bhojpur_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_bhojpur->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }

            $Dhankuta_villages = [
                "Chhathar Jorpati" => [1,2,3,4,5,6],
                "Choubise" => [1,2,3,4,5,6,7,8],
                "Dhankuta" => [1,2,3,4,5,6,7,8,9,10],
                "Mahalaxmi"=> [1,2,3,4,5,6,7,8,9],
                "Pakhribas" => [1,2,3,4,5,6,7,8,9,10],
                "Sangurigadhi" => [1,2,3,4,5,6,7,8,9,10],
                "Shahidbhumi"=> [1,2,3,4,5,6,7],
            ];
            foreach ($Dhankuta_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_dhankuta->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Ilam_villages = [
                "Chulachuli" => [1,2,3,4,5,6], 
                "Deumai" => [1,2,3,4,5,6,7,8,9], 
                "Ilam" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Mai" => [1,2,3,4,5,6,7,8,9,10], 
                "Mai Jogmai" => [1,2,3,4,5,6], 
                "Mangsebung" => [1,2,3,4,5,6], 
                "Phakphokthum" => [1,2,3,4,5,6,7], 
                "Rong" => [1,2,3,4,5,6], 
                "Sandakpur" => [1,2,3,4,5], 
                "Suryodaya" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14],
            ];
            foreach ($Ilam_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_ilam->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Jhapa_villages = [
                "Arjundhara" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Barhadashi" => [1,2,3,4,5,6,7], 
                "Bhadrapur" => [1,2,3,4,5,6,7,8,9,10], 
                "Birtamod" => [1,2,3,4,5,6,7,8,9,10], 
                "Buddha Shanti" => [1,2,3,4,5,6,7], 
                "Damak" => [1,2,3,4,5,6,7,8,9,10], 
                "Gauradaha" => [1,2,3,4,5,6,7,8,9], 
                "Gaurigunj" => [1,2,3,4,5,6], 
                "Haldibari" => [1,2,3,4,5], 
                "Jhapa" => [1,2,3,4,5,6,7], 
                "Kachankawal" => [1,2,3,4,5,6,7], 
                "Kamal" => [1,2,3,4,5,6,7], 
                "Kankai" => [1,2,3,4,5,6,7,8,9], 
                "Mechinagar" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], 
                "Shivasatakshi" =>[1,2,3,4,5,6,7,8,9,10,11], 
            ];
            foreach ($Jhapa_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_jhapa->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Khotang_villages = [
                "Aiselukharka" => [1,2,3,4,5,6,7], 
                "Barahapokhari" => [1,2,3,4,5,6], 
                "Diprung" => [1,2,3,4,5,6,7], 
                "Halesi Tuwachung" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Jantedhunga" => [1,2,3,4,5,6], 
                "Kepilasgadhi" => [1,2,3,4,5,6,7], 
                "Khotehang" => [1,2,3,4,5,6,7,8,9], 
                "Rawa Besi" => [1,2,3,4,5,6], 
                "Rupakot Majhuwagadhi" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], 
                "Sakela" => [1,2,3,4,5], 
            ];
            foreach ($Khotang_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_khotang->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Morang_villages = [
                "Belbari" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Biratnagar" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19],
                "Budhiganga" => [1,2,3,4,5,6,7], 
                "Dhanapalthan" => [1,2,3,4,5,6,7], 
                "Gramthan" => [1,2,3,4,5,6,7], 
                "Jahada" => [1,2,3,4,5,6,7], 
                "Kanepokhari" => [1,2,3,4,5,6,7], 
                "Katahari" => [1,2,3,4,5,6,7], 
                "Kerabari" => [1,2,3,4,5,6,7,8,9,10], 
                "Letang" => [1,2,3,4,5,6,7,8,9], 
                "Miklajung" => [1,2,3,4,5,6,7,8,9], 
                "Pathari Shanishchare" => [1,2,3,4,5,6,7,8,9,10], 
                "Rangeli" => [1,2,3,4,5,6,7,8,9], 
                "Ratuwamai" => [1,2,3,4,5,6,7,8,9,10], 
                "Sunawarshi" => [1,2,3,4,5,6,7,8,9], 
                "Sundarharaicha" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Urlabari" => [1,2,3,4,5,6,7,8,9], 
            ];
            foreach ($Morang_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_morang->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Okhaldhunga_villages = [
                "Champadevi" => [1,2,3,4,5,6,7,8,9,10], 
                "Chishankhugadhi" => [1,2,3,4,5,6,7,8], 
                "Khijidemba" => [1,2,3,4,5,6,7,8,9], 
                "Likhu" => [1,2,3,4,5,6,7,8,9], 
                "Manebhanjyang" => [1,2,3,4,5,6,7,8,9], 
                "Molung" => [1,2,3,4,5,6,7,8], 
                "Siddhicharan" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Sunkoshi" => [1,2,3,4,5,6,7,8,9,10], 
            ];
            foreach ($Okhaldhunga_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_okhaldhunga->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Panchthar_villages = [
                "Hilihang" => [1,2,3,4,5,6,7], 
                "Kummayak" => [1,2,3,4,5], 
                "Miklajung" => [1,2,3,4,5,6,7,8], 
                "Phalelung" => [1,2,3,4,5,6,7,8], 
                "Phalgunanda" => [1,2,3,4,5,6,7], 
                "Phidim" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Tumbewa" => [1,2,3,4,5], 
                "Yangwarak" => [1,2,3,4,5,6], 
            ];
            foreach ($Panchthar_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_panchthar->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Sankhuwasabha_villages = [
                "Bhotkhola" => [1,2,3,4,5], 
                "Chainpur" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Chichila" => [1,2,3,4,5], 
                "Dharmadevi" => [1,2,3,4,5,6,7,8,9], 
                "Khandbari" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Madi" => [1,2,3,4,5,6,7,8,9], 
                "Makalu" => [1,2,3,4,5,6], 
                "Panchkhapan" => [1,2,3,4,5,6,7,8,9], 
                "Savapokhari" => [1,2,3,4,5,6], 
                "Silichong" => [1,2,3,4,5], 
            ];
            foreach ($Sankhuwasabha_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_sankhuwasabha->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Solukhumbu_villages = [
                "Dudhkoshi" => [1,2,3,4,5,6,7], 
                "Khumbu Pasanglhamu" => [1,2,3,4,5], 
                "Likhupike" => [1,2,3,4,5], 
                "Mahakulung" => [1,2,3,4,5], 
                "Nechasalyan" => [1,2,3,4,5], 
                "Solududhkunda" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Sotang" => [1,2,3,4,5], 
                "Thulung Dudhkoshi" => [1,2,3,4,5,6,7,8,9], 
            ];
            foreach ($Solukhumbu_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_solukhumbu->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Sunsari_villages = [
                "Baraha" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Barju" => [1,2,3,4,5,6], 
                "Bhokraha" => [1,2,3,4,5,6,7,8], 
                "Dewanganj" => [1,2,3,4,5,6,7], 
                "Dharan" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20], 
                "Duhabi" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Gadhi" => [1,2,3,4,5,6], 
                "Harinagara" => [1,2,3,4,5,6,7], 
                "Inaruwa" => [1,2,3,4,5,6,7,8,9,10], 
                "Itahari" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20], 
                "Koshi" => [1,2,3,4,5,6,7,8], 
                "Ramdhuni" => [1,2,3,4,5,6,7,8,9], 
            ];
            foreach ($Sunsari_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_sunsari->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Taplejung_villages = [
                "Aathrai Triveni" => [1,2,3,4,5], 
                "Maiwa Khola" => [1,2,3,4,5,6], 
                "Meringden" => [1,2,3,4,5,6], 
                "Mikwa Khola" => [1,2,3,4,5], 
                "Pathibhara Yangwarak" => [1,2,3,4,5,6], 
                "Phaktanglung" => [1,2,3,4,5,6,7], 
                "Phungling" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Sidingwa" => [1,2,3,4,5,6,7], 
                "Sirijangha" =>[1,2,3,4,5,6,7,8], 
            ];
            foreach ($Taplejung_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_taplejung->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Terhathum_villages = [
                "Aathrai" => [1,2,3,4,5,6,7], 
                "Chhathar" => [1,2,3,4,5,6], 
                "Laligurans" => [1,2,3,4,5,6,7,8,9], 
                "Menchhayayem" => [1,2,3,4,5,6], 
                "Myanglung" => [1,2,3,4,5,6,7,8,9,10], 
                "Phedap" => [1,2,3,4,5], 
            ];
            foreach ($Terhathum_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_terhathum->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Udayapur_villages = [
                "Belaka" => [1,2,3,4,5,6,7,8,9], 
                "Chaudandigadhi" => [1,2,3,4,5,6,7,8,9,10], 
                "Katari" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Limchungbung" => [1,2,3,4,5], 
                "Rautamai" => [1,2,3,4,5,6,7,8], 
                "Tapli" => [1,2,3,4,5], 
                "Triyuga" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16], 
                "Udayapurgadhi" => [1,2,3,4,5,6,7,8], 
            ];
            foreach ($Udayapur_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_udayapur->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Bara_villages = [
                "Aadarsha Kotwal" => [1,2,3,4,5,6,7,8], 
                "Baragadhi" => [1,2,3,4,5,6], 
                "Bishrampur" => [1,2,3,4,5], 
                "Devtal" => [1,2,3,4,5,6,7], 
                "Jeetpur Simara" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24], 
                "Kalaiya" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27], 
                "Karaiyamai" => [1,2,3,4,5,6,7,8], 
                "Kolhabi" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Mahagadimai" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Nijgadh" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Pachrauta" => [1,2,3,4,5,6,7,8,9], 
                "Parwanipur" => [1,2,3,4,5], 
                "Pheta" => [1,2,3,4,5,6,7], 
                "Prasauni" => [1,2,3,4,5,6,7], 
                "Simraungadh" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Suwarna" => [1,2,3,4,5,6,7,8], 
            ];
            foreach ($Bara_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_bara->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Dhanusa_villages = [
                "Aurahi" => [1,2,3,4,5,6], 
                "Bateshwor" => [1,2,3,4,5], 
                "Bideha" => [1,2,3,4,5,6,7,8,9], 
                "Dhanauji" => [1,2,3,4,5], 
                "Dhanushadham" => [1,2,3,4,5,6,7,8,9], 
                "Ganeshman Charnath" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Hansapur" => [1,2,3,4,5,6,7,8,9], 
                "Janaknandini" => [1,2,3,4,5,6], 
                "Janakpur" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25], 
                "Kamala" => [1,2,3,4,5,6,7,8,9], 
                "Kshireshwornath" => [1,2,3,4,5,6,7,8,9,10], 
                "Laxminiya" => [1,2,3,4,5,6,7], 
                "Mithila" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Mithila Bihari" => [1,2,3,4,5,6,7,8,9,10], 
                "Mukhiyapatti Musaharmiya" => [1,2,3,4,5,6], 
                "Nagrain" => [1,2,3,4,5,6,7,8,9], 
                "Sabaila" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Shahidnagar" => [1,2,3,4,5,6,7,8,9], 
            ];
            foreach ($Dhanusa_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_dhanusa->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Mahottari_villages = [
                "Aurahi" => [1,2,3,4,5,6,7,8,9], 
                "Balwa" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Bardibas" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Bhagaha" => [1,2,3,4,5,6,7,8,9], 
                "Ekdara" => [1,2,3,4,5,6], 
                "Gaushala" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Jaleshwor" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Loharpatti" => [1,2,3,4,5,6,7,8,9], 
                "Mahottari" => [1,2,3,4,5,6], 
                "Manra Shiswa" => [1,2,3,4,5,6,7,8,9,10], 
                "Matihani" => [1,2,3,4,5,6,7,8,9], 
                "Pipra" => [1,2,3,4,5,6,7], 
                "Ramgopalpur" => [1,2,3,4,5,6,7,8,9], 
                "Samsi" => [1,2,3,4,5,6,7], 
                "Sonma" =>[1,2,3,4,5,6,7,8], 
            ];
            foreach ($Mahottari_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_mahottari->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Parsa_villages = [
                "Bahudarmai" => [1,2,3,4,5,6,7,8,9], 
                "Bindabasini" => [1,2,3,4,5], 
                "Birgunj" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32],
                "Chhipaharmai" => [1,2,3,4,5], 
                "Dhobini" => [1,2,3,4,5], 
                "Jagarnathpur" => [1,2,3,4,5,6], 
                "Jira Bhawani" => [1,2,3,4,5], 
                "Kalikamai" => [1,2,3,4,5], 
                "Pakaha Mainpur" => [1,2,3,4,5], 
                "Parsagadhi" => [1,2,3,4,5,6,7,8,9], 
                "Paterwa Sugauli" => [1,2,3,4,5], 
                "Pokhariya" => [1,2,3,4,5,6,7,8,9,10], 
                "Sakhuwa Prasauni" => [1,2,3,4,5,6], 
                "Thori" => [1,2,3,4,5], 
            ];
            foreach ($Parsa_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_parsa->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Rautahat_villages = [
                "Baudhimai" => [1,2,3,4,5,6,7,8,9], 
                "Brindawan" => [1,2,3,4,5,6,7,8,9], 
                "Chandrapur" => [1,2,3,4,5,6,7,8,9], 
                "Dewahi Gonahi" => [1,2,3,4,5,6,7,8,9], 
                "Durga Bhagawati" => [1,2,3,4,5], 
                "Gadhimai" => [1,2,3,4,5,6,7,8,9], 
                "Garuda" => [1,2,3,4,5,6,7,8,9], 
                "Gaur" => [1,2,3,4,5,6,7,8,9], 
                "Gujara" => [1,2,3,4,5,6,7,8,9], 
                "Ishnath" => [1,2,3,4,5,6,7,8,9], 
                "Katahariya" => [1,2,3,4,5,6,7,8,9], 
                "Madhav Narayan" => [1,2,3,4,5,6,7,8,9], 
                "Maulapur" => [1,2,3,4,5,6,7,8,9], 
                "Paroha" => [1,2,3,4,5,6,7,8,9], 
                "Phatuwabijaypur" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Rajdevi" => [1,2,3,4,5,6,7,8,9], 
                "Rajpur" => [1,2,3,4,5,6,7,8,9], 
                "Yamunamai" => [1,2,3,4,5], 
            ];
            foreach ($Rautahat_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_rautahat->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Saptari_villages = [
                "Agnisair Krishnasawaran" => [1,2,3,4,5,6], 
                "Balanbihul" => [1,2,3,4,5,6], 
                "Bishnupur" => [1,2,3,4,5,6,7], 
                "Bodebarsain" => [1,2,3,4,5,6,7,8,9,10], 
                "Chhinnamasta" => [1,2,3,4,5,6,7], 
                "Dakneshwori" => [1,2,3,4,5,6,7,8,9,10], 
                "Hanumannagar Kankalini" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Kanchanrup" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Khadak" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Mahadeva" => [1,2,3,4,5,6], 
                "Rajbiraj" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16], 
                "Rajgadh" => [1,2,3,4,5,6], 
                "Rupani" => [1,2,3,4,5,6], 
                "Saptakoshi" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Shambhunath" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Surunga" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Tilathi Koiladi" => [1,2,3,4,5,6,7,8], 
                "Tirahut" => [1,2,3,4,5], 
            ];
            foreach ($Saptari_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_saptari->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Sarlahi_villages = [
                "Bagmati" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Balra" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Barhathwa" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18], 
                "Basbariya" => [1,2,3,4,5,6], 
                "Bishnu" => [1,2,3,4,5,6,7,8], 
                "Brahmapuri" => [1,2,3,4,5,6,7], 
                "Chakraghatta" => [1,2,3,4,5,6,7,8,9], 
                "Chandranagar" => [1,2,3,4,5,6,7], 
                "Dhankaul" => [1,2,3,4,5,6,7], 
                "Godaita" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Harion" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Haripur" => [1,2,3,4,5,6,7,8,9], 
                "Haripurwa" => [1,2,3,4,5,6,7,8,9], 
                "Ishworpur" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], 
                "Kaudena" => [1,2,3,4,5,6,7], 
                "Kawilasi" => [1,2,3,4,5,6,7,8,9,10], 
                "Lalbandi" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17], 
                "Malangwa" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Parsa" => [1,2,3,4,5,6,7], 
                "Ramnagar" => [1,2,3,4,5,6,7], 
            ];
            foreach ($Sarlahi_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_sarlahi->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Siraha_villages = [
                "Anarma" => [1,2,3,4,5], 
                "Aurahi" => [1,2,3,4,5], 
                "Bariyapatti" => [1,2,3,4,5], 
                "Bhagwanpur" => [1,2,3,4,5], 
                "Bishnupur" => [1,2,3,4,5], 
                "Dhangadhimai" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Golbazar" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Kalyanpur" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Karjanha" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Lahan" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24], 
                "Laxmipur Patari" => [1,2,3,4,5,6], 
                "Mirchaiya" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Naraha" => [1,2,3,4,5], 
                "Nawarajpur" => [1,2,3,4,5], 
                "Sakhuwanankarkatti" => [1,2,3,4,5], 
                "Siraha" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22], 
                "Sukhipur" =>[1,2,3,4,5,6,7,8,9,10], 
            ];
            foreach ($Siraha_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_siraha->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Bhaktapur_villages = [
                "Bhaktapur" => [1,2,3,4,5,6,7,8,9,10], 
                "Changunarayan" => [1,2,3,4,5,6,7,8,9], 
                "Madhyapur Thimi" => [1,2,3,4,5,6,7,8,9], 
                "Suryabinayak" => [1,2,3,4,5,6,7,8,9,10], 
            ];
            foreach ($Bhaktapur_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_bhaktapur->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Chitwan_villages = [
                "Bharatpur" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29],
                "Ichchhakamana" => [1,2,3,4,5,6,7], 
                "Kalika" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Khairhani" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Madi" => [1,2,3,4,5,6,7,8,9], 
                "Rapti" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Ratnanagar" =>[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16], 
            ];
            foreach ($Chitwan_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_chitwan->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Dhading_villages = [
                "Benighat Rorang" => [1,2,3,4,5,6,7,8,9,10], 
                "Dhunibeshi" => [1,2,3,4,5,6,7,8,9], 
                "Gajuri" => [1,2,3,4,5,6,7,8], 
                "Galchhi" => [1,2,3,4,5,6,7,8], 
                "Gangajamuna" => [1,2,3,4,5,6,7], 
                "Jwalamukhi" => [1,2,3,4,5,6,7], 
                "Khaniyabas" => [1,2,3,4,5], 
                "Neelakantha" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Netrawati" => [1,2,3,4,5], 
                "Rubi Valley" => [1,2,3,4,5,6], 
                "Siddhalek" => [1,2,3,4,5,6,7], 
                "Thakre" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Tripurasundari" =>[1,2,3,4,5,6,7], 
            ];
            foreach ($Dhading_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_dhading->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Dolakha_villages = [
                "Baiteshwor" => [1,2,3,4,5,6,7,8], 
                "Bhimeshwor" => [1,2,3,4,5,6,7,8,9], 
                "Bigu" => [1,2,3,4,5,6,7,8], 
                "Gaurishankar" => [1,2,3,4,5,6,7,8,9], 
                "Jiri" => [1,2,3,4,5,6,7,8,9], 
                "Kalinchowk" => [1,2,3,4,5,6,7,8,9], 
                "Melung" => [1,2,3,4,5,6,7], 
                "Shailung" => [1,2,3,4,5,6,7,8], 
                "Tamakoshi" =>[1,2,3,4,5,6,7], 
            ];
            foreach ($Dolakha_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_dolakha->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Kathmandu_villages = [
                "Budhanilkantha" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Chandragiri" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], 
                "Dakshinkali" => [1,2,3,4,5,6,7,8,9], 
                "Gokarneshwor" => [1,2,3,4,5,6,7,8,9],
                "Kageshwori Manohara" => [1,2,3,4,5,6,7,8,9], 
                "Kathmandu" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32],
                "Kirtipur" => [1,2,3,4,5,6,7,8,9,10], 
                "Nagarjun" => [1,2,3,4,5,6,7,8,9,10], 
                "Shankharapur" => [1,2,3,4,5,6,7,8,9], 
                "Tarakeshwor" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Tokha" =>[1,2,3,4,5,6,7,8,9,10,11], 
            ];
            foreach ($Kathmandu_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_kathmandu->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Kavrepalanchok_villages = [
                "Banepa" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Bethanchowk" => [1,2,3,4,5,6], 
                "Bhumlu" => [1,2,3,4,5,6,7,8,9,10], 
                "Chaurideurali" => [1,2,3,4,5,6,7,8,9], 
                "Dhulikhel" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Khanikhola" => [1,2,3,4,5,6,7], 
                "Mahabharat" => [1,2,3,4,5,6,7,8], 
                "Mandandeupur" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Namobuddha" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Panauti" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Panchkhal" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Roshi" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Temal" =>[1,2,3,4,5,6,7,8,9], 
            ];
            foreach ($Kavrepalanchok_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_kavrepalanchok->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Lalitpur_villages = [
                "Bagmati" => [1,2,3,4,5,6,7], 
                "Godawari" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Konjyosom" => [1,2,3,4,5], 
                "Lalitpur" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29],
                "Mahalaxmi" => [1,2,3,4,5,6,7,8,9,10], 
                "Mahankal" => [1,2,3,4,5,6], 
            ];
            foreach ($Lalitpur_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_lalitpur->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Makwanpur_villages = [
                "Bagmati" => [1,2,3,4,5,6,7,8,9], 
                "Bakaiya" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Bhimphedi" => [1,2,3,4,5,6,7,8,9], 
                "Hetauda" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], 
                "Indrasarowar" => [1,2,3,4,5], 
                "Kailash" => [1,2,3,4,5,6,7,8,9,10], 
                "Makawanpurgadhi" => [1,2,3,4,5,6,7,8], 
                "Manahari" => [1,2,3,4,5,6,7,8,9], 
                "Raksirang" => [1,2,3,4,5,6,7,8,9], 
                "Thaha" => [1,2,3,4,5,6,7,8,9,10,11,12], 
            ];
            foreach ($Makwanpur_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_makwanpur->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Nuwakot_villages = [
                "Belkotgadhi" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Bidur" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Dupcheshwor" => [1,2,3,4,5,6,7], 
                "Kakani" => [1,2,3,4,5,6,7,8], 
                "Kispang" => [1,2,3,4,5], 
                "Likhu" => [1,2,3,4,5,6], 
                "Meghang" => [1,2,3,4,5,6], 
                "Panchakanya" => [1,2,3,4,5], 
                "Shivapuri" => [1,2,3,4,5,6,7,8], 
                "Suryagadhi" => [1,2,3,4,5], 
                "Tadi" => [1,2,3,4,5,6], 
                "Tarakeshwor" => [1,2,3,4,5,6], 
            ];
            foreach ($Nuwakot_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_nuwakot->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Ramechhap_villages = [
                "Doramba" => [1,2,3,4,5,6,7], 
                "Gokulganga" => [1,2,3,4,5,6], 
                "Khandadevi" => [1,2,3,4,5,6,7,8,9], 
                "Likhu Tamakoshi" => [1,2,3,4,5,6,7], 
                "Manthali" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Ramechhap" => [1,2,3,4,5,6,7,8,9], 
                "Sunapati" => [1,2,3,4,5], 
                "Umakunda" => [1,2,3,4,5,6,7], 
            ];
            foreach ($Ramechhap_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_ramechhap->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Rasuwa_villages = [
                "Gosaikunda" => [1,2,3,4,5,6], 
                "Kalika" => [1,2,3,4,5], 
                "Naukunda" => [1,2,3,4,5,6], 
                "Aamachhodingmo" => [1,2,3,4,5], 
                "Uttargaya" =>[1,2,3,4,5], 
            ];
            foreach ($Rasuwa_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_rasuwa->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Sindhuli_villages = [
                "Dudhauli" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Ghyanglekh" => [1,2,3,4,5], 
                "Golanjor" => [1,2,3,4,5,6,7], 
                "Hariharpurgadhi" => [1,2,3,4,5,6,7,8], 
                "Kamalamai" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Marin" => [1,2,3,4,5,6,7], 
                "Phikkal" => [1,2,3,4,5,6], 
                "Sunkoshi" => [1,2,3,4,5,6,7], 
                "Tinpatan" =>[1,2,3,4,5,6,7,8,9,10,11], 
            ];
            foreach ($Sindhuli_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_sindhuli->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Sindhupalchok_villages = [
                "Bahrabise" => [1,2,3,4,5,6,7,8,9], 
                "Balephi" => [1,2,3,4,5,6,7,8], 
                "Bhotekoshi" => [1,2,3,4,5], 
                "Chautara Sangachowkgadhi" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Helambu" => [1,2,3,4,5,6,7], 
                "Indrawati" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Jugal" => [1,2,3,4,5,6,7], 
                "Lisankhupakhar" => [1,2,3,4,5,6,7], 
                "Melamchi" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Panchpokhari Thangpal" => [1,2,3,4,5,6,7,8], 
                "Sunkoshi" => [1,2,3,4,5,6,7], 
                "Tripurasundari" => [1,2,3,4,5,6], 
            ];
            foreach ($Sindhupalchok_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_sindhupalchok->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Baglung_villages = [
                "Badigad" => [1,2,3,4,5,6,7,8,9,10], 
                "Baglung" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Bareng" => [1,2,3,4,5], 
                "Dhorpatan" => [1,2,3,4,5,6,7,8,9,10], 
                "Galkot" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Jaimini" => [1,2,3,4,5,6,7,8,9,10], 
                "Kathekhola" => [1,2,3,4,5,6,7,8], 
                "Nisikhola" => [1,2,3,4,5,6,7], 
                "Tamankhola" => [1,2,3,4,5,6], 
                "Tarakhola" => [1,2,3,4,5], 
            ];
            foreach ($Baglung_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_baglung->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Gorkha_villages = [
                "Aarughat" => [1,2,3,4,5,6,7,8,9,10], 
                "Ajirkot" => [1,2,3,4,5], 
                "Barpak Sulikot" => [1,2,3,4,5,6,7,8], 
                "Bhimsen" => [1,2,3,4,5,6,7,8], 
                "Chumanuwri" => [1,2,3,4,5,6,7], 
                "Dharche" => [1,2,3,4,5,6,7], 
                "Gandaki" => [1,2,3,4,5,6,7,8], 
                "Gorkha" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Palungtar" => [1,2,3,4,5,6,7,8,9,10], 
                "Shahid Lakhan" => [1,2,3,4,5,6,7,8,9], 
                "Siranchok" =>[1,2,3,4,5,6,7,8], 
            ];
            foreach ($Gorkha_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_gorkha->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Kaski_villages = [
                "Annapurna" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Machhapuchhre" => [1,2,3,4,5,6,7,8,9], 
                "Madi" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Pokhara" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33],
                "Rupa" =>[1,2,3,4,5,6,7], 
            ];
            foreach ($Kaski_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_kaski->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Lamjung_villages = [
                "Besishahar" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Dordi" => [1,2,3,4,5,6,7,8,9], 
                "Dudhpokhari" => [1,2,3,4,5,6], 
                "Kwholasothar" => [1,2,3,4,5,6,7,8,9], 
                "Madhyanepal" => [1,2,3,4,5,6,7,8,9,10], 
                "Marsyangdi" => [1,2,3,4,5,6,7,8,9], 
                "Rainas" => [1,2,3,4,5,6,7,8,9,10], 
                "Sundarbazar" => [1,2,3,4,5,6,7,8,9,10,11], 
            ];
            foreach ($Lamjung_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_lamjung->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Manang_villages = [
                "Chame" => [1,2,3,4,5], 
                "Manang Ngisyang" => [1,2,3,4,5,6,7,8,9], 
                "Narpa Bhumi" => [1,2,3,4,5], 
                "Nason" => [1,2,3,4,5,6,7,8,9], 
            ];
            foreach ($Manang_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_manang->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Mustang_villages = [
                "Bahragau Muktichhetra" => [1,2,3,4,5], 
                "Lo-Ghekar Damodarkunda" => [1,2,3,4,5], 
                "Gharapjhong" => [1,2,3,4,5], 
                "Lomanthang" => [1,2,3,4,5], 
                "Thasang" =>[1,2,3,4,5], 
            ];
            foreach ($Mustang_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_mustang->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Myagdi_villages = [
                "Annapurna" => [1,2,3,4,5,6,7,8], 
                "Beni" => [1,2,3,4,5,6,7,8,9,10], 
                "Dhawalagiri" => [1,2,3,4,5,6,7], 
                "Malika" => [1,2,3,4,5,6,7], 
                "Mangala" => [1,2,3,4,5], 
                "Raghuganga" => [1,2,3,4,5,6,7,8], 
            ];
            foreach ($Myagdi_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_myagdi->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Nawalpur_villages = [
                "Binayi Tribeni" => [1,2,3,4,5,6,7], 
                "Bulingtar" => [1,2,3,4,5,6], 
                "Bungdikali" => [1,2,3,4,5,6], 
                "Devchuli" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17], 
                "Gaindakot" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18], 
                "Hupsekot" => [1,2,3,4,5,6], 
                "Kawasoti" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17], 
                "Madhyabindu" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], 
            ];
            foreach ($Nawalpur_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_nawalpur->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Parbat_villages = [
                "Bihadi" => [1,2,3,4,5,6], 
                "Jaljala" => [1,2,3,4,5,6,7,8,9], 
                "Kushma" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Mahashila" => [1,2,3,4,5,6], 
                "Modi" => [1,2,3,4,5,6,7,8], 
                "Paiyun" => [1,2,3,4,5,6,7], 
                "Phalewas" =>[1,2,3,4,5,6,7,8,9,10,11], 
            ];
            foreach ($Parbat_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_parbat->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Syangja_villages = [
                "Aandhikhola" => [1,2,3,4,5,6], 
                "Arjunchaupari" => [1,2,3,4,5,6], 
                "Bheerkot" => [1,2,3,4,5,6,7,8,9], 
                "Biruwa" => [1,2,3,4,5,6,7,8], 
                "Chapakot" => [1,2,3,4,5,6,7,8,9,10], 
                "Galyang" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Harinas" => [1,2,3,4,5,6,7], 
                "Kaligandaki" => [1,2,3,4,5,6,7], 
                "Phedikhola" => [1,2,3,4,5], 
                "Putalibazar" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Waling" =>[1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
            ];
            foreach ($Syangja_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_syangja->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Tanahun_villages = [
                "Aanbookhaireni" => [1,2,3,4,5,6], 
                "Bandipur" => [1,2,3,4,5,6], 
                "Bhanu" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Bhimad" => [1,2,3,4,5,6,7,8,9], 
                "Devghat" => [1,2,3,4,5], 
                "Ghiring" => [1,2,3,4,5], 
                "Myagde" => [1,2,3,4,5,6,7], 
                "Rishing" => [1,2,3,4,5,6], 
                "Shuklagandaki" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Vyas" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
            ];
            foreach ($Tanahun_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_tanahun->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Arghakhanchi_villages = [
                "Bhumikasthan" => [1,2,3,4,5,6,7,8,9,10], 
                "Chhatradev" => [1,2,3,4,5,6,7,8], 
                "Malarani" => [1,2,3,4,5,6,7,8,9], 
                "Panini" => [1,2,3,4,5,6,7,8], 
                "Sandhikharka" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Shitaganga" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
            ];
            foreach ($Arghakhanchi_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_arghakhanchi->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Banke_villages = [
                "Baijanath" => [1,2,3,4,5,6,7,8], 
                "Duduwa" => [1,2,3,4,5,6], 
                "Janaki" => [1,2,3,4,5,6], 
                "Khajura" => [1,2,3,4,5,6,7,8], 
                "Kohalpur" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], 
                "Narainapur" => [1,2,3,4,5,6], 
                "Nepalgunj" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23], 
                "Rapti Sonari" => [1,2,3,4,5,6,7,8,9], 
            ];
            foreach ($Banke_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_banke->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Bardiya_villages = [
                "Badhaiyatal" => [1,2,3,4,5,6,7,8,9], 
                "Bansgadhi" => [1,2,3,4,5,6,7,8,9], 
                "Barbardiya" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Geruwa" => [1,2,3,4,5,6], 
                "Gulariya" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Madhuwan" => [1,2,3,4,5,6,7,8,9], 
                "Rajapur" => [1,2,3,4,5,6,7,8,9,10], 
                "Thakurbaba" => [1,2,3,4,5,6,7,8,9], 
            ];
            foreach ($Bardiya_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_bardiya->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Dang_villages = [
                "Babai" => [1,2,3,4,5,6,7], 
                "Bangalachuli" => [1,2,3,4,5,6,7,8], 
                "Dangisharan" => [1,2,3,4,5,6,7], 
                "Gadhawa" => [1,2,3,4,5,6,7,8], 
                "Ghorahi" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], 
                "Lamahi" => [1,2,3,4,5,6,7,8,9], 
                "Rajpur" => [1,2,3,4,5,6,7], 
                "Rapti" => [1,2,3,4,5,6,7,8,9], 
                "Shantinagar" => [1,2,3,4,5,6,7], 
                "Tulsipur" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], 
            ];
            foreach ($Dang_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_dang->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Gulmi_villages = [
                "Chandrakot" => [1,2,3,4,5,6,7,8], 
                "Chhatrakot" => [1,2,3,4,5,6], 
                "Dhurkot" => [1,2,3,4,5,6,7], 
                "Gulmi Darbar" => [1,2,3,4,5,6,7], 
                "Ishma" => [1,2,3,4,5,6], 
                "Kaligandaki" => [1,2,3,4,5,6,7], 
                "Madane" => [1,2,3,4,5,6,7], 
                "Malika" => [1,2,3,4,5,6,7,8], 
                "Musikot" => [1,2,3,4,5,6,7,8,9], 
                "Resunga" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Ruru" => [1,2,3,4,5,6], 
                "Satyawati" => [1,2,3,4,5,6,7,8], 
            ];
            foreach ($Gulmi_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_gulmi->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Kapilvastu_villages = [
                "Banganga" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Bijaynagar" => [1,2,3,4,5,6,7], 
                "Buddhabhumi" => [1,2,3,4,5,6,7,8,9,10], 
                "Kapilvastu" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Krishnanagar" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Maharajgunj" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Mayadevi" => [1,2,3,4,5,6,7,8], 
                "Shivraj" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Shuddhodhan" => [1,2,3,4,5,6], 
                "Yasodhara" => [1,2,3,4,5,6,7,8], 
            ];
            foreach ($Kapilvastu_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_kapilvastu->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $parasi_villages = [
                "Bardghat" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16], 
                "Palhinandan" => [1,2,3,4,5,6], 
                "Pratappur" => [1,2,3,4,5,6,7,8,9], 
                "Ramgram" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18], 
                "Sarawal" => [1,2,3,4,5,6,7], 
                "Sunwal" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Susta" =>[1,2,3,4,5], 
            ];
            foreach ($parasi_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_parasi->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Palpa_villages = [
                "Baganaskali" => [1,2,3,4,5,6,7,8,9], 
                "Mathagadhi" => [1,2,3,4,5,6,7,8], 
                "Nisdi" => [1,2,3,4,5,6,7], 
                "Purbakhola" => [1,2,3,4,5,6], 
                "Rainadevi Chhahara" => [1,2,3,4,5,6,7,8], 
                "Rambha" => [1,2,3,4,5], 
                "Rampur" => [1,2,3,4,5,6,7,8,9,10], 
                "Ribdikot" => [1,2,3,4,5,6,7,8], 
                "Tansen" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Tinau" => [1,2,3,4,5,6], 
            ];
            foreach ($Palpa_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_palpa->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Pyuthan_villages = [
                "Airawati" => [1,2,3,4,5,6], 
                "Gaumukhi" => [1,2,3,4,5,6,7], 
                "Jhimruk" => [1,2,3,4,5,6,7,8], 
                "Mallarani" => [1,2,3,4,5], 
                "Mandavi" => [1,2,3,4,5], 
                "Naubahini" => [1,2,3,4,5,6,7,8], 
                "Pyuthan" => [1,2,3,4,5,6,7,8,9,10], 
                "Sarumarani" => [1,2,3,4,5,6], 
                "Swargadwari" =>[1,2,3,4,5,6,7,8,9], 
            ];
            foreach ($Pyuthan_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_pyuthan->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Rolpa_villages = [
                "Paribartan" => [1,2,3,4,5,6],
                "Lungri" => [1,2,3,4,5,6,7], 
                "Madi" => [1,2,3,4,5,6], 
                "Rolpa" => [1,2,3,4,5,6,7,8,9,10], 
                "Runtigadhi" => [1,2,3,4,5,6,7,8,9], 
                "Gangadev" => [1,2,3,4,5,6,7],
                "Sunchhahari" => [1,2,3,4,5,6,7], 
                "Sunil Smriti" => [1,2,3,4,5,6,7,8], 
                "Thabang" => [1,2,3,4,5], 
                "Triveni" => [1,2,3,4,5,6,7], 
            ];
            foreach ($Rolpa_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_rolpa->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Eastern_Rukum_villages = [
                "Bhume" => [1,2,3,4,5,6,7,8,9], 
                "Putha Uttarganga" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Sisne" =>[1,2,3,4,5,6,7,8], 
            ];
            foreach ($Eastern_Rukum_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_eastern_rukum ->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Rupandehi_villages = [
                "Butwal" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], 
                "Devdaha" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Gaidahawa" => [1,2,3,4,5,6,7,8,9], 
                "Kanchan" => [1,2,3,4,5], 
                "Kotahimai" => [1,2,3,4,5,6,7], 
                "Lumbini Sanskritik" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Marchawari" => [1,2,3,4,5,6,7], 
                "Mayadevi" => [1,2,3,4,5,6,7,8], 
                "Omsatiya" => [1,2,3,4,5,6], 
                "Rohini" => [1,2,3,4,5,6,7], 
                "Sainamaina" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Sammarimai" => [1,2,3,4,5,6,7], 
                "Shuddhodhan" => [1,2,3,4,5,6,7], 
                "Siddharthanagar" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Siyari" => [1,2,3,4,5,6,7], 
                "Tilottama" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17], 
            ];
            foreach ($Rupandehi_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_rupandehi->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Dailekh_villages = [
                "Aathabis" => [1,2,3,4,5,6,7,8,9], 
                "Bhagawatimai" => [1,2,3,4,5,6,7], 
                "Bhairabi" => [1,2,3,4,5,6,7], 
                "Chamunda Bindrasaini" => [1,2,3,4,5,6,7,8,9], 
                "Dullu" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Dungeshwor" => [1,2,3,4,5,6], 
                "Gurans" => [1,2,3,4,5,6,7,8], 
                "Mahabu" => [1,2,3,4,5,6], 
                "Narayan" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Naumule" => [1,2,3,4,5,6,7,8], 
                "Thantikandh" =>[1,2,3,4,5,6], 
            ];
            foreach ($Dailekh_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_dailekh->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Dolpa_villages = [
                "Chharka Tangsong" => [1,2,3,4,5,6], 
                "Dolpobuddha" => [1,2,3,4,5,6], 
                "Jagdulla" => [1,2,3,4,5,6], 
                "Kaike" => [1,2,3,4,5,6,7], 
                "Mudkechula" => [1,2,3,4,5,6,7,8,9], 
                "Shephoksundo" => [1,2,3,4,5,6,7,8,9], 
                "Thuli Bheri" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Tripurasundari" => [1,2,3,4,5,6,7,8,9,10,11], 
            ];
            foreach ($Dolpa_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_dolpa->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Humla_villages = [
                "Adanchuli" => [1,2,3,4,5,6], 
                "Chankheli" => [1,2,3,4,5,6], 
                "Kharpunath" => [1,2,3,4,5], 
                "Namkha" => [1,2,3,4,5,6], 
                "Sarkegad" => [1,2,3,4,5,6,7,8], 
                "Simkot" => [1,2,3,4,5,6,7,8], 
                "Tajakot" =>[1,2,3,4,5], 
            ];
            foreach ($Humla_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_humla->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Jajarkot_villages = [
                "Barekot" => [1,2,3,4,5,6,7,8,9], 
                "Bheri" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Chhedagad" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Junichaande" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Kushe" => [1,2,3,4,5,6,7,8,9], 
                "Shibalaya" => [1,2,3,4,5,6,7,8,9], 
                "Nalgad" =>[1,2,3,4,5,6,7,8,9,10,11,12,13], 
            ];
            foreach ($Jajarkot_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_jajarkot->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Jumla_villages = [
                "Chandannath" => [1,2,3,4,5,6,7,8,9,10], 
                "Guthichaur" => [1,2,3,4,5], 
                "Hima" => [1,2,3,4,5,6,7], 
                "Kankasundari" => [1,2,3,4,5,6,7,8], 
                "Patarasi" => [1,2,3,4,5,6,7], 
                "Sinja" => [1,2,3,4,5,6], 
                "Tatopani" => [1,2,3,4,5,6,7,8], 
                "Tila" => [1,2,3,4,5,6,7,8,9], 
            ];
            foreach ($Jumla_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_jumla->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Kalikot_villages = [
                "Shuva Kalika" => [1,2,3,4,5,6,7,8], 
                "Khandachakra" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Mahawai" => [1,2,3,4,5,6,7], 
                "Narharinath" => [1,2,3,4,5,6,7,8,9], 
                "Pachaljharana" => [1,2,3,4,5,6,7,8,9], 
                "Palata" => [1,2,3,4,5,6,7,8,9], 
                "Raskot" => [1,2,3,4,5,6,7,8,9], 
                "Sanni Triveni" => [1,2,3,4,5,6,7,8,9], 
                "Tilagufa" =>[1,2,3,4,5,6,7,8,9,10,11], 
            ];
            foreach ($Kalikot_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_kalikot->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Mugu_villages = [
                "Chhayanath Rara" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Khatyad" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Mugum Karmarong" => [1,2,3,4,5,6,7,8,9], 
                "Soru" => [1,2,3,4,5,6,7,8,9,10,11], 
            ];
            foreach ($Mugu_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_mugu->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Western_Rukum_villages = [
                "Aathbiskot" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Banphikot" => [1,2,3,4,5,6,7,8,9,10], 
                "Chaurjahari" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Musikot" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Sani Bheri" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Tribeni" => [1,2,3,4,5,6,7,8,9,10], 
            ];
            foreach ($Western_Rukum_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_western_rukum->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Salyan_villages = [
                "Bagchaur" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Bangad Kupinde" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Chhatreshwori" => [1,2,3,4,5,6,7], 
                "Darma" => [1,2,3,4,5,6], 
                "Kalimati" => [1,2,3,4,5,6,7], 
                "Kapurkot" => [1,2,3,4,5,6], 
                "Kumakh" => [1,2,3,4,5,6,7], 
                "Shaarada" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], 
                "Siddha Kumakh" => [1,2,3,4,5], 
                "Tribeni" => [1,2,3,4,5,6,7], 
            ];
            foreach ($Salyan_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_salyan->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Surkhet_villages = [
                "Barahatal" => [1,2,3,4,5,6,7,8,9,10], 
                "Bheriganga" => [1,2,3,4,5,6,7,8,9,10,11,12,13], 
                "Birendranagar" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16], 
                "Chaukune" => [1,2,3,4,5,6,7,8,9,10], 
                "Chingad" => [1,2,3,4,5,6], 
                "Gurbhakot" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Lekbeshi" => [1,2,3,4,5,6,7,8,9,10], 
                "Panchapuri" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Simta" =>[1,2,3,4,5,6,7,8,9], 
            ];
            foreach ($Surkhet_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_surkhet->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Achham_villages = [
                "Bannigadhi Jaygadh" => [1,2,3,4,5,6], 
                "Chaurpati" => [1,2,3,4,5,6,7], 
                "Dhakari" => [1,2,3,4,5,6,7,8], 
                "Kamalbazar" => [1,2,3,4,5,6,7,8,9,10], 
                "Mangalsen" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Mellekh" => [1,2,3,4,5,6,7,8], 
                "Panchadewal Binayak" => [1,2,3,4,5,6,7,8,9], 
                "Ramaroshan" => [1,2,3,4,5,6,7], 
                "Sanfebagar" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14], 
                "Turmakhad" => [1,2,3,4,5,6,7,8], 
            ];
            foreach ($Achham_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_achham->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Baitadi_villages = [
                "Dasharathchand" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Dilasaini" => [1,2,3,4,5,6,7], 
                "Dogdakedar" => [1,2,3,4,5,6,7,8], 
                "Melauli" => [1,2,3,4,5,6,7,8,9], 
                "Pancheshwor" => [1,2,3,4,5,6], 
                "Patan" => [1,2,3,4,5,6,7,8,9,10], 
                "Purchaudi" => [1,2,3,4,5,6,7,8,9,10], 
                "Shivanath" => [1,2,3,4,5,6], 
                "Sigas" => [1,2,3,4,5,6,7,8,9], 
                "Sunarya" => [1,2,3,4,5,6,7,8], 
            ];
            foreach ($Baitadi_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_baitadi->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Bajhang_villages = [
                "Bitthadchir" => [1,2,3,4,5,6,7,8,9], 
                "Bungal" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Chhabispathivera" => [1,2,3,4,5,6,7], 
                "Durgathali" => [1,2,3,4,5,6,7], 
                "Jayaprithvi" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Saipal" => [1,2,3,4,5], 
                "Kedarasyu" => [1,2,3,4,5,6,7,8,9], 
                "Khaptadchhanna" => [1,2,3,4,5,6,7], 
                "Masta" => [1,2,3,4,5,6,7], 
                "Surma" => [1,2,3,4,5], 
                "Talkot" => [1,2,3,4,5,6,7], 
                "Thalara" => [1,2,3,4,5,6,7,8,9], 
            ];
            foreach ($Bajhang_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_bajhang->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Bajura_villages = [
                "Badimalika" => [1,2,3,4,5,6,7,8,9], 
                "Budhiganga" => [1,2,3,4,5,6,7,8,9,10], 
                "Budhinanda" => [1,2,3,4,5,6,7,8,9,10], 
                "Khaptad Chhededaha" => [1,2,3,4,5,6,7], 
                "Gaumul" => [1,2,3,4,5,6], 
                "Himali" => [1,2,3,4,5,6,7], 
                "Jagannath" => [1,2,3,4,5,6], 
                "Swamikartik Khapar" => [1,2,3,4,5], 
                "Tribeni" =>[1,2,3,4,5,6,7,8,9], 
            ];
            foreach ($Bajura_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_bajura->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Dadeldhura_villages = [
                "Aalital" => [1,2,3,4,5,6,7,8], 
                "Ajayameru" => [1,2,3,4,5,6], 
                "Amargadhi" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Bhageshwor" => [1,2,3,4,5], 
                "Ganyapadhura" => [1,2,3,4,5], 
                "Navadurga" => [1,2,3,4,5], 
                "Parshuram" =>[1,2,3,4,5,6,7,8,9,10,11,12], 
            ];
            foreach ($Dadeldhura_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_dadeldhura->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Darchula_villages = [
                "Apihimal" => [1,2,3,4,5,6], 
                "Duhun" => [1,2,3,4,5], 
                "Lekam" => [1,2,3,4,5,6], 
                "Mahakali" => [1,2,3,4,5,6,7,8,9], 
                "Malikarjun" => [1,2,3,4,5,6,7,8], 
                "Marma" => [1,2,3,4,5,6], 
                "Naugad" => [1,2,3,4,5,6], 
                "Shailyashikhar" => [1,2,3,4,5,6,7,8,9], 
                "Vyans" =>[1,2,3,4,5,6], 
            ];
            foreach ($Darchula_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_darchula->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Doti_villages = [
                "Aadarsha" => [1,2,3,4,5,6,7], 
                "Badikedar" => [1,2,3,4,5], 
                "Bogatan Phudsil" => [1,2,3,4,5,6,7], 
                "Dipayal Silgadhi" => [1,2,3,4,5,6,7,8,9], 
                "Jorayal" => [1,2,3,4,5,6], 
                "K. I. Singh" => [1,2,3,4,5,6,7], 
                "Purbichauki" => [1,2,3,4,5,6,7], 
                "Sayal" => [1,2,3,4,5,6], 
                "Shikhar" =>[1,2,3,4,5,6,7,8,9,10,11], 
            ];
            foreach ($Doti_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_doti->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Kailali_villages = [
                "Bardgoriya" => [1,2,3,4,5,6], 
                "Bhajani" => [1,2,3,4,5,6,7,8,9], 
                "Chure" => [1,2,3,4,5,6], 
                "Dhangadhi" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], 
                "Gauriganga" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Ghodaghodi" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Godawari" => [1,2,3,4,5,6,7,8,9,10,11,12], 
                "Janaki" => [1,2,3,4,5,6,7,8,9], 
                "Joshipur" => [1,2,3,4,5,6,7], 
                "Kailari" => [1,2,3,4,5,6,7,8,9], 
                "Lamkichuha" => [1,2,3,4,5,6,7,8,9,10], 
                "Mohanyal" => [1,2,3,4,5,6,7], 
                "Tikapur" =>[1,2,3,4,5,6,7,8,9], 
            ];
            foreach ($Kailali_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_kailali->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
            
            $Kanchanpur_villages = [
                "Bedkot" => [1,2,3,4,5,6,7,8,9,10], 
                "Belauri" => [1,2,3,4,5,6,7,8,9,10], 
                "Beldandi" => [1,2,3,4,5], 
                "Bheemdatta" => [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], 
                "Krishnapur" => [1,2,3,4,5,6,7,8,9], 
                "Laljhadi" => [1,2,3,4,5,6], 
                "Mahakali" => [1,2,3,4,5,6,7,8,9,10], 
                "Punarbas" => [1,2,3,4,5,6,7,8,9,10,11], 
                "Shuklaphanta" =>[1,2,3,4,5,6,7,8,9,10,11,12],
            ];
            foreach ($Kanchanpur_villages as $village_name => $village_wards) {
                $village = Village::create(['Village' => $village_name, 'district_id' => $district_kanchanpur->id]);
            
                foreach ($village_wards as $village_ward_no) {
                    $ward = Ward::create(['Ward' => $village_ward_no, 'village_id' => $village->id]);
                }
            }
    }
}
