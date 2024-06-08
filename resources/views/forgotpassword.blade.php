@extends('layouts.master')
@section('title','Forgot Password - Online Examination System')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="d-flex mx-auto col-xl-6 col-md-10 col-sm-12 card p-3 custom-forgot-password">
            
            <form method="post"  action="{{ route('forgotpassword_check') }}">
                @csrf
            <div class="card-header h5 text-center text-white bg-primary">
                Forgot Password
            </div>
            <div class="card-body">
                <p class="card-text py-2">
                    Enter your email address, and we'll send you an email with instructions to reset your password.
                </p>
                @include('includes.error-message')
                @if(session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
        
                <div class="form-outline form-floating">
                    <input type="email"  maxlength="200" value="{{ old('email') }}" id="email" name="email" class="form-control my-3" value="Email"  placeholder="Enter Email" autofocus>
                    <label for="email"> Email </label>                     
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100"> Send Reset Link </button>
                <div class="d-flex justify-content-between mt-4">
                    <a class="" href="{{ route('admin_homepage') }}">Login / Register</a>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

@endsection