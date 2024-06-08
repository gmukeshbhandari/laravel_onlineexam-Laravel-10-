@extends('admindashboard')
@section('title','Admin Dashboard - Online Examination System')
@section('content')
<div class="d-flex justify-content-center p-2 bg-white text-dark vh-100">
    <div class="custom-change-password"> 
    <form method="post" action="{{ route('change_admin_password_check') }}">
    @csrf
    @include('includes.error-message')
    <input type="hidden" name="guard" value="admin">
    <div>
        <h4> Change Password </h4>
    </div>
    <div class="mb-3 mt-3 form-floating">
        <input type="password" maxlength="60" class="form-control" id="oldpassword" name="oldpassword" placeholder="Enter your old password">
        <label for="oldpassword"> Current Password  <span style="color: red"> * </span> </label>
        <a class="custom-anchor-tag text-decoration-none btn btn-link" onclick="togglePasswordoldpasswordadmin()"> Show/Hide </a>
    </div>
    <div class="mb-3 mt-3 form-floating">
        <input type="password" maxlength="60" class="form-control" id="password" name="password" placeholder="Enter your new password">
        <label for="password"> New Password  <span style="color: red"> * </span> </label>
        <a class="custom-anchor-tag text-decoration-none btn btn-link" onclick="togglePasswordregisteradmin()"> Show/Hide </a>
    </div>
    <div class="mb-3 mt-3 form-floating">
        <input type="password" maxlength="60" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm you new password">
        <label for="confirmpassword"> Confirm New Password  <span style="color: red"> * </span> </label>
        <a class="custom-anchor-tag text-decoration-none btn btn-link" onclick="togglePasswordCheckregisteradmin()"> Show/Hide </a>
        <div class="mt-2">
        <span id="password_error">  </span>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
</div>

<script src="{{ asset('js/custom/password_toggle.js') }}"></script>
<script src="{{ asset('js/custom/changepassword.js') }}"> </script>
@endsection
