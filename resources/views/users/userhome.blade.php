@extends('layouts.master')
@section('title','User Home Page - Online Examination System')
@section('content')
<div class="d-flex flex-column" style="background:#ADD8E6">
  {{-- <div class="d-flex justify-content-between mb-2 custom-user-home align-items-stretch bg-danger p-4"> --}}
    <div class="d-flex justify-content-between mb-2 custom-user-home bg-danger">
      {{-- <div class="p-3 bg-warning" style="flex:1">   --}}
        <div class="p-3" style="flex:1;background-color:#8aadb8">
            <h4> Welcome </h4>
            <p> Here you can give online exams for different subjects. You can view the result right after you finish the exam and can even download the results. There will be Review of answer. So you will know what is the correct answer, what mistake did you do. </p>
            <img src="{{ asset('images/onlineexam.jpg') }}" class="img-fluid" alt="Image">
        </div>
        {{-- <div class="p-3 bg-success" style="flex:1"> --}}
        <div class="p-3" style="flex:1;background-color:#bde0eb">
          <div class="card">
            <div class="card-header d-flex align-items-center justify-content-center" style="background: #337ab7">
              <h5 class="mb-0"> User Login </h5>
            </div>
            <div class="user-login card-body">
              <form action="{{ route('user_checklogin') }}" method="POST">
                @csrf
                @include('includes.error-message')
                <div class="mb-3">
                  <label for="email" class="form-label"> Email </label>
                  <input type="email" maxlength="200" value="{{ $u_email ?? old('email') }}" class="form-control" name="email" id="email" placeholder="Enter Email" autofocus>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label"> Password </label>
                  <input type="password" maxlength="72" value="{{ $u_password ?? old('password') }}" class="form-control" name="password" id="password" placeholder="Enter Password">
                  <a id="anchortag" class="text-decoration-none btn btn-link" onclick="togglePasswordloginuser()"> Show/Hide </a>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="rememberuserlogin" name="rememberuserlogin" {{ $u_email ? 'checked' : '' }}>
                    <label class="form-check-label" for="rememberuserlogin"> Remember Me </label>
                </div>
                <button type="submit" class="btn btn-primary" name="userlogin"> Log In </button>
              </form>
            </div>
            <div class="d-flex justify-content-between card-footer text-body-secondary custom-new-user-register">
              <div class="text-center mb-2">
                New User?  <a class="btn btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Click Here to Register if you haven't registered yet" href="{{ route('registering_user') }}">
                Register </a>
                </div>
              <div class="text-center">
                <a class="btn btn-link" id="userforgotpassword" href="{{ route('forgotpassword') }}"> Forgot Password?  </a>
              </div>
            </div>
          </div>
        </div>
    </div>
    <div class="d-flex align-items-center justify-content-center text-center pb-2" style="line-height:10px">
        <div class="developerinfo">
            <h2> Developer </h2>
            <img src="{{ asset('images/mukesh.jpg') }}" class="rounded-circle img-fluid" alt="Images" style="max-width:60%">
            <br><br> <p> Mukesh Bhandari </p>
            <p> Kathmandu, Nepal </p>
            <!--This More Button will trigger modal -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#open_developer_info"> More </button>
        </div>
    </div>
              <!-- Modal -->
              <div class="modal fade" id="open_developer_info" tabindex="-1" aria-labelledby="exampleModalLabelDeveloper" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h3 class="modal-title fs-5" id="exampleModalLabelDeveloper"> Personal Contact </h3>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td> Name </td>
                                    <td> Mukesh Bhandari </td>
                                </tr>
                                <tr>
                                    <td> Permanent Address </td>
                                    <td> Kathmandu, Nepal </td>
                                </tr>
                                <tr>
                                    <td> Email </td>
                                    <td> gmukeshbhandari@gmail.com </td>
                                </tr>
                            </tbody>
                        </table>
                      <h4 id="developer_tag_h4"> Follow me @ </h4>
                      <div class="d-flex justify-content-start gap-2">
                      <a class="text-decoration-none px-2" target="_blank" href="https://www.twitter.com/tmukeshbhandari" rel="noopener noreferrer"> <i class="fa-brands fa-x-twitter"></i>  Twitter </a>
                      <a class="text-decoration-none" target="_blank" href="https://www.facebook.com/fmukesbhandari" rel="noopener noreferrer"> <i class="fa-brands fa-facebook"></i>  Facebook </i> </a>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn" data-bs-dismiss="modal"> Close </button>
                    </div>
                  </div>
                </div>
              </div>

</div>
<script src="{{ asset('js/custom/password_toggle.js') }}"></script>
@endsection
