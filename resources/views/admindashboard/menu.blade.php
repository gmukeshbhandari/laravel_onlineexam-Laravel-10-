<div class="menu">
     <div class="item">
         <span class="title"> main  </span>
             <a class="listItem" href="{{ route('admin_dashboard') }}">
                 {{-- <img src="{{ asset('images/dashboard/home.svg') }}" alt=""> --}}
                 <i class="fa-solid fa-house"></i>
                 <span class="listItemTitle"> Home </span>
             </a>
             <a class="listItem" href="{{ route('admin_dashboard') }}">
                {{-- <img src="{{ asset('images/dashboard/user.svg') }}" alt=""> --}}
                <i class="fa-regular fa-user"></i>
                <span class="listItemTitle"> Profile </span>
            </a>
     </div>

     <div class="item">
        <span class="title"> education  </span>
            <a class="listItem" href="{{ route('student_list') }}">
                {{-- <img src="{{ asset('images/dashboard/user.svg') }}" alt=""> --}}
                <i class="fa-solid fa-user-group"></i>
                <span class="listItemTitle"> Students </span>
            </a> 
            {{-- <a class="listItem" href="{{ route('admin_dashboard') }}">
               <img src="{{ asset('images/dashboard/product.svg') }}" alt="">
               <span class="listItemTitle"> Departments </span>
           </a> --}}
           <a class="listItem" href="{{ route('admin_manage_faculties') }}">
            {{-- <img src="{{ asset('images/dashboard/post2.svg') }}" alt=""> --}}
            <i class="fa-solid fa-building"></i>
            <span class="listItemTitle"> Manage Faculties </span>
         </a>
           <a class="listItem" href="{{ route('admin_manage_subjects') }}">
            {{-- <img src="{{ asset('images/dashboard/order.svg') }}" alt=""> --}}
            <i class="fa-solid fa-book"></i>
            <span class="listItemTitle"> Manage Subjects </span>
        </a>

        <a class="listItem" href="{{ route('admin_manage_questions') }}">
            {{-- <img src="{{ asset('images/dashboard/post2.svg') }}" alt=""> --}}
            <i class="fa-solid fa-circle-question"></i>
            <span class="listItemTitle"> Manage Questions </span>
        </a>
        <a class="listItem" href="{{ route('admin_dashboard') }}">
            {{-- <img src="{{ asset('images/dashboard/post2.svg') }}" alt=""> --}}
            <i class="fa-solid fa-chalkboard-user"></i>
            <span class="listItemTitle"> Manage Exams </span>
        </a>
        <a class="listItem" href="{{ route('admin_dashboard') }}">
            {{-- <img src="{{ asset('images/dashboard/post2.svg') }}" alt=""> --}}
            <i class="fa-solid fa-bell"></i>
            <span class="listItemTitle"> View Results </span>
        </a>
    </div>
    <div class="item">
        <span class="title"> Settings  </span>
            <a class="listItem" href="{{ route('account_details_admin') }}">
                {{-- <img src="{{ asset('images/dashboard/settings.svg') }}" alt=""> --}}
                <i class="fa-solid fa-circle-info"></i>
                <span class="listItemTitle"> Account Details </span>
            </a>
            <a class="listItem" href="{{ route('change_admin_password') }}">
                {{-- <img src="{{ asset('images/dashboard/settings.svg') }}" alt=""> --}}
                <i class="fa-solid fa-lock"></i>
                <span class="listItemTitle"> Change Password </span>
            </a>
            <a  class="listItem" href="{{ route('delete_admin_account') }}" >
                {{-- <img src="{{ asset('images/dashboard/settings.svg') }}" alt=""> --}}
                <i class="fa-solid fa-trash"></i>
                <span class="listItemTitle"> Delete Account </span>
            </a>
            <a class="listItem" href="{{ route('log_out_admin') }}">
                {{-- <img src="{{ asset('images/dashboard/logout.svg') }}" alt=""> --}}
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="listItemTitle"> Log Out </span>
            </a>
    </div>
 </div>



