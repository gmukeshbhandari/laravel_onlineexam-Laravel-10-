$('#country').blur(function () {
    var country = $('#country').val();
    if (country)
    {
        $('#country_error_error').removeClass('text-danger');
        $('#country_error_error').text('');
    }
});

$(function () {
        $('#country').change(function() {
            var val = $(this).val();
            if(val === "Nepal") {
				$("#province").val(null);
				$("#district").val(null);
				$("#village").val(null);
				$("#wardno").val(null);
				$('#streetaddress').val("");
				$("#nepaldetailinfoshow").show();
            }
            else {
				$("#province").val(null);
				$("#district").val(null);
				$("#village").val(null);
				$("#wardno").val(null);
				$('#streetaddress').val("");
                $("#nepaldetailinfoshow").hide();
            }
        });
    });

	

    $('#province').on('change', function () {
        var province = $(this).val();
        var _token = $('input[name="_token"]').val();
        $('#district').empty();
        $('#village').empty();
        $('#wardno').empty();
		$('#district').append('<option style="display:none" disabled selected value> Select District </option>');
        $('#village').append('<option style="display:none" disabled selected value> Select Village </option>');
        $('#wardno').append('<option style="display:none" disabled selected value> Select Ward </option>');
        // $("#district").val(null);
        // $("#village").val(null);
        // $("#wardno").val(null);
        if (province) {
            $.ajax({
                type: 'POST',
                url: get_district_url,
                data: {province: province, _token: _token},
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    $('#district').empty();
                    $('#district').append('<option style="display:none" disabled selected value> Select District </option>');
                    $.each(data, function (key, value) {
                        $('#district').append('<option value="' + value.District + '">' + value.District + '</option>');
                        // $('#district').append('<option value="' + value.id + '">' + value.District + '</option>');
                    });
                },  error: function (error) {
                    console.error('Error:', error);
                }
            });
        } else {
            $('#district').empty();
            $('#village').empty();
            $('#wardno').empty();
			$('#district').append('<option style="display:none" disabled selected value> Select District </option>');
			$('#village').append('<option style="display:none" disabled selected value> Select Village </option>');
			$('#wardno').append('<option style="display:none" disabled selected value> Select Ward </option>');
            // $("#district").val(null);
            // $("#village").val(null);
            // $("#wardno").val(null);

        }
    });

    $('#district').on('change', function () {
        var district = $(this).val();
        var _token = $('input[name="_token"]').val();
        $('#village').empty();
        $('#wardno').empty();
		$('#village').append('<option style="display:none" disabled selected value> Select Village </option>');
		$('#wardno').append('<option style="display:none" disabled selected value> Select Ward </option>');
        // $("#village").val(null);
        // $("#wardno").val(null);
        if (district) {
            $.ajax({
                type: 'POST',
                url: get_villages_url,
                data: {district: district, _token: _token},
                dataType: 'json',
                success: function (data) {
                    // console.log(data);
                    $('#village').empty();
                    $('#village').append('<option style="display:none" disabled selected value> Select Village </option>');
                    $.each(data, function (key, value) {
                        $('#village').append('<option value="' + value.Village + '">' + value.Village + '</option>');
                        // $('#village').append('<option value="' + value.id + '">' + value.Village + '</option>');
                    });
                },  error: function (error) {
                    console.error('Error:', error);
                }
            });
        } else {
            $('#village').empty();
            $('#wardno').empty();
			$('#village').append('<option style="display:none" disabled selected value> Select Village </option>');
			$('#wardno').append('<option style="display:none" disabled selected value> Select Ward </option>');
            // $("#village").val(null);
            // $("#wardno").val(null);
        }
    });
    
    $('#village').on('change', function () {
        var village = $(this).val();
        var _token = $('input[name="_token"]').val();
        $('#wardno').empty();
		$('#wardno').append('<option style="display:none" disabled selected value> Select Ward </option>');
        // $("#wardno").val(null);
        if (village) {
            $.ajax({
                type: 'POST',
                url: get_wards_url,
                data: {village: village, _token: _token},
                dataType: 'json',
                success: function (data) {
                    $('#wardno').empty();
                    $('#wardno').append('<option style="display:none" disabled selected value> Select Ward </option>');
                    $.each(data, function (key, value) {
                        $('#wardno').append('<option value="' + value.Ward + '">' + value.Ward + '</option>');
                        // $('#wardno').append('<option value="' + value.id + '">' + value.Ward + '</option>');
                    });
                },  error: function (error) {
                    console.error('Error:', error);
                }
            });
        } else {
            $('#wardno').empty();
			$('#wardno').append('<option style="display:none" disabled selected value> Select Ward </option>');
            // $("#wardno").val(null);
        }
    });


/* Comment Start
var stateObject = {
    "Koshi": {
				"Bhojpur" : ["Aamchowk","Arun","Bhojpur","Hatuwagadhi","Pauwadungma","Ramprasadrai","Salpasilichho","Shadananda","Tyamkemaiyum"],
				"Dhankuta" : ["Chhathar Jorpati","Choubise","Dhankuta","Mahalaxmi","Pakhribas","Sangurigadhi","Shahidbhumi"],
				"Ilam" : ["Chulachuli","Deumai","Ilam","Mai","Mai Jogmai","Mangsebung","Phakphokthum","Rong","Sandakpur","Suryodaya"],
				"Jhapa" : ["Arjundhara","Barhadashi","Bhadrapur","Birtamod","Buddha Shanti","Damak","Gauradaha","Gaurigunj","Haldibari","Jhapa","Kachankawal","Kamal","Kankai","Mechinagar","Shivasatakshi"],
				"Khotang" : ["Aiselukharka","Barahapokhari","Diprung","Halesi Tuwachung","Jantedhunga","Kepilasgadhi","Khotehang","Rawa Besi","Rupakot Majhuwagadhi","Sakela"],
				"Morang" : ["Belbari","Biratnagar","Budhiganga","Dhanapalthan","Gramthan","Jahada","Kanepokhari","Katahari","Kerabari","Letang","Miklajung","Pathari Shanishchare","Rangeli","Ratuwamai","Sunawarshi","Sundarharaicha","Urlabari"],
				"Okhaldhunga" : ["Champadevi","Chishankhugadhi","Khijidemba","Likhu","Manebhanjyang","Molung","Siddhicharan","Sunkoshi"],
				"Panchthar" : ["Hilihang","Kummayak","Miklajung","Phalelung","Phalgunanda","Phidim","Tumbewa","Yangwarak"],
				"Sankhuwasabha" : ["Bhotkhola","Chainpur","Chichila","Dharmadevi","Khandbari","Madi","Makalu","Panchkhapan","Savapokhari","Silichong"],
				"Solukhumbu" : ["Dudhkoshi","Khumbu Pasanglhamu","Likhupike","Mahakulung","Nechasalyan","Solududhkunda","Sotang","Thulung Dudhkoshi"],
				"Sunsari" : ["Baraha","Barju","Bhokraha","Dewanganj","Dharan","Duhabi","Gadhi","Harinagara","Inaruwa","Itahari","Koshi","Ramdhuni"],
				"Taplejung" : ["Aathrai Triveni","Maiwa Khola","Meringden","Mikwa Khola","Pathibhara Yangwarak","Phaktanglung","Phungling","Sidingwa","Sirijangha"],
				"Terhathum" : ["Aathrai","Chhathar","Laligurans","Menchhayayem","Myanglung","Phedap"],
				"Udayapur" : ["Belaka","Chaudandigadhi","Katari","Limchungbung","Rautamai","Tapli","Triyuga","Udayapurgadhi"],
			},

    "Madhesh": {
				"Bara": ["Aadarsha Kotwal","Baragadhi","Bishrampur","Devtal","Jeetpur Simara","Kalaiya","Karaiyamai","Kolhabi","Mahagadimai","Nijgadh","Pachrauta","Parwanipur","Pheta","Prasauni","Simraungadh","Suwarna"],
				"Dhanusa": ["Aurahi","Bateshwor","Bideha","Dhanauji","Dhanushadham","Ganeshman Charnath","Hansapur","Janaknandini","Janakpur","Kamala","Kshireshwornath","Laxminiya","Mithila","Mithila Bihari","Mukhiyapatti Musaharmiya","Nagrain","Sabaila","Shahidnagar"],
				"Mahottari": ["Aurahi","Balwa","Bardibas","Bhagaha","Ekdara","Gaushala","Jaleshwor","Loharpatti","Mahottari","Manra Shiswa","Matihani","Pipra","Ramgopalpur","Samsi","Sonma"],
				"Parsa": ["Bahudarmai","Bindabasini","Birgunj","Chhipaharmai","Dhobini","Jagarnathpur","Jira Bhawani","Kalikamai","Pakaha Mainpur","Parsagadhi","Paterwa Sugauli","Pokhariya","Sakhuwa Prasauni","Thori"],
				"Rautahat": ["Baudhimai","Brindawan","Chandrapur","Dewahi Gonahi","Durga Bhagawati","Gadhimai","Garuda","Gaur","Gujara","Ishnath","Katahariya","Madhav Narayan","Maulapur","Paroha","Phatuwabijaypur","Rajdevi","Rajpur","Yamunamai"],
				"Saptari": ["Agnisair Krishnasawaran","Balanbihul","Bishnupur","Bodebarsain","Chhinnamasta","Dakneshwori","Hanumannagar Kankalini","Kanchanrup","Khadak","Mahadeva","Rajbiraj","Rajgadh","Rupani","Saptakoshi","Shambhunath","Surunga","Tilathi Koiladi","Tirahut"],
				"Sarlahi": ["Bagmati","Balra","Barhathwa","Basbariya","Bishnu","Brahmapuri","Chakraghatta","Chandranagar","Dhankaul","Godaita","Harion","Haripur","Haripurwa","Ishworpur","Kaudena","Kawilasi","Lalbandi","Malangwa","Parsa","Ramnagar"],
				"Siraha": ["Anarma","Aurahi","Bariyapatti","Bhagwanpur","Bishnupur","Dhangadhimai","Golbazar","Kalyanpur","Karjanha","Lahan","Laxmipur Patari","Mirchaiya","Naraha","Nawarajpur","Sakhuwanankarkatti","Siraha","Sukhipur"],
			   },
			   
    "Bagmati": {
				"Bhaktapur ": ["Bhaktapur","Changunarayan","Madhyapur Thimi","Suryabinayak"],
				"Chitwan": ["Bharatpur","Ichchhakamana","Kalika","Khairhani","Madi","Rapti","Ratnanagar"],
				"Dhading": ["Benighat Rorang","Dhunibeshi","Gajuri","Galchhi","Gangajamuna","Jwalamukhi","Khaniyabas","Neelakantha","Netrawati","Rubi Valley","Siddhalek","Thakre","Tripurasundari"],
				"Dolakha": ["Baiteshwor","Bhimeshwor","Bigu","Gaurishankar","Jiri","Kalinchowk","Melung","Shailung","Tamakoshi"],
				"Kathmandu": ["Budhanilkantha","Chandragiri","Dakshinkali","Gokarneshwor","Kageshwori Manohara","Kathmandu","Kirtipur","Nagarjun","Shankharapur","Tarakeshwor","Tokha"],
				"Kavrepalanchok": ["Banepa","Bethanchowk","Bhumlu","Chaurideurali","Dhulikhel","Khanikhola","Mahabharat","Mandandeupur","Namobuddha","Panauti","Panchkhal","Roshi","Temal"],
				"Lalitpur": ["Bagmati","Godawari","Konjyosom","Lalitpur","Mahalaxmi","Mahankal"],
				"Makwanpur": ["Bagmati","Bakaiya","Bhimphedi","Hetauda","Indrasarowar","Kailash","Makawanpurgadhi","Manahari","Raksirang","Thaha"],
				"Nuwakot": ["Belkotgadhi","Bidur","Dupcheshwor","Kakani","Kispang","Likhu","Meghang","Panchakanya","Shivapuri","Suryagadhi","Tadi","Tarakeshwor"],
				"Ramechhap": ["Doramba","Gokulganga","Khandadevi","Likhu Tamakoshi","Manthali","Ramechhap","Sunapati","Umakunda"],
				"Rasuwa": ["Gosaikunda","Kalika","Naukunda","Aamachhodingmo","Uttargaya"],
				"Sindhuli": ["Dudhauli","Ghyanglekh","Golanjor","Hariharpurgadhi","Kamalamai","Marin","Phikkal","Sunkoshi","Tinpatan"],
				"Sindhupalchok": ["Bahrabise","Balephi","Bhotekoshi","Chautara Sangachowkgadhi","Helambu","Indrawati","Jugal","Lisankhupakhar","Melamchi","Panchpokhari Thangpal","Sunkoshi","Tripurasundari"],
			   },
			   
    "Gandaki": {
				"Baglung": ["Badigad","Baglung","Bareng","Dhorpatan","Galkot","Jaimini","Kathekhola","Nisikhola","Tamankhola","Tarakhola"],
				"Gorkha ": ["Aarughat","Ajirkot","Barpak Sulikot","Bhimsen","Chumanuwri","Dharche","Gandaki","Gorkha","Palungtar","Shahid Lakhan","Siranchok"],
				"Kaski": ["Annapurna","Machhapuchhre","Madi","Pokhara","Rupa"],
				"Lamjung": ["Besishahar","Dordi","Dudhpokhari","Kwholasothar","Madhyanepal","Marsyangdi","Rainas","Sundarbazar"],
				"Manang": ["Chame","Manang Ngisyang","Narpa Bhumi","Nason"],
				"Mustang": ["Bahragau Muktichhetra","Lo-Ghekar Damodarkunda","Gharapjhong","Lomanthang","Thasang"],
				"Myagdi": ["Annapurna","Beni","Dhawalagiri","Malika","Mangala","Raghuganga"],
				"Nawalparasi - East of Bardaghat Susta": ["Binayi Tribeni","Bulingtar","Bungdikali","Devchuli","Gaindakot","Hupsekot","Kawasoti","Madhyabindu"],
				"Parbat": ["Bihadi","Jaljala","Kushma","Mahashila","Modi","Paiyun","Phalewas"],
				"Syangja": ["Aandhikhola","Arjunchaupari","Bheerkot","Biruwa","Chapakot","Galyang","Harinas","Kaligandaki","Phedikhola","Putalibazar","Waling"],
				"Tanahun": ["Aanbookhaireni","Bandipur","Bhanu","Bhimad","Devghat","Ghiring","Myagde","Rishing","Shuklagandaki","Vyas"],
			   },
	
    "Lumbini": {
				"Arghakhanchi": ["Bhumikasthan","Chhatradev","Malarani","Panini","Sandhikharka","Shitaganga"],
				"Banke": ["Baijanath","Duduwa","Janaki","Khajura","Kohalpur","Narainapur","Nepalgunj","Rapti Sonari"],
				"Bardiya": ["Badhaiyatal","Bansgadhi","Barbardiya","Geruwa","Gulariya","Madhuwan","Rajapur","Thakurbaba"],
				"Dang": ["Babai","Bangalachuli","Dangisharan","Gadhawa","Ghorahi","Lamahi","Rajpur","Rapti","Shantinagar","Tulsipur"],
				"Gulmi": ["Chandrakot","Chhatrakot","Dhurkot","Gulmi Darbar","Ishma","Kaligandaki","Madane","Malika","Musikot","Resunga","Ruru","Satyawati"],
				"Kapilvastu": ["Banganga","Bijaynagar","Buddhabhumi","Kapilvastu","Krishnanagar","Maharajgunj","Mayadevi","Shivraj","Shuddhodhan","Yasodhara"],
				"Nawalparasi - West of Bardaghat Susta": ["Bardghat","Palhinandan","Pratappur","Ramgram","Sarawal","Sunwal","Susta"],
				"Palpa": ["Baganaskali","Mathagadhi","Nisdi","Purbakhola","Rainadevi Chhahara","Rambha","Rampur","Ribdikot","Tansen","Tinau"],
				"Pyuthan": ["Airawati","Gaumukhi","Jhimruk","Mallarani","Mandavi","Naubahini","Pyuthan","Sarumarani","Swargadwari"],
				"Rolpa": ["Paribartan","Lungri","Madi","Rolpa","Runtigadhi","Gangadev","Sunchhahari","Sunil Smriti","Thabang","Triveni"],
				"Rukum - East Part": ["Bhume","Putha Uttarganga","Sisne"],
				"Rupandehi": ["Butwal","Devdaha","Gaidahawa","Kanchan","Kotahimai","Lumbini Sanskritik","Marchawari","Mayadevi","Omsatiya","Rohini","Sainamaina","Sammarimai","Shuddhodhan","Siddharthanagar","Siyari","Tilottama"],
			   },	
			  
	"Karnali": {
				"Dailekh": ["Aathabis","Bhagawatimai","Bhairabi","Chamunda Bindrasaini","Dullu","Dungeshwor","Gurans","Mahabu","Narayan","Naumule","Thantikandh"],
				"Dolpa": ["Chharka Tangsong","Dolpobuddha","Jagdulla","Kaike","Mudkechula","Shephoksundo","Thuli Bheri","Tripurasundari"],
				"Humla": ["Adanchuli","Chankheli","Kharpunath","Namkha","Sarkegad","Simkot","Tajakot"],
				"Jajarkot": ["Barekot","Bheri","Chhedagad","Junichaande","Kushe","Shibalaya","Nalgad"],   
				"Jumla": ["Chandannath","Guthichaur","Hima","Kankasundari","Patarasi","Sinja","Tatopani","Tila"],
				"Kalikot": ["Shuva Kalika","Khandachakra","Mahawai","Narharinath","Pachaljharana","Palata","Raskot","Sanni Triveni","Tilagufa"],
				"Mugu": ["Chhayanath Rara","Khatyad","Mugum Karmarong","Soru"],	
				"Rukum - West Part": ["Aathbiskot","Banphikot","Chaurjahari","Musikot","Sani Bheri","Tribeni"],
				"Salyan": ["Bagchaur","Bangad Kupinde","Chhatreshwori","Darma","Kalimati","Kapurkot","Kumakh","Shaarada","Siddha Kumakh","Tribeni"],
				"Surkhet": ["Barahatal","Bheriganga","Birendranagar","Chaukune","Chingad","Gurbhakot","Lekbeshi","Panchapuri","Simta"],				
			   },
			  
    "Sudhurpaschim": {
				"Achham": ["Bannigadhi Jaygadh","Chaurpati","Dhakari","Kamalbazar","Mangalsen","Mellekh","Panchadewal Binayak","Ramaroshan","Sanfebagar","Turmakhad"],
				"Baitadi": ["Dasharathchand","Dilasaini","Dogdakedar","Melauli","Pancheshwor","Patan","Purchaudi","Shivanath","Sigas","Sunarya"],
				"Bajhang": ["Bitthadchir","Bungal","Chhabispathivera","Durgathali","Jayaprithvi","Saipal","Kedarasyu","Khaptadchhanna","Masta","Surma","Talkot","Thalara"],
				"Bajura": ["Badimalika","Budhiganga","Budhinanda","Khaptad Chhededaha","Gaumul","Himali","Jagannath","Swamikartik Khapar","Tribeni"],
				"Dadeldhura": ["Aalital","Ajayameru","Amargadhi","Bhageshwor","Ganyapadhura","Navadurga","Parshuram"],
				"Darchula": ["Apihimal","Duhun","Lekam","Mahakali","Malikarjun","Marma","Naugad","Shailyashikhar","Vyans"],
				"Doti": ["Aadarsha","Badikedar","Bogatan Phudsil","Dipayal Silgadhi","Jorayal","K. I. Singh","Purbichauki","Sayal","Shikhar"],
				"Kailali": ["Bardgoriya","Bhajani","Chure","Dhangadhi","Gauriganga","Ghodaghodi","Godawari","Janaki","Joshipur","Kailari","Lamkichuha","Mohanyal","Tikapur"],
				"Kanchanpur": ["Bedkot","Belauri","Beldandi","Bheemdatta","Krishnapur","Laljhadi","Mahakali","Punarbas","Shuklaphanta"],
					 },
}

var villagewardObject = {
//Koshi Pradesh
	//Bhojpur District
	"Aamchowk": [1,2,3,4,5,6,7,8,9,10], //Gaunpalika //Rural Municipality
	"Arun": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Bhojpur": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Hatuwagadhi": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Pauwadungma": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Ramprasadrai": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Salpasilichho": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Shadananda": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Tyamkemaiyum":[1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	//Dhankuta District
	"Chhathar Jorpati": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Choubise": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Dhankuta": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Mahalaxmi": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Pakhribas": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Sangurigadhi": [1,2,3,4,5,6,7,8,9,10], //Gaunpalika //Rural Municipality
	"Shahidbhumi":[1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	//Ilam District
	"Chulachuli": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Deumai": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Ilam": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Mai": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Mai Jogmai": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Mangsebung": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Phakphokthum": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Rong": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Sandakpur": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Suryodaya": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	//Jhapa District
	"Arjundhara": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Barhadashi": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Bhadrapur": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Birtamod": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Buddha Shanti": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Damak": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Gauradaha": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Gaurigunj": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Haldibari": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Jhapa": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Kachankawal": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Kamal": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Kankai": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Mechinagar": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], //Nagarpalika //Municipality
	"Shivasatakshi":[1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	//Khotang District
	"Aiselukharka": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Barahapokhari": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Diprung": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Halesi Tuwachung": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Jantedhunga": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Kepilasgadhi": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Khotehang": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Rawa Besi": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Rupakot Majhuwagadhi": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], //Nagarpalika //Municipality
	"Sakela": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	//Morang District
	"Belbari": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Biratnagar": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], //Mahanagarpalika //Metropolitan
	"Budhiganga": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Dhanapalthan": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Gramthan": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Jahada": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Kanepokhari": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Katahari": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Kerabari": [1,2,3,4,5,6,7,8,9,10], //Gaunpalika //Rural Municipality
	"Letang": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Miklajung": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Pathari Shanishchare": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Rangeli": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Ratuwamai": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Sunawarshi": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Sundarharaicha": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Urlabari":[1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	//Okhaldhunga District
	"Champadevi": [1,2,3,4,5,6,7,8,9,10], //Gaunpalika //Rural Municipality
	"Chishankhugadhi": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Khijidemba": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Likhu": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Manebhanjyang": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Molung": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Siddhicharan": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Sunkoshi": [1,2,3,4,5,6,7,8,9,10], //Gaunpalika //Rural Municipality
	//Panchthar District
	"Hilihang": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Kummayak": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Miklajung": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Phalelung": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Phalgunanda": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Phidim": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Tumbewa": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Yangwarak": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	//Sankhuwasabha District
	"Bhotkhola": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Chainpur": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Chichila": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Dharmadevi": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Khandbari": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Madi": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Makalu": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Panchkhapan": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Savapokhari": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Silichong": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	//Solukhumbu District
	"Dudhkoshi": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Khumbu Pasanglhamu": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Likhupike": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Mahakulung": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Nechasalyan": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Solududhkunda": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Sotang": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Thulung Dudhkoshi": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	//Sunsari District
	"Baraha": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Barju": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Bhokraha": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Dewanganj": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Dharan": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20], //Upa-Mahanagarpalika //Submetropolitan
	"Duhabi": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Gadhi": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Harinagara": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Inaruwa": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Itahari": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20], //Upa-Mahanagarpalika //Submetropolitan
	"Koshi": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Ramdhuni": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	//Taplejung District
	"Aathrai Triveni": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Maiwa Khola": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Meringden": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Mikwa Khola": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Pathibhara Yangwarak": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Phaktanglung": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Phungling": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Sidingwa": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Sirijangha":[1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	//Terhathum District
	"Aathrai": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Chhathar": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Laligurans": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Menchhayayem": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Myanglung": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Phedap": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	//Udayapur District
	"Belaka": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Chaudandigadhi": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Katari": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Limchungbung": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Rautamai": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Tapli": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Triyuga": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16], //Nagarpalika //Municipality
	"Udayapurgadhi": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
//Madhesh Pradesh
	//Bara District
	"Aadarsha Kotwal": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Baragadhi": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Bishrampur": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Devtal": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Jeetpur Simara": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24], //Upa-Mahanagarpalika //Submetropolitan
	"Kalaiya": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27], //Upa-Mahanagarpalika //Submetropolitan
	"Karaiyamai": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Kolhabi": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Mahagadimai": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Nijgadh": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Pachrauta": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Parwanipur": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Pheta": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Prasauni": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Simraungadh": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Suwarna": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	//Dhanusa District
	"Aurahi": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Bateshwor": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Bideha": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Dhanauji": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Dhanushadham": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Ganeshman Charnath": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Hansapur": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Janaknandini": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Janakpur": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25], //Upa-Mahanagarpalika //Submetropolitan
	"Kamala": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Kshireshwornath": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Laxminiya": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Mithila": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Mithila Bihari": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Mukhiyapatti Musaharmiya": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Nagrain": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Sabaila": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Shahidnagar": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	//Mahottari District
	"Aurahi": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Balwa": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Bardibas": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Bhagaha": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Ekdara": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Gaushala": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Jaleshwor": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Loharpatti": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Mahottari": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Manra Shiswa": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Matihani": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Pipra": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Ramgopalpur": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Samsi": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Sonma":[1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	//Parsa District
	"Bahudarmai": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Bindabasini": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Birgunj": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32], //Mahanagarpalika //Metropolitan
	"Chhipaharmai": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Dhobini": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Jagarnathpur": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Jira Bhawani": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Kalikamai": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Pakaha Mainpur": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Parsagadhi": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Paterwa Sugauli": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Pokhariya": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Sakhuwa Prasauni": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Thori": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	//Rautahat District
	"Baudhimai": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Brindawan": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Chandrapur": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Dewahi Gonahi": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Durga Bhagawati": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Gadhimai": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Garuda": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Gaur": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Gujara": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Ishnath": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Katahariya": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Madhav Narayan": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Maulapur": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Paroha": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Phatuwabijaypur": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Rajdevi": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Rajpur": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Yamunamai": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	//Saptari District
	"Agnisair Krishnasawaran": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Balanbihul": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Bishnupur": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Bodebarsain": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Chhinnamasta": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Dakneshwori": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Hanumannagar Kankalini": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Kanchanrup": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Khadak": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Mahadeva": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Rajbiraj": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16], //Nagarpalika //Municipality
	"Rajgadh": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Rupani": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Saptakoshi": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Shambhunath": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Surunga": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Tilathi Koiladi": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Tirahut": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	//Sarlahi District
	"Bagmati": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Balra": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Barhathwa": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18], //Nagarpalika //Municipality
	"Basbariya": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Bishnu": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Brahmapuri": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Chakraghatta": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Chandranagar": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Dhankaul": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Godaita": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Harion": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Haripur": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Haripurwa": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Ishworpur": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], //Nagarpalika //Municipality
	"Kaudena": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Kawilasi": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Lalbandi": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17], //Nagarpalika //Municipality
	"Malangwa": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Parsa": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Ramnagar": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	//Siraha District
	"Anarma": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Aurahi": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Bariyapatti": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Bhagwanpur": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Bishnupur": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Dhangadhimai": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Golbazar": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Kalyanpur": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Karjanha": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Lahan": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24], //Nagarpalika //Municipality
	"Laxmipur Patari": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Mirchaiya": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Naraha": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Nawarajpur": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Sakhuwanankarkatti": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Siraha": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22], //Nagarpalika //Municipality
	"Sukhipur":[1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
//Bagmati Pradesh
	//Bhaktapur District
	"Bhaktapur": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Changunarayan": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Madhyapur Thimi": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Suryabinayak": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	//Chitwan District
	"Bharatpur": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29], //Mahanagarpalika //Metropolitan
	"Ichchhakamana": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Kalika": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Khairhani": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Madi": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Rapti": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Ratnanagar":[1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16], //Nagarpalika //Municipality
	//Dhading District
	"Benighat Rorang": [1,2,3,4,5,6,7,8,9,10], //Gaunpalika //Rural Municipality
	"Dhunibeshi": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Gajuri": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Galchhi": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Gangajamuna": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Jwalamukhi": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Khaniyabas": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Neelakantha": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Netrawati": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Rubi Valley": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Siddhalek": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Thakre": [1,2,3,4,5,6,7,8,9,10,11], //Gaunpalika //Rural Municipality
	"Tripurasundari":[1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	//Dolakha District
	"Baiteshwor": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Bhimeshwor": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Bigu": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Gaurishankar": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Jiri": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Kalinchowk": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Melung": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Shailung": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Tamakoshi":[1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	//Kathmandu District
	"Budhanilkantha": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Chandragiri": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], //Nagarpalika //Municipality
	"Dakshinkali": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Gokarneshwor": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Kageshwori Manohara": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Kathmandu": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32], //Mahanagarpalika //Metropolitan
	"Kirtipur": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Nagarjun": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Shankharapur": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Tarakeshwor": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Tokha":[1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	//Kavrepalanchok District
	"Banepa": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Bethanchowk": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Bhumlu": [1,2,3,4,5,6,7,8,9,10], //Gaunpalika //Rural Municipality
	"Chaurideurali": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Dhulikhel": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Khanikhola": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Mahabharat": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Mandandeupur": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Namobuddha": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Panauti": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Panchkhal": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Roshi": [1,2,3,4,5,6,7,8,9,10,11,12], //Gaunpalika //Rural Municipality
	"Temal":[1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	//Lalitpur District
	"Bagmati": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Godawari": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Konjyosom": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Lalitpur": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29], //Mahanagarpalika //Metropolitan
	"Mahalaxmi": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Mahankal": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	//Makwanpur District
	"Bagmati": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Bakaiya": [1,2,3,4,5,6,7,8,9,10,11,12], //Gaunpalika //Rural Municipality
	"Bhimphedi": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Hetauda": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], //Upa-Mahanagarpalika //Submetropolitan
	"Indrasarowar": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Kailash": [1,2,3,4,5,6,7,8,9,10], //Gaunpalika //Rural Municipality
	"Makawanpurgadhi": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Manahari": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Raksirang": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Thaha": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	//Nuwakot District
	"Belkotgadhi": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Bidur": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Dupcheshwor": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Kakani": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Kispang": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Likhu": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Meghang": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Panchakanya": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Shivapuri": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Suryagadhi": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Tadi": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Tarakeshwor": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	//Ramechhap District
	"Doramba": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Gokulganga": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Khandadevi": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Likhu Tamakoshi": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Manthali": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Ramechhap": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Sunapati": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Umakunda": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	//Rasuwa District
	"Gosaikunda": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Kalika": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Naukunda": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Aamachhodingmo": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Uttargaya":[1,2,3,4,5], //Gaunpalika //Rural Municipality
	 //Sindhuli District
	"Dudhauli": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Ghyanglekh": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Golanjor": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Hariharpurgadhi": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Kamalamai": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Marin": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Phikkal": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Sunkoshi": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Tinpatan":[1,2,3,4,5,6,7,8,9,10,11], //Gaunpalika //Rural Municipality
	//Sindhupalchok District
	"Bahrabise": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Balephi": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Bhotekoshi": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Chautara Sangachowkgadhi": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Helambu": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Indrawati": [1,2,3,4,5,6,7,8,9,10,11,12], //Gaunpalika //Rural Municipality
	"Jugal": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Lisankhupakhar": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Melamchi": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Panchpokhari Thangpal": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Sunkoshi": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Tripurasundari": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
//Gandaki Pradesh
	//Baglung District
	"Badigad": [1,2,3,4,5,6,7,8,9,10], //Gaunpalika //Rural Municipality
	"Baglung": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Bareng": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Dhorpatan": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Galkot": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Jaimini": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Kathekhola": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Nisikhola": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Tamankhola": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Tarakhola": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	//Gorkha District
	"Aarughat": [1,2,3,4,5,6,7,8,9,10], //Gaunpalika //Rural Municipality
	"Ajirkot": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Barpak Sulikot": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Bhimsen": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Chumanuwri": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Dharche": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Gandaki": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Gorkha": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Palungtar": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Shahid Lakhan": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Siranchok":[1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	//Kaski District
	"Annapurna": [1,2,3,4,5,6,7,8,9,10,11], //Gaunpalika //Rural Municipality
	"Machhapuchhre": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Madi": [1,2,3,4,5,6,7,8,9,10,11,12], //Gaunpalika //Rural Municipality
	"Pokhara": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33], //Mahanagarpalika //Metropolitan
	"Rupa":[1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	//Lamjung District
	"Besishahar": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Dordi": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Dudhpokhari": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Kwholasothar": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Madhyanepal": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Marsyangdi": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Rainas": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Sundarbazar": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	//Manang District
	"Chame": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Manang Ngisyang": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Narpa Bhumi": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Nason": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	//Mustang District
	"Bahragau Muktichhetra": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Lo-Ghekar Damodarkunda": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Gharapjhong": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Lomanthang": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Thasang":[1,2,3,4,5], //Gaunpalika //Rural Municipality
	//Myagdi District
	"Annapurna": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Beni": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Dhawalagiri": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Malika": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Mangala": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Raghuganga": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	//Nawalparasi - East of Bardaghat Susta District
	"Binayi Tribeni": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Bulingtar": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Bungdikali": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Devchuli": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17], //Nagarpalika //Municipality
	"Gaindakot": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18], //Nagarpalika //Municipality
	"Hupsekot": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Kawasoti": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17], //Nagarpalika //Municipality
	"Madhyabindu": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], //Nagarpalika //Municipality
	//Parbat District
	"Bihadi": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Jaljala": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Kushma": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Mahashila": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Modi": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Paiyun": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Phalewas":[1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	//Syangja District
	"Aandhikhola": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Arjunchaupari": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Bheerkot": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Biruwa": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Chapakot": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Galyang": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Harinas": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Kaligandaki": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Phedikhola": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Putalibazar": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Waling":[1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	//Tanahun District
	"Aanbookhaireni": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Bandipur": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Bhanu": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Bhimad": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Devghat": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Ghiring": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Myagde": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Rishing": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Shuklagandaki": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Vyas": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
//Lumbini Pradesh
	//Arghakhanchi District
	"Bhumikasthan": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Chhatradev": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Malarani": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Panini": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Sandhikharka": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Shitaganga": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	//Banke District
	"Baijanath": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Duduwa": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Janaki": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Khajura": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Kohalpur": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], //Nagarpalika //Municipality
	"Narainapur": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Nepalgunj": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23], //Upa-Mahanagarpalika //Submetropolitan
	"Rapti Sonari": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	//Bardiya District
	"Badhaiyatal": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Bansgadhi": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Barbardiya": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Geruwa": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Gulariya": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Madhuwan": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Rajapur": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Thakurbaba": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	//Dang District
	"Babai": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Bangalachuli": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Dangisharan": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Gadhawa": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Ghorahi": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], //Upa-Mahanagarpalika //Submetropolitan
	"Lamahi": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Rajpur": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Rapti": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Shantinagar": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Tulsipur": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], //Upa-Mahanagarpalika //Submetropolitan
	//Gulmi District
	"Chandrakot": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Chhatrakot": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Dhurkot": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Gulmi Darbar": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Ishma": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Kaligandaki": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Madane": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Malika": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Musikot": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Resunga": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Ruru": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Satyawati": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	//Kapilvastu District
	"Banganga": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Bijaynagar": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Buddhabhumi": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Kapilvastu": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Krishnanagar": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Maharajgunj": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Mayadevi": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Shivraj": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Shuddhodhan": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Yasodhara": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	// Nawalparasi - West of Bardaghat Susta District
	"Bardghat": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16], //Nagarpalika //Municipality
	"Palhinandan": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Pratappur": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Ramgram": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18], //Nagarpalika //Municipality
	"Sarawal": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Sunwal": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Susta":[1,2,3,4,5], //Gaunpalika //Rural Municipality
	//Palpa District
	"Baganaskali": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Mathagadhi": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Nisdi": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Purbakhola": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Rainadevi Chhahara": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Rambha": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Rampur": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Ribdikot": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Tansen": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Tinau": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	//Pyuthan District
	"Airawati": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Gaumukhi": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Jhimruk": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Mallarani": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Mandavi": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Naubahini": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Pyuthan": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Sarumarani": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Swargadwari":[1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	//Rolpa District
	"Paribartan": [1,2,3,4,5,6], //Previosuly Duikholi //Gaunpalika //Rural Municipality
	"Lungri": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Madi": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Rolpa": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Runtigadhi": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Gangadev": [1,2,3,4,5,6,7], //Previosuly Sukidaha //Gaunpalika //Rural Municipality
	"Sunchhahari": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Sunil Smriti": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Thabang": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Triveni": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	//Rukum - East Part District
	"Bhume": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Putha Uttarganga": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Gaunpalika //Rural Municipality
	"Sisne":[1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	//Rupandehi District
	"Butwal": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], //Upa-Mahanagarpalika //Submetropolitan
	"Devdaha": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Gaidahawa": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Kanchan": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Kotahimai": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Lumbini Sanskritik": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Marchawari": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Mayadevi": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Omsatiya": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Rohini": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Sainamaina": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Sammarimai": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Shuddhodhan": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Siddharthanagar": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Siyari": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Tilottama": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17], //Nagarpalika //Municipality
//Karnali Pradesh
	//Dailekh District
	"Aathabis": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Bhagawatimai": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Bhairabi": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Chamunda Bindrasaini": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Dullu": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Dungeshwor": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Gurans": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Mahabu": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Narayan": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Naumule": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Thantikandh":[1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	//Dolpa District
	"Chharka Tangsong": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Dolpobuddha": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Jagdulla": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Kaike": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Mudkechula": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Shephoksundo": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Thuli Bheri": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Tripurasundari": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	//Humla District
	"Adanchuli": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Chankheli": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Kharpunath": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Namkha": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Sarkegad": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Simkot": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Tajakot":[1,2,3,4,5], //Gaunpalika //Rural Municipality
	//Jajarkot District
	"Barekot": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Bheri": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Chhedagad": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Junichaande": [1,2,3,4,5,6,7,8,9,10,11], //Gaunpalika //Rural Municipality
	"Kushe": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Shibalaya": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Nalgad":[1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	//Jumla District
	"Chandannath": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Guthichaur": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Hima": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Kankasundari": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Patarasi": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Sinja": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Tatopani": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Tila": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	//Kalikot District
	"Shuva Kalika": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Khandachakra": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Mahawai": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Narharinath": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Pachaljharana": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Palata": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Raskot": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Sanni Triveni": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Tilagufa":[1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	//Mugu District
	"Chhayanath Rara": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Khatyad": [1,2,3,4,5,6,7,8,9,10,11], //Gaunpalika //Rural Municipality
	"Mugum Karmarong": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Soru": [1,2,3,4,5,6,7,8,9,10,11], //Gaunpalika //Rural Municipality
	//Rukum - West Part District
	"Aathbiskot": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Banphikot": [1,2,3,4,5,6,7,8,9,10], //Gaunpalika //Rural Municipality
	"Chaurjahari": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Musikot": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Sani Bheri": [1,2,3,4,5,6,7,8,9,10,11], //Gaunpalika //Rural Municipality
	"Tribeni": [1,2,3,4,5,6,7,8,9,10], //Gaunpalika //Rural Municipality
	//Salyan District
	"Bagchaur": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Bangad Kupinde": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Chhatreshwori": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Darma": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Kalimati": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Kapurkot": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Kumakh": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Shaarada": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15], //Nagarpalika //Municipality
	"Siddha Kumakh": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Tribeni": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	//Surkhet District
	"Barahatal": [1,2,3,4,5,6,7,8,9,10], //Gaunpalika //Rural Municipality
	"Bheriganga": [1,2,3,4,5,6,7,8,9,10,11,12,13], //Nagarpalika //Municipality
	"Birendranagar": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16], //Nagarpalika //Municipality
	"Chaukune": [1,2,3,4,5,6,7,8,9,10], //Gaunpalika //Rural Municipality
	"Chingad": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Gurbhakot": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Lekbeshi": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Panchapuri": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Simta":[1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
//Sudhurpaschim Pradesh
	//Achham District			
	"Bannigadhi Jaygadh": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Chaurpati": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Dhakari": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Kamalbazar": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Mangalsen": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Mellekh": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Panchadewal Binayak": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Ramaroshan": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Sanfebagar": [1,2,3,4,5,6,7,8,9,10,11,12,13,14], //Nagarpalika //Municipality
	"Turmakhad": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	//Baitadi District
	"Dasharathchand": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Dilasaini": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Dogdakedar": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Melauli": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Pancheshwor": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Patan": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Purchaudi": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Shivanath": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Sigas": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Sunarya": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	//Bajhang District
	"Bitthadchir": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Bungal": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Chhabispathivera": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Durgathali": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Jayaprithvi": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Saipal": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Kedarasyu": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Khaptadchhanna": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Masta": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Surma": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Talkot": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Thalara": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	//Bajura District
	"Badimalika": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Budhiganga": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Budhinanda": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Khaptad Chhededaha": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Gaumul": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Himali": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Jagannath": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Swamikartik Khapar": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Tribeni":[1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	//Dadeldhura District
	"Aalital": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Ajayameru": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Amargadhi": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Bhageshwor": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Ganyapadhura": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Navadurga": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Parshuram":[1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	//Darchula District
	"Apihimal": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Duhun": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Lekam": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Mahakali": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Malikarjun": [1,2,3,4,5,6,7,8], //Gaunpalika //Rural Municipality
	"Marma": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Naugad": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Shailyashikhar": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Vyans":[1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	//Doti District
	"Aadarsha": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Badikedar": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Bogatan Phudsil": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Dipayal Silgadhi": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Jorayal": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"K. I. Singh": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Purbichauki": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Sayal": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Shikhar":[1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	//Kailali District
	"Bardgoriya": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Bhajani": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Chure": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Dhangadhi": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], //Upa-Mahanagarpalika //Submetropolitan
	"Gauriganga": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Ghodaghodi": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Godawari": [1,2,3,4,5,6,7,8,9,10,11,12], //Nagarpalika //Municipality
	"Janaki": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Joshipur": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Kailari": [1,2,3,4,5,6,7,8,9], //Gaunpalika //Rural Municipality
	"Lamkichuha": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Mohanyal": [1,2,3,4,5,6,7], //Gaunpalika //Rural Municipality
	"Tikapur":[1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	//Kanchanpur District
	"Bedkot": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Belauri": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Beldandi": [1,2,3,4,5], //Gaunpalika //Rural Municipality
	"Bheemdatta": [1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19], //Nagarpalika //Municipality
	"Krishnapur": [1,2,3,4,5,6,7,8,9], //Nagarpalika //Municipality
	"Laljhadi": [1,2,3,4,5,6], //Gaunpalika //Rural Municipality
	"Mahakali": [1,2,3,4,5,6,7,8,9,10], //Nagarpalika //Municipality
	"Punarbas": [1,2,3,4,5,6,7,8,9,10,11], //Nagarpalika //Municipality
	"Shuklaphanta":[1,2,3,4,5,6,7,8,9,10,11,12] //Nagarpalika //Municipality
};

window.onload = function () {
		provinceSel = document.getElementById("province"),
        districtSel = document.getElementById("district"),
        VillageSel = document.getElementById("village");
		WardnoSel = document.getElementById("wardno"); 
	
	 provinceSel.onchange = function () {
        districtSel.length = 1; // remove all options bar first
        VillageSel.length = 1; // remove all options bar first
		WardnoSel.length = 1; // remove all options bar first
        if (this.selectedIndex < 1) return; // done
        for (var state in stateObject[this.value]) {
            districtSel.options[districtSel.options.length] = new Option(state, state);
        }
    }
    provinceSel.onchange(); // reset in case page is reloaded
    districtSel.onchange = function () {
        VillageSel.length = 1; // remove all options bar first
		WardnoSel.length = 1; // remove all options bar first
        if (this.selectedIndex < 1) return; // done
        var villagee = stateObject[provinceSel.value][this.value];
        for (var i = 0; i < villagee.length; i++) {
            VillageSel.options[VillageSel.options.length] = new Option(villagee[i], villagee[i]);
        }
    }
	districtSel.onchange();
	VillageSel.onchange = function () {
		WardnoSel.length = 1; // remove all options bar first
		if (this.selectedIndex < 1) return; // done
		var wardno = villagewardObject[VillageSel.value];
		 for (var i = 0; i < wardno.length; i++) {
		WardnoSel.options[WardnoSel.options.length] = new Option(wardno[i], wardno[i]);
		}
	}
}
Comment End */