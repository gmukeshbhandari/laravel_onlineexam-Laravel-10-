@if ($errors->has('adminemaillogin') || Session::has('accountloggedintoanotherdevice') || $errors->has('adminloginpassword') || Session::has('admin_emaillogin_errormsg') || Session::has('admin_login_errormsg'))

<div class="alert alert-danger">
        <ul>
        @error('adminemaillogin')
        <li> {{ $message }} </li>
        @enderror

        @error('adminloginpassword')
    <li> {{ $message }} </li>
        @enderror

        {!! Session::has('admin_login_errormsg') ? Session::get("admin_login_errormsg") : '' !!}
        {!! Session::has('admin_emaillogin_errormsg') ? Session::get("admin_emaillogin_errormsg") : '' !!}
        {!! Session::has('accountloggedintoanotherdevice') ? Session::get("accountloggedintoanotherdevice") : '' !!}
    </ul>
    </div>
@endif


@error('error_admin_login_msg')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

{{-- For Admin Registration Error From Controller --}}
@if (Session::has('err_msg') && Session::get('err_msg') == 'loginerror')

@else
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li> {{ $error }} </li>
                @endforeach
            </ul>
        </div>
    @endif
@endif


