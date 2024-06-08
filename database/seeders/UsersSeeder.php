<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Users;
use App\Models\LoginDetail;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Users::factory()->count(15)->create();
        //This will create 5 fake Users model instances as set up in Laravel_project_root_directory/database/factories/UsersFactory.php and insert them into the database.

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

        $users = Users::create([
            'Rank' => $rank,
            'First_Name' => 'Liam',
            'Last_Name' => 'Johnson',
            'email' => 'liam@oe.test',
            'user_username' => 'liam45',
            'image_file_path' => 'images/userimage/seed/1.jpg',
            'password' => bcrypt('123456789l'),
            'institute_username' => 'kathford',
            'Gender'  => 'Male',
            'Country' => 'United States',
            'Last_First_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Last_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);

        $users->Verified = '1';
        $users->save();

        $useragent = 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36';
       
       
        
        LoginDetail::create([
            'username' => 'liam45',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',
            'Browser' => 'Safari',
            'Platform' => 'iOS',
            'Device' => 'iPhone',
        ]);

        $rank++;

        $users = Users::create([
            'Rank' => $rank,
            'First_Name' => 'Sebastian',
            'Last_Name' => 'Richter',
            'email' => 'sebastian1@oe.test',
            'user_username' => 'sebastian38',
            'image_file_path' => 'images/userimage/seed/2.jpg',
            'password' => bcrypt('123456789s'),
            'institute_username' => 'kathford',
            'Gender'  => 'Male',
            'Country' => 'Nepal',
            'Province_Name_Nepal' => 'Bagmati',
            'District_Nepal' => 'Kavrepalanchok',
            'Village_Nepal' => 'Panauti',
            'Street_Address_Nepal' => 'Panauti',
            'Ward_No_Nepal' => '9',
            'Last_First_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Last_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);

        $users->Verified = '1';
        $users->save();

        LoginDetail::create([
            'username' => 'sebastian38',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',
            'Browser' => 'Chrome',
            'Platform' => 'Windows',
            'Device' => 'WebKit',
        ]);

        $rank++;

        $users = Users::create([
            'Rank' => $rank,
            'First_Name' => 'Makoto',
            'Last_Name' => 'Yamamoto',
            'email' => 'makoto@oe.test',
            'user_username' => 'makoto26',
            'image_file_path' => 'images/userimage/seed/3.jpg',
            'password' => bcrypt('123456789m'),
            'institute_username' => 'arunima',
            'Gender'  => 'Male',
            'Country' => 'Nepal',
            'Province_Name_Nepal' => 'Bagmati',
            'District_Nepal' => 'Kathmandu',
            'Village_Nepal' => 'Kathmandu',
            'Street_Address_Nepal' => 'chabahil',
            'Ward_No_Nepal' => '9',
            'Last_First_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Last_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);

        $users->Verified = '1';
        $users->save();

        LoginDetail::create([
            'username' => 'makoto26',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',
            'Browser' => 'Chrome',
            'Platform' => 'Windows',
            'Device' => 'WebKit',
        ]);

        $rank++;

        $users = Users::create([
            'Rank' => $rank,
            'First_Name' => 'Rafael',
            'Last_Name' => 'Silva',
            'email' => 'rafael_47@oe.test',
            'user_username' => 'rafael_silva',
            'image_file_path' => 'images/userimage/seed/3.jpg',
            'password' => bcrypt('123456789m'),
            'institute_username' => 'arunima',
            'Gender'  => 'Male',
            'Country' => 'Germany',
            'Last_First_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Last_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);

        $users->Verified = '1';
        $users->save();

        LoginDetail::create([
            'username' => 'rafael_silva',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',
            'Browser' => 'Edge',
            'Platform' => 'Windows',
            'Device' => 'WebKit',
        ]);

        $rank++;

        $users = Users::create([
            'Rank' => $rank,
            'First_Name' => 'Alex',
            'Last_Name' => 'Bennett',
            'email' => 'alex35@oe.test',
            'user_username' => 'alex_ben',
            'image_file_path' => 'images/userimage/seed/4.jpg',
            'password' => bcrypt('123456789a'),
            'institute_username' => 'kathford',
            'Gender'  => 'Male',
            'Country' => 'Nepal',
            'Province_Name_Nepal' => 'Bagmati',
            'District_Nepal' => 'Lalitpur',
            'Village_Nepal' => 'Lalitpur',
            'Ward_No_Nepal' => '3',
            'Street_Address_Nepal' => 'Pulchwok',
            'Last_First_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Last_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);

        LoginDetail::create([
            'username' => 'alex_ben',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',
            'Browser' => 'Safari',
            'Platform' => 'OS X',
            'Device' => 'Macintosh',
        ]);

        $rank++;

        $users = Users::create([
            'Rank' => $rank,
            'First_Name' => 'Mason',
            'Last_Name' => 'Carter',
            'email' => 'masoncarter@oe.test',
            'user_username' => 'mason.carter1',
            'image_file_path' => 'images/userimage/seed/5.jpg',
            'password' => bcrypt('123456789m'),
            'institute_username' => 'kathford',
            'Gender'  => 'Male',
            'Country' => 'Uruguay',
            'Last_First_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Last_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);

        LoginDetail::create([
            'username' => 'mason.carter1',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',
            'Browser' => 'Chrome',
            'Platform' => 'Windows',
            'Device' => 'WebKit',
        ]);

        $rank++;

        $users = Users::create([
            'Rank' => $rank,
            'First_Name' => 'Nolan',
            'Last_Name' => 'Anderson',
            'email' => 'nolan_anderson@oe.test',
            'user_username' => 'nolanand_son3',
            'image_file_path' => 'images/userimage/seed/6.jpg',
            'password' => bcrypt('123456789n'),
            'institute_username' => 'kathford',
            'Gender'  => 'Male',
            'Country' => 'Nepal',
            'Province_Name_Nepal' => 'Lumbini',
            'District_Nepal' => 'Banke',
            'Village_Nepal' => 'Kohalpur',
            'Ward_No_Nepal' => '5',
            'Street_Address_Nepal' => 'Pasalchowk',
            'Last_First_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Last_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);

        $users->Verified = '1';
        $users->flag_en_dis = '0';
        $users->save();

        LoginDetail::create([
            'username' => 'nolanand_son3',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',
            'Browser' => 'Chrome',
            'Platform' => 'AndroidOS',
            'Device' => 'Samsung',
        ]);

        $rank++;

        $users = Users::create([
            'Rank' => $rank,
            'First_Name' => 'Dominic',
            'Last_Name' => 'Hayes',
            'email' => 'dominic45_hayes@oe.test',
            'user_username' => 'dominic_h',
            'image_file_path' => 'images/userimage/seed/7.jpg',
            'password' => bcrypt('123456789d'),
            'institute_username' => 'kathford',
            'Gender'  => 'Male',
            'Country' => 'India',
            'Last_First_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Last_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);

        LoginDetail::create([
            'username' => 'dominic_h',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',
            'Browser' => 'Chrome',
            'Platform' => 'AndroidOS',
            'Device' => 'Samsung',
        ]);

        $rank++;
        
        $users = Users::create([
            'Rank' => $rank,
            'First_Name' => 'Victor',
            'Last_Name' => 'Ramirez',
            'email' => 'victor_rami@oe.test',
            'user_username' => 'victor_ram1999',
            'image_file_path' => 'images/userimage/seed/8.jpg',
            'password' => bcrypt('123456789v'),
            'institute_username' => 'kathford',
            'Gender'  => 'Male',
            'Country' => 'Nepal',
            'Province_Name_Nepal' => 'Karnali',
            'District_Nepal' => 'Mugu',
            'Village_Nepal' => 'Soru',
            'Ward_No_Nepal' => '2',
            'Street_Address_Nepal' => 'Pipalbot',
            'Last_First_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Last_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);

        LoginDetail::create([
            'username' => 'victor_ram1999',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',
            'Browser' => 'Chrome',
            'Platform' => 'AndroidOS',
            'Device' => 'Samsung',
        ]);

        $rank++;

        $users = Users::create([
            'Rank' => $rank,
            'First_Name' => 'Ava',
            'Last_Name' => 'Johnson',
            'email' => 'avajohnson@oe.test',
            'user_username' => 'avajohnson98',
            'image_file_path' => 'images/userimage/seed/16.jpg',
            'password' => bcrypt('123456789a'),
            'institute_username' => 'kathford',
            'Gender'  => 'Female',
            'Country' => 'Nepal',
            'Province_Name_Nepal' => 'Sudhurpaschim',
            'District_Nepal' => 'Dadeldhura',
            'Village_Nepal' => 'Amargadhi',
            'Ward_No_Nepal' => '3',
            'Street_Address_Nepal' => 'Dobato',
            'Last_First_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Last_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);

        $users->Verified = '1';
        $users->flag_en_dis = '0';
        $users->save();

        LoginDetail::create([
            'username' => 'avajohnson98',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',
            'Browser' => 'Chrome',
            'Platform' => 'AndroidOS',
            'Device' => 'Samsung',
        ]);

        $rank++;

        $users = Users::create([
            'Rank' => $rank,
            'First_Name' => 'Scarlett',
            'Last_Name' => 'Patel',
            'email' => 'scarlett@oe.test',
            'user_username' => 'scarlett.p32',
            'image_file_path' => 'images/userimage/seed/17.jpg',
            'password' => bcrypt('123456789s'),
            'institute_username' => 'kathford',
            'Gender'  => 'Female',
            'Country' => 'India',
            'Last_First_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Last_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);
        $users->flag_en_dis = '0';
        $users->save();

        LoginDetail::create([
            'username' => 'scarlett.p32',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',
            'Browser' => 'Chrome',
            'Platform' => 'AndroidOS',
            'Device' => 'Samsung',
        ]);

        $rank++;

        $users = Users::create([
            'Rank' => $rank,
            'First_Name' => 'Ella',
            'Last_Name' => 'Rivera',
            'email' => 'ella@oe.test',
            'user_username' => 'ella',
            'image_file_path' => 'images/userimage/seed/18.jpg',
            'password' => bcrypt('123456789e'),
            'institute_username' => 'kathford',
            'Gender'  => 'Female',
            'Country' => 'Netherlands',
            'Last_First_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Last_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);

        $users->Verified = '1';
        $users->save();

        LoginDetail::create([
            'username' => 'ella',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'user',
            'Browser' => 'Chrome',
            'Platform' => 'AndroidOS',
            'Device' => 'Samsung',
        ]);

        
    }
}
