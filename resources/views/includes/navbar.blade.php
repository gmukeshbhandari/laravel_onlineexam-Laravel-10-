{{-- Main If Starting --}}
@if (in_array(Route::currentRouteName(), ['user_homepage','admin_homepage','user_dashboard','detail_about_user_account','admin_dashboard','detail_about_admin_account','user_list','super_admin','detailaboutsaccount','viewing_admin_profile','viewing_user_profile','viewingsuperadminprofile','question_managing','viewfeedback','change_user_password','change_admin_password','changespassword','forgotpassword','feedback','reset_email_sent','reset_password','registering_user']))
    <nav class="container-fluid navbar navbar-expand-lg navbar-dark bg-dark">
    {{-- <nav class="navbar navbar-expand-lg bg-body-tertiary"> --}}
        <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNavDropdown">

            {{-- IF1 Start --}} {{-- User Start--}} 
            @if (in_array(Route::currentRouteName(), ['user_homepage','admin_homepage','detail_about_user_account','user_dashboard','viewing_user_profile','change_user_password','forgotpassword','feedback','reset_email_sent','reset_password','registering_user']))

                {{-- IF1.1 Start --}}    
                @if (in_array(Route::currentRouteName(), ['user_homepage','admin_homepage','forgotpassword','feedback','reset_email_sent','reset_password','registering_user']))
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item ms-2">
                            <a class="nav-link" href="{{ route('home') }}">  <i class="fa-solid fa-house"></i>  Main Page </a>
                        </li>
                        <li class="nav-item ms-2">
                            <a data-bs-toggle="modal" data-bs-target="#open_contact_modal" class="nav-link" style="cursor: pointer"><i class="fa-solid fa-address-book"> </i> Contact </a>
                            @include('includes.contactdeveloper')
                        </li>
                        <li class="nav-item ms-2">
                            <a class="nav-link" href="{{ route('feedback') }}"> <i class="fa-solid fa-comment"> </i> Feedback </a>
                        </li>
                    </ul>
                @endif
                {{-- IF1.1 End --}}  

                {{-- IF1.2 Start --}}   
                @if (in_array(Route::currentRouteName(), ['user_dashboard','detail_about_user_account','change_user_password','viewing_user_profile']))
                    <ul class="navbar-nav me-auto">    
                        <li class="nav-item">
                            <a class="nav-link {{ in_array(Route::currentRouteName(), ['user_dashboard']) ? 'active' : ''}}" href="{{ route('user_dashboard') }}">  <i class="fa-solid fa-house"></i> </span> Home </a>
                        </li>
                    </ul>
                @endif
                {{-- IF1.2 End --}} 

                {{-- IF1.3 Start --}}  
                @if (in_array(Route::currentRouteName(), ['user_dashboard','detail_about_user_account','viewing_user_profile','change_user_password']))
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('user_dashboard') }}"  data-bs-toggle="dropdown" aria-expanded="false">  <i class="fa-solid fa-bars"></i> 
                        {{ Auth::guard('customuser')->user()->First_Name}} {{ '' }}
                        {{ isset(Auth::guard('customuser')->user()->Middle_Name) ? Auth::guard('customuser')->user()->Middle_Name : ''}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li> <a class="dropdown-item" href="{{ route('viewing_user_profile') }}">View Profile</a> </li>
                            <li> <a class="dropdown-item" href="{{ route('detail_about_user_account') }}">Account Details</a> </li>

                                {{-- IF1.3.1 Start --}} 
                                @if (in_array(Route::currentRouteName(), ['userdashboard','detailaboutuaccount']))
                                    <li> <a class="dropdown-item" href="{{ route('change_user_password') }}"> Change Password </a> </li>
                                @endif
                                {{-- IF1.3.1 End --}} 

                            <li> <a class="dropdown-item" href="{{ route('delete_account_user') }}"> <i class="fa-solid fa-trash"></i> Delete My Account </a>  </li>
                            <li> <a class="dropdown-item" href="{{route('log_out_user')}}"> <i class="fa-thin fa-arrow-right-from-bracket"></i> Logout </a> </li>
                        </ul>
                    </li>
                </ul>
                @endif
                {{-- IF1.3 End --}} 

            @endif
            {{-- IF1 End --}} {{-- User End--}} 


            {{-- IF2 Start --}}  {{-- Admin Start--}} 
            @if (in_array(Route::currentRouteName(), ['admin_dashboard','user_list','detail_about_admin_account','viewing_admin_profile','question_managing','change_aadmin_password']))
                <ul class="navbar-nav me-auto">    
                    <li class="nav-item">
                        <a class="nav-link {{ in_array(Route::currentRouteName(), ['admin_dashboard']) ? 'active' : ''}}" href="{{ route('admin_dashboard') }}">  <i class="fa-solid fa-house"></i>  Home </a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="{{ route('admin_dashboard') }}" data-bs-toggle="dropdown" aria-expanded="false"> <i class="fa-solid fa-bars"></i> 
                            {{ Auth::guard('admin')->user()->college_username }} 
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li> <a class="dropdown-item" href="{{ route('viewing_admin_profile') }}">View Profile</a> </li>
                            <li> <a class="dropdown-item" href="{{ route('detail_about_admin_account') }}">Account Details </a> </li>

                            {{-- IF2.2 Start --}}
                            @if (in_array(Route::currentRouteName(), ['admin_dashboard','user_list','detail_about_admin_account','viewing_admin_profile','question_managing']))
                                <li> <a class="dropdown-item" href="{{ route('change_admin_password') }}">Change Password</a> </li>
                            @endif
                            {{-- IF2.2 End --}}

                            <li> <a class="dropdown-item" href="{{ route('delete_account_admin') }}"> <i class="fa-solid fa-trash"> </i> Delete My Account </a> </li>
                            <li> <a class="dropdown-item" href="{{ route('log_out_admin') }}"> <i class="fa-solid fa-right-from-bracket"> </i> Logout </a> </li>
                        </ul>
                    </li>
                </ul>
            @endif
            {{-- IF2 End --}} {{-- Admin End--}} 


            {{-- IF3 Start --}} {{-- Super Admin Start--}} 
            @if(in_array(Route::currentRouteName(),['super_admin','detailaboutsaccount','viewfeedback','changespassword','viewingsuperadminprofile']))
                <ul class="navbar-nav me-auto">     
                    <li class="nav-item">
                        <a class="nav-link {{ in_array(Route::currentRouteName(), ['super_admin']) ? 'active' : ''}}" href="{{ route('super_admin') }}">  <i class="fa-solid fa-house"></i>  Home </a>
                    </li>
                </ul>

                {{-- IF3.1 Start --}}
                @if (in_array(Route::currentRouteName(), ['super_admin','detailaboutsaccount','changespassword','viewingsuperadminprofile']))
                    <ul class="navbar-nav">
                        <li class="nav-item"> <a class="nav-link" href="{{ route('viewfeedback') }}"> <i class="fa-solid fa-comment"></i> Feedbacks </a> </li>
                    </ul>
                @endif
                {{-- IF3.1 End --}}

                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle"  href="{{ route('super_admin') }}" data-bs-toggle="dropdown" aria-expanded="false">
                            {{ Auth::guard('superadmin')->user()->First_Name}} {{ '' }}
                            {{ isset(Auth::guard('superadmin')->user()->Middle_Name) ? Auth::guard('superadmin')->user()->Middle_Name : ''}}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li> <a class="dropdown-item" href="{{ route('viewingsuperadminprofile') }}"> View Profile </a> </li>
                            <li> <a class="dropdown-item" href="{{ route('detailaboutsaccount') }}"> Account Details </a> </li>

                            {{-- IF3.2 Start --}}
                            @if(in_array(Route::currentRouteName(),['super_admin','detailaboutsaccount','viewfeedback']))
                                <li> <a class="dropdown-item" href="{{ route('changespassword') }}"> Change Password </a> </li>
                            @endif
                            {{-- IF3.2 End --}}

                            <li> <a class="dropdown-item" href="{{ route('slog_out') }}"> <i class="fa-solid fa-right-from-bracket"></i> Logout </a>  </li>
                        </ul>
                    </li>
                </ul>
            @endif
            {{-- IF3 Start --}} {{-- Super Admin End--}} 
        </div>
    </nav>
@endif
{{-- Main If Ending--}}