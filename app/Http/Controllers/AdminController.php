<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Users;
use App\Models\SuperAdmin;
use App\Models\DeletedAccount;
use App\Models\VerifyUser;
use App\Models\Feedback;
use App\Models\LoginDetail;
use App\Models\Province;
use App\Models\District;
use App\Models\Village;
use App\Models\Ward;
use App\Models\Faculty;
use App\Models\Subject;
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
use Illuminate\Http\Request;
use Jenssegers\Agent\Agent;
use App\Mail\VerifyEmail;
use Carbon\Carbon;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Storage;
use App\Rules\ResetPass;
use App\Rules\CurrentPassword;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Cookie;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         // Check if admin is already authenticated
        if (Auth::guard('admin')->check())
        {
             // Get the currently authenticated admin user
            $adminUser = Auth::guard('admin')->user();
            $admin = Admin::where('email',$adminUser->email)->first();
            if ($admin)
            {
                $isVerified = $admin->Verified;
                if ($isVerified == 0)
                {
                    $errormsg =  "Please confirm Your account by clicking link send to your email.";
                    Auth::guard('admin')->logout();
                    return redirect()->route('admin_homepage')->with('admin_login_errormsg',$errormsg);
                }
                else
                {
                    return redirect()->route('admin_dashboard');
                }
            }
        }
        $a_email = Cookie::get('a_email');
        $a_password = Cookie::get('a_password');
        return view('admin.adminhome')->with(['a_email' => $a_email, 'a_password' => $a_password]);
        //return view('admin.adminhome');
    }

    public function checkLogin(Request $request)
    {
       $formType = $request->input('form_type');
    //    $custommessages = [
    //     'required' => 'All field is required.',
    //     'email' => 'The email must be a valid email address.',
    // ];


    if ($formType === 'admin_login_form')
       {
        // this method will also works but custom error message send garnu paryo bhane muni ko validator method is needed
        // $request->validate([
        //     'adminemaillogin' => ['required', 'email'],
        //     'adminloginpassword' => ['required'],
        // ]);


        $custommessages = [
            'adminemaillogin.required' => 'The email address is required.',
            'adminloginpassword.email' => 'The email address must be a valid email.',
            'adminloginpassword.required' => 'The password is required.',
        ];



            $validator = Validator::make($request->all(), [
                'adminemaillogin' => ['required', 'email'],
                'adminloginpassword' => ['required'],
            ], $custommessages);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

           // $admin->adminloginpassword = bcrypt($request->input('adminloginpassword'));
             // If not authenticated, attempt to log in
                     //if (Auth::guard('admin')->attempt(['email' => $request->input('adminemaillogin'),'password' => $request->input('adminloginpassword')], $request->has('rememberadminlogin')))
             if (Auth::guard('admin')->attempt(['email' => $request->input('adminemaillogin'),'password' => $request->input('adminloginpassword')]))
                {
                    if($request->input('rememberadminlogin'))
                    {
                        Cookie::queue(Cookie::make('a_email', $request->input('adminemaillogin'), 46080)); //1 month = 46080 minute
                        Cookie::queue(Cookie::make('a_password', $request->input('adminloginpassword'), 46080)); //1 month = 46080 minute
                    }
                    else
                    {
                        // setcookie('a_email',"");
                        // setcookie('a_password',"");
                        Cookie::queue(Cookie::forget('a_email'));
                        Cookie::queue(Cookie::forget('a_password'));
                    }
                    $admin = Auth::guard('admin')->user();
                    // $admin = Admin::where('email',$adminUser->email)->first();
                        $isVerified = $admin->Verified;
                        if ($isVerified == 0)
                        {
                            $errormsg =  "Please confirm Your account by clicking link send to your email.";
                            Auth::guard('admin')->logout();
                            return redirect()->route('admin_homepage')->with('admin_emaillogin_errormsg',$errormsg);
                        }
                        if ($isVerified == 1)
                        {
                            if($admin->flag_en_dis == 0)
                            {
                                $errormsg =  "Account Disabled. Contact Your Institute";
                                Auth::guard('admin')->logout();
                                return redirect()->route('admin_homepage')->with('admin_login_errormsg',$errormsg);
                            }
                           else
                            {
                                // if($admin->flag_one_device == 1)
                                // {
                                //     $errormsg =  "Account Already Logged in another device. Logout First";
                                //     Auth::guard('admin')->logout();
                                //     return redirect()->route('admin_homepage')->with('accountloggedintoanotherdevice',$errormsg);
                                // }
                                // else
                                // {
                                    Admin::where('email', Auth::guard('admin')->user()->email)->update(['flag_one_device' => '1']);

                                    $len = Str::length($request->userAgent());
            if($len <= 250)
            {
             $useragent = $request->userAgent();
            }
            if($len > 250)
            {
             $useragent = Str::limit($request->userAgent(), 250);
            }
            $agentInfo = $this->configureAgent();
           LoginDetail::create([
                'username' => Auth::guard('admin')->user()->institute_username,
                'IP_Address' => request()->ip(),
                'User_Agent' =>$useragent,
                'Login_DateandTime' => date('Y-m-d H:i:s'),
                'Login_Type' => 'Log In with Password',
                'User_Type' => 'admin',
                'Browser' => $agentInfo['browser'],
                'Platform' => $agentInfo['platform'],
                'Device' => $agentInfo['device'],
            ]);

            return redirect()->route('admin_dashboard');

            }


                        }
                    //  return redirect()->intended('/admin/dashboard');
                }
          return back()->withErrors(['error_admin_login_msg' => 'Invalid Email or Password'])->with('err_msg','loginerror');
        }
    }



    public function adminDashboard()
    {
        $admininfo = Auth::guard('admin')->user();

        // $studentinfo = DB::table('users')->where('institute_username',$admininfo->institute_username)->get();
        $studentinfo = Users::where('institute_username',$admininfo->institute_username)->get();
        $info = Faculty::where('Institute_Username',$admininfo->institute_username);

        if ($info)
        {
            $total_faculty_count = $info->count();
            $total_subject_count = Subject::join('faculties', 'subjects.Faculty_ID', '=', 'faculties.id')->where('faculties.Institute_Username', $admininfo->institute_username)->count();
        }
        else
        {
            $total_faculty_count = 0;
            $total_subject_count = 0;
        }

       return view('admin.admin-dashboard', compact('admininfo', 'studentinfo','total_faculty_count','total_subject_count'));
    }

    public function studentList(Request $request)
    {
        // Without Search Bar
    //     $admininfo = Auth::guard('admin')->user();
    //     $perPage = $request->input('per_page', 10); // Default to 10 items per page
    //    $studentinfo = Users::where('institute_username',$admininfo->institute_username)->paginate($perPage);
    //    return view('admin.studentlist', compact('admininfo', 'studentinfo'));


         $admininfo = Auth::guard('admin')->user();
         $perPage = $request->input('per_page', 10); // Default to 10 items per page
         $page = request('page', 1);//Default page is 1
        $search_student = $request->input('search_student');
         $query = Users::where('institute_username', $admininfo->institute_username);
        if ($search_student) {
            // $query->where('First_Name', 'like', '%' . $search_student . '%');
            //$query->where('Gender', $search_student);
            $query->where(function ($q) use ($search_student) {
                $q->where('First_Name', 'like', '%' . $search_student . '%')
                    ->orWhere('Middle_Name', 'like', '%' . $search_student . '%')
                    ->orWhere('Last_Name', 'like', '%' . $search_student . '%')
                    ->orWhere('Gender', $search_student);

                if (in_array(strtolower($search_student), ['active', 'enabled', 'enable', 'activate'])) {
                    $q->orWhere('flag_en_dis', '1');
                }

                if (in_array(strtolower($search_student), ['inactive', 'disabled', 'disable', 'inactivate'])) {
                    $q->orWhere('flag_en_dis', '0');
                }
            });
        }

        $studentinfo = $query->paginate($perPage);
        if ($request->ajax()) {
            return view('admin.studentlist_search_table', compact('admininfo','studentinfo','search_student','perPage','page'))->render();
        }

         return view('admin.studentlist', compact('admininfo', 'studentinfo','search_student','perPage','page'));
    }

    public function changeAccountStatus ($id,Request $request)
    {
        $user = DB::table('users')->find($id);
        $current_account_status = $user->flag_en_dis;
        $per_page = request('per_page', 10); //10 is default value as provided in public function studentList function
        $page = request('page', 1);//Default page is 1

        if($current_account_status == 1)
        {
            Users::where('id', $user->id)->update(['flag_en_dis' => '0']);
            if (Auth::guard('customuser')->check())
            {
                if(Auth::guard('customuser')->user()->user_username === $user->user_username)
                {
                    $agentInfo = $this->configureAgent();
                    LoginDetail::create([
                        'username' => Auth::guard('customuser')->user()->user_username ,
                        'IP_Address' => request()->ip(),
                        'User_Agent' => $request->userAgent(),
                        'Login_DateandTime' => date('Y-m-d H:i:s'),
                        'Login_Type' => 'Log Out - Disable by Admin',
                        'User_Type' => 'user',
                        'Browser' => $agentInfo['browser'],
                        'Platform' => $agentInfo['platform'],
                        'Device' => $agentInfo['device'],
                    ]);
                    Auth::guard('customuser')->logout();
                }
            }
        }

        if($current_account_status == 0)
        {
            Users::where('id', $user->id)->update(['flag_en_dis' => '1']);
        }
        // return redirect()->route('student_list');
        return redirect()->route('student_list', ['per_page' => $per_page, 'page' => $page]);
    }


    public function changeMassAccountStatus(Request $request)
    {

        $ticked_students = $request->input('ticked_student_list');
        $per_page = request('per_page', 10); //10 is default value as provided in public function studentList function
        $page = request('page', 1);//Default page is 1

        foreach ($ticked_students as $student_id => $isChecked)
        // foreach ($ticked_students as $student_username => $isChecked)
        {
            // if ($isChecked)
            if ($isChecked === 'true')
            {
                // $current_account_status = Users::where('user_username',$student_username)->value('flag_en_dis');
                $current_account_status = Users::where('id',$student_id)->value('flag_en_dis');
                if($current_account_status == 1)
                {
                    Users::where('id',$student_id)->update(['flag_en_dis' => '0']);
                    if (Auth::guard('customuser')->check())
                    {
                        if(Auth::guard('customuser')->user()->user_username === $student_id)
                        {
                                $agentInfo = $this->configureAgent();
                                LoginDetail::create([
                                    'username' => Auth::guard('customuser')->user()->user_username,
                                    'IP_Address' => request()->ip(),
                                    'User_Agent' => $request->userAgent(),
                                    'Login_DateandTime' => date('Y-m-d H:i:s'),
                                    'Login_Type' => 'Log Out - Disable by Admin',
                                    'User_Type' => 'user',
                                    'Browser' => $agentInfo['browser'],
                                    'Platform' => $agentInfo['platform'],
                                    'Device' => $agentInfo['device'],
                                ]);
                                Auth::guard('customuser')->logout();
                        }
                    }
                }
                if($current_account_status == 0)
                {
                    Users::where('id',$student_id)->update(['flag_en_dis' => '1']);
                }
            }
        }
        return response()->json(['message' => 'successful','per_page' => $per_page, 'page' => $page]);
    }

    public function accountDetails(Request $request)
    {
        $admininfo = Auth::guard('admin')->user();
        // $perPage = $request->input('per_page', 10); // Default to 10 items per page
        // $page = request('page', 1);//Default page is 1
        //return view('admin.accountdetails', compact('admininfo', 'logindetails', 'agent'));
        $perPage = (int)$request->input('per_page', 10);
        $page = (int)request('page', 1);

        if (!in_array($perPage, [5, 10, 15, 20, 50, 100]))
        {
            $perPage = 10; // Set default per_page to 10 if the provided value is invalid
            //return Redirect::to(request()->url() . '?per_page=' . $perPage); // Redirect with corrected per_page value
            return Redirect::to(request()->url() . '?per_page=' . $perPage . '&page=' . $page);
        }
        $query = LoginDetail::where('username',$admininfo->institute_username);
        $logindetails = $query->paginate($perPage, ['*'], 'page', $page);

        // Check if the provided page is not in the range of available pages
        if ($page > $logindetails->lastPage()) {
            $page = 1; // Set page to 1 if the provided value is invalid
            $logindetails = $query->orderBy('Login_DateandTime', 'desc')->paginate($perPage, ['*'], 'page', $page); // Re-fetch with default page
            return Redirect::to(request()->url() . '?per_page=' . $perPage . '&page=' . $page);
        }

       $search_login_details = $request->input('search_login_details');
        if ($search_login_details) {
            // $query->where('First_Name', 'like', '%' . $search_student . '%');
            //$query->where('Gender', $search_student);
            $query->where(function ($q) use ($search_login_details) {

                if (in_array(strtolower($search_login_details), ['jan','janu','janua','januar','january'])) {
                    $search_login_details_custom = '-01-';
                }
                elseif(in_array(strtolower($search_login_details), ['feb','febr','febru','februa','februar','february']))
                {
                    $search_login_details_custom = '-02-';
                }
                elseif(in_array(strtolower($search_login_details), ['mar','marc','march']))
                {
                    $search_login_details_custom = '-03-';
                }
                elseif(in_array(strtolower($search_login_details), ['apr','apri','april']))
                {
                    $search_login_details_custom = '-04-';
                }
                elseif(in_array(strtolower($search_login_details), ['may']))
                {
                    $search_login_details_custom = '-05-';
                }
                elseif(in_array(strtolower($search_login_details), ['jun','june']))
                {
                    $search_login_details_custom = '-06-';
                }
                elseif(in_array(strtolower($search_login_details), ['jul','july']))
                {
                    $search_login_details_custom = '-07-';
                }
                elseif(in_array(strtolower($search_login_details), ['aug','augu','augus','august']))
                {
                    $search_login_details_custom = '-08-';
                }
                elseif(in_array(strtolower($search_login_details), ['sep','sept','septe','septem','septemb','septembe','september']))
                {
                    $search_login_details_custom = '-09-';
                }
                elseif(in_array(strtolower($search_login_details), ['oct','octo','octob','octobe','october']))
                {
                    $search_login_details_custom = '-10-';
                }
                elseif(in_array(strtolower($search_login_details), ['nov','nove','novem','novemb','novembe','november']))
                {
                    $search_login_details_custom = '-11-';
                }
                elseif(in_array(strtolower($search_login_details), ['dec','dece','decem','decemb','decembe','december']))
                {
                    $search_login_details_custom = '-12-';
                }
                else
                {
                    $search_login_details_custom = $search_login_details;
                }

                 // Convert the user input to a valid date format using Carbon
                //$searchDate = \Carbon\Carbon::createFromFormat('F', $search_login_details)->format('Y-m');

                $q->where('Login_DateandTime', 'like', '%' . $search_login_details . '%')
                ->orWhere('Login_DateandTime', 'like', '%' . $search_login_details_custom . '%')
                ->orWhere('User_Agent', 'like', '%' . $search_login_details . '%')
                    ->orWhere('Browser', 'like', '%' . $search_login_details . '%')
                    ->orWhere('Platform', 'like', '%' . $search_login_details . '%')
                    ->orWhere('Platform', 'like', '%' . $search_login_details . '%')
                    ->orWhere('IP_Address', 'like', '%' . $search_login_details . '%')
                    ->orWhere('Login_Type', 'like', '%' . $search_login_details . '%');

                if (in_array(strtolower($search_login_details), ['mobile', 'android'])) {
                    $q->orWhere('User_Agent', 'like', '%Mobile/Android%');
                }
            });
        }




        if ($request->ajax()) {
            // Count the number of matching records
            $matching_search_records_count = $query->count();
            //dd($matchingRecordsCount);
            $logindetails = $query->orderBy('Login_DateandTime', 'desc')->paginate($matching_search_records_count);
            return view('admin.accountdetails_search_table', compact('admininfo','logindetails','search_login_details','perPage','page'))->render();
        }
        else{
            $logindetails = $query->orderBy('Login_DateandTime', 'desc')->paginate($perPage);
            return view('admin.accountdetails', compact('admininfo', 'logindetails','search_login_details','perPage','page'));
        }
    }

    public function changePassword()
    {
        $admininfo = Auth::guard('admin')->user();
        $studentinfo = Users::where('institute_username',$admininfo->institute_username)->get();
         // $studentinfo = DB::table('users')->where('institute_username',$admininfo->institute_username)->get();
        return view('admin.changeadminpassword', compact('admininfo', 'studentinfo'));
    }

    public function changePasswordCheck(ChangePasswordRequest $request)
    {
        $admin = Admin::find(Auth::guard('admin')->user()->id);
        //  dd($admin);
        $admin->Previous_Password = $admin->password;
        $admin->password = bcrypt($request->password);
        $admin->flag_one_device = '0';
        $admin->Last_Password_Update = date('Y-m-d H:i:s');
        $admin->increment('No_of_Times_Password_Changed');

        $no_of_times_password_changed = $admin->No_of_Times_Password_Changed;
        if ($no_of_times_password_changed < 10) // 10 Old Password is stored
        {
            $old_password_lists = $admin->Old_Password_Lists_Admin;
            $new_passwords = bcrypt($request->password);
            $currentDate = now()->toDateTimeString(); // Get the current date

            if ($old_password_lists) {
                // If there are existing old password lists, concatenate the new text with a comma
                $old_password_lists .= "," . $currentDate . ":" . $new_passwords;
            } else {
                // If there are no existing  old password lists, set the new text directly
                $old_password_lists = $currentDate . ":". $new_passwords;
            }
            $admin->Old_Password_Lists_Admin = $old_password_lists;
        }
        $admin->save();
        $admin_email = $admin->email;
        $this->log_out($request,"Log Out - Change Password");
        Auth::guard('admin')->logout();
        if (Cookie::has('a_email') && Cookie::has('a_password'))
        {
            $cookie_email = Cookie::get('a_email');
            if ($admin_email === $cookie_email)
            {
                    Cookie::queue('a_email', $admin_email, 46080); // 1 month = 46080 minutes
                    Cookie::queue('a_password', $request->password, 46080); // 1 month = 46080 minutes
            }
        }
      return redirect()->route('admin_homepage')->with('admin_login_errormsg', "Your password has been successfully changed. Please log in with your new password to access your account.");
    }

    public function deleteAccount()
    {
        $admininfo = Auth::guard('admin')->user();
        return view('admin.deleteaccount', compact('admininfo'));
    }

    public function deleteAccountCheck(Request $request)
    {

        $currentGuard = 'admin';

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



        $admin = Admin::find(Auth::guard('admin')->user()->id);
        $admin_username = $admin->institute_username;
        $users = Users::where('institute_username', $admin_username)->get();
        $this->addDeletedAccounToDatabase($request);
        $this->log_out($request,"Log Out - Account Deleted");
        Auth::guard('admin')->logout();

        if ($admin->delete())
        {
            // Delete all records in login details of this admin and users associated with admin because all users will also be deleted.

             // Delete all records in login details of this admin
            LoginDetail::where('username', $admin_username)->delete();

             // Delete all records in login details of users associated with admin because all users will also be deleted.
           // Loop through each user and delete login details associated with their username
            foreach ($users as $user) {
                LoginDetail::where('username', $user->user_username)->delete();
                // Alternatively, you can also use the delete method on the user model
                // $user->loginDetails()->delete();
            }
            LoginDetail::where('username',)->delete();
             //Admin::where('institute_username', Auth::guard('admin')->user()->institute_username)->delete();
            return redirect()->route('admin_homepage')->with('admin_login_errormsg', "Account Deleted Successfully.");
        }
        else
        {
            return redirect()->route('admin_homepage')->with('admin_login_errormsg', "Sorry! Something went wrong. Account deletion failed.");
        }

    }


    public function forgotPassword()
    {
        if (Auth::guard('admin')->check() && Auth::guard('customuser')->check())
        {
                return redirect()->route('admin_dashboard');
        }
        return view('forgotpassword');
    }

    public function checkForgotPassword(Request $request)
    {
        $custommessages = [
            'email.required' => 'The email address is required.',
            'email.exists' => 'Email does not exist.',
            'email.max' => 'Invalid Email',
        ];




            $validator = Validator::make($request->all(), [
            'email' => ['required', 'max:200', 'string', new CheckEmail(),
            function ($attribute, $value, $fail)
            {
                if (!DB::table('users')->where('email', $value)->exists() && !DB::table('admins')->where('email', $value)->exists() && !DB::table('super_admins')->where('email', $value)->exists())
                {
                    $fail('Email does not exist.');
                }
            }
        ],
            ], $custommessages);

            if ($validator->fails()) {
                return back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $email = $request->input('email');
            $token = Str::random(40); // Generate a unique token

            // Check if the token already exists in Two table
            while (ResetPasswords::where('token', $token)->exists() || VerifyUser::where('token', $token)->exists()) {
                $token = Str::random(40); // Regenerate the token if it already exists
            }


            if(Users::where('email',$email)->exists() || Admin::where('email',$email)->exists() || SuperAdmin::where('email',$email)->exists())
            {
                if(Users::where('email',$email)->exists())
                {
                    $user = Users::where('email', $email)->first();
                    $name = $this->combineNames($user);
                }

                elseif(Admin::where('email',$email)->exists())
                {
                    $name = Admin::where('email',$email)->first()->Institute_Name;
                }

                elseif(SuperAdmin::where('email',$email)->exists())
                {
                    $user = SuperAdmin::where('email', $email)->first();
                    $name = $this->combineNames($user);
                }
            }
            ResetPasswords::where('email', $email)->where('Status', '1')->update(['Status' => '0']);


            $Reset_Password = ResetPasswords::create([
                'name' => $name,
                'email' => $email,
                'token' => $token,
                'Date_Sent' =>  date('Y-m-d H:i:s'),
            ]);


            $subject = "Reset Your Password";
            Mail::to($email)->send(new ResetPassword($subject, $Reset_Password));
            return redirect()->route('reset_email_sent')->with('email',$email);
    }

    public function resetPassword($token)
    {
            $info = ResetPasswords::where('token', $token)->first();

            if($info)
                {
                    if ($info->Status == 1)
                        {
                            // Convert the date string to a Carbon instance
                            $SentDate = Carbon::parse($info->Date_Sent);
                            // Get the current date and time
                            $currentDate = Carbon::now();
                            // Calculate the difference in hours
                            $hoursDifference = $currentDate->diffInHours($SentDate);

                                    // Calculate the difference in days
                                    //$daysDifference = $currentDate->diffInDays($yourDate);
                                    // Check if the difference is less than 2 days
                                    //if ($daysDifference < 2) {}

                                    //$minutesDifference = $currentDate->diffInMinutes($yourDate);
                                    // Check if the difference is less than 10 minutes
                                    //if ($minutesDifference < 10){}

                                    //$secondsDifference = $currentDate->diffInSeconds($yourDate);
                                    // Check if the difference is less than 40 seconds
                                    //if ($secondsDifference < 40) {}


                            if ($hoursDifference < 4)
                            {
                                $email = $info->email;
                                // return view('recoverpassword', compact('email'));
                                return view('recoverpassword', ['email' => $email, 'token' => $token]);
                            }
                            else
                            {
                                $msg = 'Link Expired.';
                                //return view('recoverpassword')->with('msg', 'Link Expired.');
                            }

                        }
                    else
                        {
                            $msg = 'Sorry, your email cannot be identified.';
                            //return view('recoverpassword')->with('msg', 'Sorry, your email cannot be identified.');
                        }
                }
            else
                {
                    $msg = 'Sorry, your email cannot be identified.';
                    //return view('recoverpassword')->with('msg', 'Sorry, your email cannot be identified.');
                }
            return view('recoverpassword')->with('msg', $msg);
    }



    public function resetPasswordCheck(ResetPasswordRequest $request)
    {
        $email = $request->input('email');
        $token = $request->input('token');

        $emailinuser = Users::where('email',$email)->exists();
        $emailinadmin = Admin::where('email',$email)->exists();
        if($emailinuser)
        {
            $info = Users::where('email',$email)->first();
        }
        if($emailinadmin)
        {
            $info = Admin::where('email',$email)->first();
        }

        //  dd($admin);
        $info->Previous_Password = $info->password;
        $info->password = bcrypt($request->password);
        $info->flag_one_device = '0';
        $info->Last_Password_Update = date('Y-m-d H:i:s');
        $info->increment('No_of_Times_Password_Changed');
        $info->save();

        $res_pass = ResetPasswords::where('token',$token)->first();
        $res_pass->Status = '0';
        $res_pass->save();

        if($emailinuser && Auth::guard('customuser')->check() && (Auth::guard('customuser')->user()->email === $email))
        {
            Users::where('email', Auth::guard('customuser')->user()->email)->update(['flag_one_device' => '0']);
            $useragent = Str::limit($request->userAgent(), 250);
            $agentInfo = $this->configureAgent();
            LoginDetail::create([
                'username' => Auth::guard('customuser')->user()->user_username,
                'IP_Address' => request()->ip(),
                'User_Agent' => $useragent,
                'Login_DateandTime' => date('Y-m-d H:i:s'),
                'Login_Type' => 'Log Out - Reset Password',
                'User_Type' => 'user',
                'Browser' => $agentInfo['browser'],
                'Platform' => $agentInfo['platform'],
                'Device' => $agentInfo['device'],
            ]);
            Auth::guard('customuser')->logout();
            return redirect()->route('user_homepage')->with('errormsg', "Your password has been reset successfully. Please log in with your new password to access your account.");
        }
        if($emailinuser && Auth::guard('customuser')->check() && (Auth::guard('customuser')->user()->email !== $email))
        {
            $useragent = Str::limit($request->userAgent(), 250);
            $agentInfo = $this->configureAgent();
            LoginDetail::create([
                'username' => Users::where('email',$email)->value('user_username'),
                'IP_Address' => request()->ip(),
                'User_Agent' => $useragent,
                'Login_DateandTime' => date('Y-m-d H:i:s'),
                'Login_Type' => 'Reset Password Without Log Out',
                'User_Type' => 'user',
                'Browser' => $agentInfo['browser'],
                'Platform' => $agentInfo['platform'],
                'Device' => $agentInfo['device'],
            ]);
            return redirect()->route('user_dashboard');
        }
        if($emailinuser && !Auth::guard('customuser')->check())
        {
            return redirect()->route('user_homepage')->with('errormsg', "Your password has been reset successfully. Please log in with your new password to access your account.");
        }

        if ($emailinadmin && Auth::guard('admin')->check() && (Auth::guard('admin')->user()->email === $email))
        {
            $this->log_out($request,"Log Out - Reset Password");
            Auth::guard('admin')->logout();
            return redirect()->route('admin_homepage')->with('admin_login_errormsg', "Your password has been reset successfully. Please log in with your new password to access your account.");
        }
        if($emailinadmin && Auth::guard('admin')->check() && (Auth::guard('admin')->user()->email !== $email))
        {
            $useragent = Str::limit($request->userAgent(), 250);
            $agentInfo = $this->configureAgent();
            LoginDetail::create([
                'username' => Admin::where('email',$email)->value('institute_username'),
                'IP_Address' => request()->ip(),
                'User_Agent' => $useragent,
                'Login_DateandTime' => date('Y-m-d H:i:s'),
                'Login_Type' => 'Reset Password Without Log Out',
                'User_Type' => 'admin',
                'Browser' => $agentInfo['browser'],
                'Platform' => $agentInfo['platform'],
                'Device' => $agentInfo['device'],
            ]);

            return redirect()->route('admin_dashboard');
        }
       if ($emailinadmin && !Auth::guard('admin')->check())
       {
        return redirect()->route('admin_homepage')->with('admin_login_errormsg', "Your password has been reset successfully. Please log in with your new password to access your account.");
       }

    }

    public function logout(Request $request)
    {
            $this->log_out($request,"Log Out");
            Auth::guard('admin')->logout();
            return redirect()->route('admin_homepage')->with('admin_login_errormsg', "You've Been Successfully Logged Out.");
    }

    function log_out($request,$logouttype)
    {
        Admin::where('email', Auth::guard('admin')->user()->email)->update(['flag_one_device' => '0']);
            $useragent = Str::limit($request->userAgent(), 250);
            $agentInfo = $this->configureAgent();
            LoginDetail::create([
                'username' => Auth::guard('admin')->user()->institute_username,
                'IP_Address' => request()->ip(),
                'User_Agent' =>$useragent,
                'Login_DateandTime' => date('Y-m-d H:i:s'),
                'Login_Type' => $logouttype,
                'User_Type' => 'admin',
                'Browser' => $agentInfo['browser'],
                'Platform' => $agentInfo['platform'],
                'Device' => $agentInfo['device'],
            ]);
    }


    function addDeletedAccounToDatabase($request)
    {
            $admin = Auth::guard('admin')->user();
            $agentInfo = $this->configureAgent();
            $useragent = Str::limit($request->userAgent(), 250);
            DeletedAccount::create([
                'email' => $admin->email,
                'username' => $admin->institute_username,
                'Deleted_Date_Time' => date('Y-m-d H:i:s'),
                'IP_Address' => request()->ip(),
                'User_Agent' =>$useragent,
                'Account_Type' => 'admin',
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




    function combineNames($user) {
        $nameParts = [$user->First_Name, $user->Middle_Name, $user->Last_Name];
         // Remove any empty parts and concatenate with a space
        $filteredNameParts = array_filter($nameParts, function ($part) {
            return !empty($part);
        });
         // Combine the names into a full name and return back
        return implode(' ', $filteredNameParts);
    }



    public function checkEmailAvailability(Request $request)
    {
        $emailExistsinusersdatabase = Users::where('email', $request->input('email'))->exists();
        $emailExistsinadminsdatabase = Admin::where('email', $request->input('email'))->exists();
        //Return three value to ajax with json
    //     $value1 = 'Hello';
    //     $value2 = 'World';
    //     $value3 = 42;

    // return response()->json([
    //     'key1' => $value1,
    //     'key2' => $value2,
    //     'key3' => $value3,
    // ]);
    // In ajax in blade
    // success: function (response) {
    //     var key1Value = response.key1;
    //     var key2Value = response.key2;
    //     var key3Value = response.key3;
    // }

        if ($emailExistsinusersdatabase || $emailExistsinadminsdatabase)
        {
            $emailexistcheck = "Email Exist";
            return response()->json(['email_exist_check' => $emailexistcheck]);
            //email_exist_check bhanne key ma "Email Exist" bhanne value pass huncha

        }
        if (!$emailExistsinusersdatabase && !$emailExistsinadminsdatabase)
        {
            $emailexistcheck = "Email Does Not Exist";
            return response()->json(['email_exist_check' => $emailexistcheck]);
             //email_exist_check bhanne key ma "Email Does Not Exist" bhanne value pass huncha
        }
        // return response()->json([
        //     'email_exist_check' => $emailexistcheck,
        //     'username_exist_check' => $usernameexistcheck,
        // ]);
    }


    public function checkusernameAvailablity(Request $request)
    {

            $username = $request->input('username');
            $usernameExistsinusersdatabase = Users::where('user_username', $username)->exists();
            $usernameExistsinadminsdatabase = Admin::where('institute_username', $username)->exists();
            $usernameExistsindeleteddatabase = DeletedAccount::where('username', $username)->exists();

            $usernameExistCheck = ($usernameExistsindeleteddatabase|| $usernameExistsinusersdatabase || $usernameExistsinadminsdatabase) ? 'Username Exist' : 'Username Does Not Exist';

            return response()->json(['username_exist_check' => $usernameExistCheck]);


        // try {
        // //Working Code Here
        // } catch (\Exception $e)
        // {
        // // Log the exception
        // \Log::error('Exception in checkusernameAvailablity: ' . $e->getMessage());

        // // Return a more detailed error response
        // return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);

        // }


        // if ($usernameExistsinusersdatabase || $usernameExistsinadminsdatabase)
        // {
        //     $usernameexistcheck = "Username Exist";
        //     return response()->json(['username_exist_check' => $usernameexistcheck]);
        //     //username_exist_check bhanne key ma "Username Exist" bhanne value  pass huncha
        // }
        // if (!$usernameExistsinusersdatabase && !$usernameExistsinadminsdatabase)
        // {
        //     $usernameexistcheck = "Username Does Not Exist";
        //     return response()->json(['username_exist_check' => $usernameexistcheck]);
        //     //username_exist_check bhanne key ma "Username Does Not Exist" bhanne value  pass huncha
        // }
    }

    public function checkUsernameEmailAvailablity(Request $request)
    {
        $email = $request->input('email');
        $username = $request->input('username');
        $institute_name = $request->input('institute_name');

        if(!$institute_name)
        {
            $ins_msg = "institute_name_required";
        }
        if((strlen($institute_name) > 60) || (!preg_match('/^[a-zA-Z ]+$/', $institute_name)))
        {
            if((strlen($institute_name) > 60) && (!preg_match('/^[a-zA-Z ]+$/', $institute_name)))
            {
                $ins_msg = "name_greater_than_60_and_space_alphabets_only.";
            }
            if (strlen($institute_name) > 60) {
                // Name is greater than 60 characters
                $ins_msg = "Institute name must not be greater than 60 characters.";
            }
            if (!preg_match('/^[a-zA-Z ]+$/', $institute_name)) {
                // Name contains characters other than alphabets and spaces
                $ins_msg = "Institute name should contain only alphabets and spaces.";
            }
        }

        if($institute_name && (strlen($institute_name) <= 60) && (preg_match('/^[a-zA-Z ]+$/',$institute_name)))
        {
            $ins_msg ="institute_no_error";
        }


        $useremail =  Users::where('email',$email)->exists();
        $adminemail = Admin::where('email',$email)->exists();
        $adminusername =  Admin::where('institute_username',$username)->exists();
        $userusername =  Users::where('user_username',$username)->exists();
        $deletedusername = DeletedAccount::where('username', $username)->exists();

        if ($adminemail ||  $useremail || $adminusername || $userusername || $deletedusername)
        {
            if (($adminemail || $useremail) && (!$adminusername && !$userusername && !$deletedusername))
            {
                return response()->json(['exist_check' => 'EmailExist','ins_msg' => $ins_msg]);
            }
            if ((!$adminemail && !$useremail) && ($adminusername || $userusername || $deletedusername))
            {
                return response()->json(['exist_check' => 'Usernameexist','ins_msg' => $ins_msg]);
            }
            if (($adminemail || $useremail) && ($adminusername || $userusername || $deletedusername))
            {
                return response()->json(['exist_check' => 'BothExist','ins_msg' => $ins_msg]);
            }
        }
        else
        // if (!$adminemail &&  !$useremail && !$adminusername && !$userusername && !$deletedusername)
        {
            return response()->json(['exist_check' => 'BothAvailable','ins_msg' => $ins_msg]);
        }
    }

    public function sendVerificationCodeToEmail(Request $request)
    {
        $email = $request->input('email');
        $ins_name= $request->input('ins_name');
        $token = Str::random(10);

        $country = $request->input('country');

        if ($country === "Nepal")
        {
            $province = $request->input('province');
            $district = $request->input('district');
            $village = $request->input('village');


            $province_id = Province::where('Province',$province)->value('id');
            $district_id = District::where('province_id',$province_id)->where('District',$district)->value('id');
            $village_id = Village::where('district_id',$district_id)->where('Village', $village)->value('id');

            $custom_attributes = [
                'email' => 'email',
                'country' => 'country',
                'province' => 'province',
                'district' => 'district',
                'village' => 'village',
                'ward_no' => 'ward',
                'street_address' => 'street address',
            ];

            $custom_messages = [
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
                'country' => ['required', Rule::in(['Afghanistan','Aland Islands','Albania','Algeria','American Samoa','Andorra','Angola','Anguilla','Antarctica','Antigua and Barbuda','Argentina','Armenia','Aruba','Ascension Island','Australia','Austria','Azerbaijan','Bahamas','Bahrain','Bangladesh','Barbados','Belarus','Belgium','Belize','Benin','Bermuda','Bhutan','Bolivia','Bosnia and Herzegovina','Botswana','Bouvet Island','Brazil','British Indian Ocean Territory','British Virgin Islands','Brunei','Bulgaria','Burkina Faso','Burundi','Cambodia','Cameroon','Canada','Canary Islands','Cape Verde','Caribbean Netherlands','Cayman Islands','Central African Republic','Ceuta and Melilla','Chad','Chile','China','Christmas Island','Clipperton Island','Cocos  Islands','Colombia','Comoros','Congo - Brazzaville','Congo - Kinshasa','Cook Islands','Costa Rica','Cote d\'Ivoire','Croatia','Cuba','Curacao','Cyprus','Czechia','Denmark','Diego Garcia','Djibouti','Dominica','Dominican Republic','Ecuador','Egypt','El Salvador','Equatorial Guinea','Eritrea','Estonia','Ethiopia','Falkland Islands','Faroe Islands','Fiji','Finland','France','French Guiana','French Polynesia','French Southern Territories','Gabon','Gambia','Georgia','Germany','Ghana','Gibraltar','Greece','Greenland','Grenada','Guadeloupe','Guam','Guatemala','Guernsey','Guinea','Guinea-Bissau','Guyana','Haiti','Heard and McDonald Islands','Honduras','Hong Kong','Hungary','Iceland','India','Indonesia','Iran','Iraq','Ireland','Isle of Man','Israel','Italy','Jamaica','Japan','Jersey','Jordan','Kazakhstan','Kenya','Kiribati','Kosovo','Kuwait','Kyrgyzstan','Laos','Latvia','Lebanon','Lesotho','Liberia','Libya','Liechtenstein','Lithuania','Luxembourg','Macau','Macedonia','Madagascar','Malawi','Malaysia','Maldives','Mali','Malta','Marshall Islands','Martinique','Mauritania','Mauritius','Mayotte','Mexico','Micronesia','Moldova','Monaco','Mongolia','Montenegro','Montserrat','Morocco','Mozambique','Myanmar (Burma)','Namibia','Nauru','Nepal','Netherlands','New Caledonia','New Zealand','Nicaragua','Niger','Nigeria','Niue','Norfolk Island','Northern Mariana Islands','North Korea','Norway','Oman','Pakistan','Palau','Palestine','Panama','Papua New Guinea','Paraguay','Peru','Philippines','Pitcairn Islands','Poland','Portugal','Puerto Rico','Qatar','Reunion','Romania','Russia','Rwanda','Samoa','San Marino','Sao Tome and Principe','Saudi Arabia','Senegal','Serbia','Seychelles','Sierra Leone','Singapore','Sint Maarten','Slovakia','Slovenia','Solomon Islands','Somalia','South Africa','South Georgia and South Sandwich Islands','South Korea','South Sudan','Spain','Sri Lanka','St. Barthelemy','St. Helena','St. Kitts and Nevis','St. Lucia','St. Martin','St. Pierre and Miquelon','St. Vincent and Grenadines','Sudan','Suriname','Svalbard and Jan Mayen','Swaziland','Sweden','Switzerland','Syria','Taiwan','Tajikistan','Tanzania','Thailand','Timor-Leste','Togo','Tokelau','Tonga','Trinidad and Tobago','Tristan da Cunha','Tunisia','Turkey','Turkmenistan','Turks and Caicos Islands','Tuvalu','U.S. Outlying Islands','U.S. Virgin Islands','Uganda','Ukraine','United Arab Emirates','United Kingdom','United States','Uruguay','Uzbekistan','Vanuatu','Vatican City','Venezuela','Vietnam','Wallis and Futuna','Western Sahara','Yemen','Zambia','Zimbabwe'])],
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
        }


        VerifyUser::where('email', $email)->delete();
        //VerifyUser::where('token', $token)->delete();
        $Verify_Email = VerifyUser::create([
            'name' => $ins_name,
            'email' => $email,
            'token' => $token,
            'Date_Sent' =>  date('Y-m-d H:i:s'),
        ]);

        $subject = "Verification Code";
        Mail::to($email)->send(new VerifyEmail($subject, $Verify_Email));
       return response()->json(['msg' => 'success']);
    }

    public function checkVerificationCode(Request $request)
    {
            $email = $request->input('email');
            $verificationcode = $request->input('ver_code');
            $info = VerifyUser::where('email',$email)->first();

             if($info)
                 {
                    $info_token = VerifyUser::where('email',$email)->where('token',$verificationcode)->first();
                    if ($info_token)
                    {
                        if ($info_token->Status == 1)
                        {
                            // Convert the date string to a Carbon instance
                            $SentDate = Carbon::parse($info->Date_Sent);
                            // Get the current date and time
                            $currentDate = Carbon::now();
                            // Calculate the difference in hours
                            $hoursDifference = $currentDate->diffInHours($SentDate);

                                    // Calculate the difference in days
                                    //$daysDifference = $currentDate->diffInDays($yourDate);
                                    // Check if the difference is less than 2 days
                                    //if ($daysDifference < 2) {}

                                    //$minutesDifference = $currentDate->diffInMinutes($yourDate);
                                    // Check if the difference is less than 10 minutes
                                    //if ($minutesDifference < 10){}

                                    //$secondsDifference = $currentDate->diffInSeconds($yourDate);
                                    // Check if the difference is less than 40 seconds
                                    //if ($secondsDifference < 40) {}


                            if ($hoursDifference < 4)
                            {
                                $msg = "Done";
                            }
                            else
                            {
                                $msg = 'Code Expired';
                            }

                        }

                        else
                        {
                            $msg = 'Invalid Verification Code';

                        }
                    }

                    else
                        {
                            $msg = 'Invalid Verification Code';

                        }
                 }
             else
                 {
                     $msg = 'Email Not Found';
                 }
        return response()->json(['msg' => $msg]);
    }


    public function checkregistration(AdminRegistrationRequest $request)
    {
        if (Auth::guard('admin')->check())
        {
            $updateverifyuserdetail = VerifyUser::where('email',$request->input('adminemailregister'))->first();
            $updateverifyuserdetail->Status = '0';
            $updateverifyuserdetail->save();
           return redirect()->route('admin_dashboard');
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



        $admin = Admin::create([
            'Rank' => $rank,
            'Institute_Name' => $request->input('institutename'),
            'institute_username' => $request->input('adminusernameregister'),
            'email' =>$request->input('adminemailregister'),
            'password' => bcrypt($request->input('password')),
            'Country' => $request->input('country'),
            'Province_Name_Nepal' => $request->input('province'),
            'District_Nepal' => $request->input('district'),
            'Village_Nepal' => $request->input('village'),
            'Ward_No_Nepal' => $request->input('wardno'),
            'Street_Address_Nepal' => $request->input('streetaddress'),
            'Last_Institute_Name_Update' => $date,
            'Last_Password_Update' => $date,
        ]);

        $admin->Verified = '1';
        $admin->save();

        $updateverifyuserdetail = VerifyUser::where('email',$request->input('adminemailregister'))->first();
        $updateverifyuserdetail->Status = '0';
        $updateverifyuserdetail->save();


       // Auth::guard('admin')->login($admin);
       $len = Str::length($request->userAgent());
       if($len <= 250)
       {
        $useragent = $request->userAgent();
       }
       if($len > 250)
       {
        $useragent = Str::limit($request->userAgent(), 250);
       }

        $agentInfo = $this->configureAgent();
        $adminaccountdetail = new LoginDetail();
        $adminaccountdetail->username =$request->input('adminusernameregister');
        $adminaccountdetail->IP_Address = request()->ip();
        $adminaccountdetail->User_Agent = $useragent;
        $adminaccountdetail->Login_DateandTime = $date;
        $adminaccountdetail->Login_Type = 'Account Creation';
        $adminaccountdetail->User_Type = 'admin';
        $adminaccountdetail->Browser = $agentInfo['browser'];
        $adminaccountdetail->Platform =  $agentInfo['platform'];
        $adminaccountdetail->Device = $agentInfo['device'];
        $adminaccountdetail->save();

      return redirect()->route('admin_homepage')->with('admin_login_errormsg','Congratulations on successfully signing up! 🎉 Feel free to log in now. We are thrilled to have you with us!');



    }

    public function feedback()
    {
        // $data = Feedback::where('email','kathford@oe.test')->first()->image_file_location;
       // return view('feedback', compact('data'));
       return view('feedback');

    }

    public function checkFeedback(Request $request)
    {
        $custommessages = [
            'email.required' => 'The email address is required.',
            'email.exists' => 'Email does not exist.',
            'email.max' => 'Invalid Email',
            'feedbacktopic.required' => 'Please provide the topic.',
            'feedbacktopic.max' => 'Topic cannot exceed 100 character',
            'feedbackdescription.required' => 'Please provide a description.',
            'feedbackdescription.max' => 'Maximum length for description is 10000.',
            'feedbackimage.image' => 'The image must be an image file.',
            'feedbackimage.mimes' => 'The image must be of type: jpg, png, bmp.',
            'feedbackimage.size' => 'Image should be less than 2 MB.',
        ];




            $validator = Validator::make($request->all(), [
            'email' => ['required', 'max:200', 'string', new CheckEmail(),
            function ($attribute, $value, $fail)
            {
                // $attribute: the name of the attribute being validated, in this case, 'email'
                // $value: the value of the 'email' field being validated
                // $fail: a callback to report a validation failure

                if (!DB::table('users')->where('email', $value)->exists() && !DB::table('admins')->where('email', $value)->exists() && !DB::table('super_admins')->where('email', $value)->exists())
                {
                    $fail('Email does not exist.');
                }
            }
        ],
            'feedbacktopic' => ['required', 'string', 'max:100'],
            'feedbackdescription' => ['required', 'string', 'max:10000'],
            'feedbackimage' => ['nullable','image','max:2048','mimes:jpg,jpeg,png,bmp'],
            ], $custommessages);

            //handling uploaded image if uploaded so that it can be store back




            if ($validator->fails()) {
                if ($request->hasFile('feedbackimage')) {
                        $imagePath = $request->file('feedbackimage')->store('temp_images', 'public'); // Store the image in a temporary location i.e 'imagePath = 'temp_images/randomname.image_file_extension'
                        //dd($imagePath);
                        session()->flash('old_feedbackimage', $imagePath); // Save the image path to the session i.e old_feedbackimage = 'temp_images/randomname.image_file_extension'
                        session()->flash('image_path', $imagePath);
                        // dd(session('old_feedbackimage'));
                    }
                elseif($request->has('oldimage')) {
                        session()->flash('old_feedbackimage', $request->input('oldimage'));
                        session()->flash('image_path',$request->input('imagepath'));
                    }

                return back()
                    ->withErrors($validator)
                    ->withInput();
            }
            if (Admin::where('email',$request->email)->exists()){
                $usertype = 'admin';
            }
            if (Users::where('email',$request->email)->exists()){
                $usertype = 'user';
            }
            if (SuperAdmin::where('email',$request->email)->exists()){
                $usertype = 'superadmin';
            }
            if ($request->hasFile('feedbackimage')) {
                // If image is present in the request, move it to images/uploaded/feedback
                $imagePath = $request->file('feedbackimage')->store('images/uploaded/feedback', 'public');
                $image_location = '/storage/'.$imagePath;
                // dd($image_location);
            }
            elseif($request->has('oldimage')){
                $sourcePath = $request->input('oldimage');
                $destinationDirectory  = 'images/uploaded/feedback';
                $filename = pathinfo($sourcePath, PATHINFO_FILENAME);
                $extension = pathinfo($sourcePath, PATHINFO_EXTENSION);
                $newFilePath = $destinationDirectory . '/' . $filename . '.' . $extension;
                Storage::move('public/' . $sourcePath, 'public/' . $newFilePath);
                // Get the URL for the new image
                // $image_location = Storage::url($destinationDirectory . $filename);
                $image_location = Storage::url($newFilePath);
                // dd($image_location);
            }
            else{
                $image_location = '';
            }


            $useragent = Str::limit($request->userAgent(), 250);
            Feedback::create([
                'email' => $request->email,
                'Topic' => $request->feedbacktopic,
                'Description' => $request->feedbackdescription,
                'image_file_location' => $image_location,
                'Feedback_DateandTime' => date('Y-m-d H:i:s'),
                'IP_Address' => request()->ip(),
                'User_Agent' =>$useragent,
                'User_Type' => $usertype,
            ]);

            return redirect()->route('feedback')->with('errormsg', "Feedback submitted");
    }

}
