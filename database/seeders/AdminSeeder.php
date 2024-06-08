<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Users;
use App\Models\LoginDetail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Request;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Admin::factory()->count(5)->create();
        //This will create 5 fake Admin model instances as set up in Laravel_project_root_directory/database/factories/AdminFactory.php and insert them into the database.

    
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

        $admin = Admin::create([
            'Rank' => $rank,
            'Institute_Name' => 'Arunima College',
            'institute_username' => 'arunima',
            'email' => 'arunima@oe.test',
            'password' => bcrypt('123456789a'),
            'Country' => 'Nepal',
            'Province_Name_Nepal' => 'Bagmati',
            'District_Nepal' => 'Kathmandu',
            'Village_Nepal' => 'Kathmandu',
            'Ward_No_Nepal' => '5',
            'Street_Address_Nepal' => 'Bouddha',
            'Last_Institute_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);

        $admin->Verified = '1';
        $admin->save();


        $useragent = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_9_3) AppleWebKit/537.75.14 (KHTML, like Gecko) Version/7.0.3 Safari/7046A194A';
      

        LoginDetail::create([
            'username' => 'arunima',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'admin',
            'Browser' => 'Chrome',
            'Platform' => 'AndroidOS',
            'Device' => 'WebKit',
        ]);

        $rank++;

        $admin = Admin::create([
            'Rank' => $rank,
            'Institute_Name' => 'Kathford International College of Engineering and Management',
            'institute_username' => 'kathford',
            'email' => 'kathford@oe.test',
            'password' => bcrypt('123456789k'),
            'Country' => 'Nepal',
            'Province_Name_Nepal' => 'Bagmati',
            'District_Nepal' => 'Lalitpur',
            'Village_Nepal' => 'Lalitpur',
            'Ward_No_Nepal' => '7',
            'Street_Address_Nepal' => 'Balkumari',
            'Last_Institute_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);
        $admin->Verified = '1';
        $admin->save();

        $useragent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:33.0) Gecko/20120101 Firefox/33.0';
     

        LoginDetail::create([
            'username' => 'kathford',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'admin',
            'Browser' => 'Chrome',
            'Platform' => 'Windows',
            'Device' => 'WebKit',
        ]);

        $rank++;

        $admin = Admin::create([
            'Rank' => $rank,
            'Institute_Name' => 'Nava Arunima Secondary School',
            'institute_username' => 'nava',
            'email' => 'nava@oe.test',
            'password' => bcrypt('123456789n'),
            'Country' => 'Nepal',
            'Province_Name_Nepal' => 'Bagmati',
            'District_Nepal' => 'Kathmandu',
            'Village_Nepal' => 'Gokarneshwor',
            'Ward_No_Nepal' => '9',
            'Street_Address_Nepal' => 'Aarubari',
            'Last_Institute_Name_Update' => date('Y-m-d H:i:s'),
            'Last_Password_Update'  => date('Y-m-d H:i:s'),
        ]);

        $useragent = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:33.0) Gecko/20120101 Firefox/33.0';
     

        LoginDetail::create([
            'username' => 'nava',
            'IP_Address' => request()->ip(),
            'User_Agent' => $useragent,
            'Login_DateandTime' => date('Y-m-d H:i:s'),
            'Login_Type' => 'Account Creation',
            'User_Type' => 'admin',
            'Browser' => 'Chrome',
            'Platform' => 'Windows',
            'Device' => 'WebKit',
        ]);




    }
}
