<div class="container-fluid text-center customjumbo">
    <h1 class="display-4" id="abc"> <i class="fa-solid fa-graduation-cap"></i>  Online Examination System  <i class="fa-solid fa-graduation-cap"></i></h1>
    @if (in_array(Route::currentRouteName(), ['user_homepage','registering_user','change_user_password','user_dashboard','viewing_user_profile','user_feedback']))
        <br/>
        <p> Give Online Exams For Any Subjects </p>
        <p> Improve Your Skills </p>
    @endif
    @if (in_array(Route::currentRouteName(), ['givingexam']))
        @yield('givingexamdetail')
    @endif
    @if (in_array(Route::currentRouteName(), ['admin_dashboard','change_admin_password','detail_about_admin_account','viewing_admin_profile','question_managing','user_list']))
        {{-- $details = Auth::guard('admin')->user();--}} {{--get currently authenticated admin--}}
        {{--$collegename = $details['College_Name']; --}}{{--//get currently autheticated admin College Name--}}
        <p>  {{ Auth::guard('admin')->user()->College_Name }} </p>{{--get currently authenticated admin college name--}}
    @endif
    @if(in_array(Route::currentRouteName(),['super_admin','changespassword','viewfeedback','viewingsuperadminprofile','detailaboutsaccount']))
        <h4> System Management Interface </h4>
        <p> {{Auth::guard('superadmin')->user()->First_Name}} {{' '}} {{isset(Auth::guard('superadmin')->user()->Middle_Name) ? Auth::guard('superadmin')->user()->Middle_Name: ' '}} {{ Auth::guard('superadmin')->user()->Last_Name }}</p>
    @endif
</div>
