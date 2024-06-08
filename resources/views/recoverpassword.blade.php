@extends('layouts.master')
@section('title','Forgot Password - Online Examination System')
@section('headsection')
<style>
    /* CUSTOM WIDTHS */
.w-50, .w-xs-50 { width: 50%!important; }
.w-75, .w-xs-75 { width: 75%!important; }
.w-100, .w-xs-100 { width: 100%!important; }

/* BREAKPOINTS */

/* SM breakpoint */
@media screen and (max-width: 600px) {
    /* CUSTOM WIDTHS */
    .w-sm-50 { width: 50%!important; }
    .w-sm-75 { width: 75%!important; }
    .w-sm-100 { width: 100%!important; }
}
</style>
@endsection
@section('content')
    <div class="d-flex justify-content-center align-items-center text-dark p-4 mb-2 w-50 w-sm-100 flex-grow-1">
        <div class="w-100 p-4 bg-white">
            @if(isset($msg))
                @if($msg == 'Sorry, your email cannot be identified.')
                    <h3 style="color:red"> <i> Sorry, your email cannot be identified. </i> </h3>
                @endif
                @if($msg == 'Link Expired.')
                    <h3 style="color:red"> <i> Link Expired. </i> </h3>
                @endif
            @endif
            @if(isset($email))
                <form method="post" action="{{ route('reset_password_check') }}">
                    @csrf
                    @include('includes.error-message')
                    <div>
                        <h4> Reset Password </h4>
                    </div>
                    <div class="mb-3 mt-3 form-floating">
                        <input type="text" maxlength="200" class="form-control" id="email" name="email" value="{{ $email }}" readonly>
                        <label for="email"> Email </label>
                    </div>
                    <input type="hidden" name="token" value="{{ $token  }}">
                    <div class="mb-3 mt-3 form-floating">
                        <input type="password" maxlength="60" class="form-control" id="password" name="password" placeholder="Enter your new password">
                        <label for="password"> New Password  <span style="color: red"> * </span> </label>
                        <a class="text-decoration-none btn btn-link" onclick="togglePasswordregisteradmin()"> Show/Hide </a>
                    </div>
                    <div class="mb-3 mt-3 form-floating">
                        <input type="password" maxlength="60" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm you new password">
                        <label for="confirmpassword"> Confirm New Password  <span style="color: red"> * </span> </label>
                        <a class="text-decoration-none btn btn-link" onclick="togglePasswordCheckregisteradmin()"> Show/Hide </a>
                        <div class="mt-2">
                        <span id="password_error">  </span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Reset Password</button>
                </form>
            @endif
        </div>
    </div>
<script src="{{ asset('js/custom/password_toggle.js') }}"></script>
@endsection