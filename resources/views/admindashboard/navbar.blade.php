<div class="navbar"> 
    <div class="logo">
        {{-- <img src="{{ asset('images/dashboard/logo.svg') }}" height="50" width="50" alt="Images">
        <span> {{ $admininfo->institute_username }} </span> --}}
        <span> Dashboard </span> 
    </div>
    <div class="institute_name">
        <h3 class="mb-0"> {{ $admininfo->Institute_Name }} </h3>
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
            <img src="{{ asset('images/dashboard/logo.svg') }}" alt="Images">
            <span class="name"> {{ $admininfo->institute_username }}</span>
        </div>
        {{-- <img src="{{ asset('images/dashboard/settings.svg') }}" class="icon"  alt="Images"> --}}
    </div>
</div>