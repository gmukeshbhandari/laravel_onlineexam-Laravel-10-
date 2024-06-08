@extends('layouts.master')
@section('content')
{{-- <div class="d-flex rounded align-items-center justify-content-center custommainscreen"> --}}
    {{-- <div class="d-flex align-items-center gap-2 justify-content-center custommainscreen"> --}}
    <div class="d-flex gap-2 justify-content-center align-items-center flex-grow-1 main-screen-user-admin mb-2">
            <div>
                <a class="btn btn-info btn-lg" href="{{ route('user_homepage') }}" role="button">USER</a>
            </div>
            <div>
                <a class="btn btn-info btn-lg" href="{{ route('admin_homepage') }}" role="button">ADMIN</a>
            </div>
        </div>
    </div>
@endsection