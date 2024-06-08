@extends('userdashboard')
@section('title','Delete Account - Online Examination System')
@section('content')
<div class="d-flex flex-column flex-grow-1 justify-content-center align-items-center">
    <div class="bg-white text-dark p-4">
    <form action="{{ route('delete_user_account_check') }}" method="post">
        @csrf
       
        <div>
            <p> To confirm, please enter your password below </p>
        </div>
        <div class="mt-2">
            @include('includes.error-message')
        </div>
        <div class="mb-3 mt-3 form-floating">
            <input type="password" maxlength="60" class="form-control" id="password" name="password" placeholder="Enter your new password">
            <label for="password"> Current Password  <span style="color: red"> * </span> </label>
            <a class="text-decoration-none btn btn-link" onclick="togglePasswordregisteradmin()"> Show/Hide </a>
           
        </div>
        <button type="submit" class="btn btn-primary"> Delete Account </button>
    </form>
</div>
</div>
@endsection

<script src="{{ asset('js/custom/password_toggle.js') }}"></script>