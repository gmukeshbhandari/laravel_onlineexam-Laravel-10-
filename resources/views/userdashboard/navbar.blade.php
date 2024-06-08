<div class="navbar"> 
    <div class="logo">
        {{-- <img src="{{ asset( $userinfo->image_file_path) }}" height="32" width="32" alt=""> --}}
        {{-- <img src="{{ asset( $userinfo->image_file_path) }}" alt="" style="width:32px;height:32px;object-fit:cover;border-radius:50%">  --}}
        {{-- <span> {{ $userinfo->user_username }} </span> --}}
        <span> Dashboard </span>
    </div>
    <div class="institute_name">
        <h3 class="mb-0"> {{ $fullname }} </h3>
    </div>
    <div class="icons">
        <img src="{{ asset('images/dashboard/search.svg') }}" class="icon" alt="Images">
        <img src="{{ asset('images/dashboard/app.svg') }}" class="icon"  alt="Images">
        <img src="{{ asset('images/dashboard/expand.svg') }}" class="icon"  alt="Images">
        <div class="notification">
            <img src="{{ asset('images/dashboard/notifications.svg') }}" alt="Images">
            <span> 1 </span>
        </div>
        <div class="user">
            <img src="{{ asset( $userinfo->image_file_path) }}" alt="" style="width:40px;height:40px;object-fit:cover;border-radius:50%">
            <span class="name"> {{ $userinfo->First_Name }} </span>
        </div>
        {{-- <img src="{{ asset('images/dashboard/settings.svg') }}" class="icon"  alt="Images"> --}}
    </div>
</div>