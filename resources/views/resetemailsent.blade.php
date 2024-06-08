@extends('layouts.master')
@section('title','Reset Email Sent - Online Examination System')
@section('content')

<div class="d-flex justify-content-center align-items-center flex-grow-1">
    <div class="row">
        @if(session()->has('email'))
            <div class="d-flex mx-auto col-6 card p-3">
                
                <div class="card-header h5 d-flex text-center justify-content-center align-items-center text-primary bg-warning" style="height: 100px">
                    <i class="fa-4x fa-solid fa-envelope"></i>
                </div>
                <div class="card-body px-4 mt-4">
                    <h5> Check Your Email </h5>
                    <p class="card-text py-2">
                        We have just sent instructions to reset your password to {{ session('email') }}. Follow the next steps in that email.
                    </p>
                    <p> Remember to check your spam folder. </p>
                </div>
            </div>
        @endif
    </div>
</div>

@endsection