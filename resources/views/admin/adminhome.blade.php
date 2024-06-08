@extends('layouts.master')
@section('content')
  <div class="container-fluid">
    <div class="row justify-content-center">
      <div class="col-md-4 p-4" style="background: white">
        <!-- Nav tabs -->
        <ul class="nav nav-pills nav-justified mb-3" id="formTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <a class="nav-link active" id="login-tab" data-bs-toggle="pill" href="#login" role="tab" aria-controls="login" aria-selected="true">Login</a>
          </li>
          <li class="nav-item" role="presentation">
            <a class="nav-link" id="register-tab" data-bs-toggle="pill" href="#register" role="tab" aria-controls="register" aria-selected="false">Register</a>
          </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Login Form -->
          <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
            <form method="post" id="loginform" action="{{ route('admin_checklogin') }}">
              @csrf
              @include('includes.admin-login-error-message')
              <input type="hidden" name="form_type" value="admin_login_form">
              {{-- <div class="text-center mb-3">
              <p>Sign in with:</p>
              <button type="button" class="btn btn-link btn-floating mx-1">
              <i class="fa-brands fa-facebook"></i>
              </button>
              <button type="button" class="btn btn-link btn-floating mx-1">
              <i class="fa-brands fa-google"></i>
              </button>
              <button type="button" class="btn btn-link btn-floating mx-1">
              <i class="fa-brands fa-x-twitter"></i>
              </button>
              </div>
              <p class="text-center">or:</p> --}}
              <!-- Email input -->
              <div class="mb-3 mt-3 form-floating">
                <input type="email" maxlength="200" value="{{ $a_email ?? old('adminemaillogin') }}" class="form-control" id="adminemaillogin" name="adminemaillogin" placeholder="Enter Email" autofocus>
                <label for="adminemaillogin">Email</label>
              </div>
              <!-- Password input -->
              <div class="mb-4 mt-3 form-floating">
                <input type="password" maxlength="72" value="{{ $a_password ?? old('adminloginpassword') }}" class="form-control" id="adminloginpassword" name="adminloginpassword" placeholder="Enter Password">
                <label for="adminloginpassword">Password</label>
                <a id="anchortag" class="text-decoration-none btn btn-link" onclick="togglePasswordloginadmin()"> Show/Hide </a>
              </div>
              <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="rememberadminlogin" name="rememberadminlogin" {{ $a_email ? 'checked' : '' }}>
                <label class="form-check-label" for="rememberadminlogin"> Remember Me </label>
            </div>
              <div class="d-flex justify-content-between custom-login-admin">
                <div class="text-center mb-2">
                  <button type="submit" class="btn btn-primary btn-block"> SIGN IN </button>
                </div>
                <div class="text-center">
                  <a href="{{ route('forgotpassword') }}">Forgot password?</a>
                </div>
              </div>
            </form>
          </div>
          <!-- Registration Form -->
          <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
              <form id="registration_form" method="post" action="{{ route('admin_register_check') }}">
              @csrf
              {{-- Showing Errors --}}
              @if ($errors->any() || Session::has('error_admin_login_msg') || Session::get("warning"))
              <div class="alert alert-danger" id="registerError" style="display: none">
                  <ul>
                      @foreach ($errors->all() as $error)
                          <li> {{ $error }} </li>
                      @endforeach
                      {!! Session::has('errormsg') ? Session::get("errormsg") : '' !!}
                      {!! Session::has('warning') ? Session::get("warning") : '' !!}
                    </ul>
                  </ul>
              </div>
          @endif
          {{-- Finished Showing Errors --}}

              <div>
              {{-- <hr> --}}
              <p class="text-danger text-center border-top border-bottom"> All fields are required unless specified optional. </p>
              {{-- <hr> --}}
              </div>
              <nav aria-label="Page navigation example">
                <ul class="pagination pagination-sm justify-content-center">
                  <li class="custom-next-page-1 page-item active" data-step="1"> <span class="page-link"> First Step </span> </li>
                  <li class="custom-next-page-2 pagepage-item" data-step="2"> <span class="page-link"> Second Step </span> </li>
                  <li class="custom-next-page-3 page-item" data-step="3"> <span class="page-link"> Third Step </span> </li>
                  <li class="custom-next-page-4 page-item" data-step="4"> <span class="page-link"> Last Step </span> </li>
                </ul>
              </nav>
              <div class="progress">
                <div class="progress-bar" id="progress-bar"></div>
              </div>

              {{--
              <ul class = "breadcrumb">
              <li class = "breadcrumb-item"> <a href = "#"> <i class="fa-solid fa-circle-chevron-left"></i> Previous </a> </li>
              <li class = "breadcrumb-item"> <a href = "#"> First Step </a> </li>
              <li class = "breadcrumb-item"> <a href = "#"> Second Step </a> </li>
              <li class = "breadcrumb-item"> <a href = "#"> Last Step </a> </li>
              <li class = "breadcrumb-item"> <a href = "#"> Next <i class="fa-solid fa-circle-chevron-right"></i> </a> </li>
              </ul>   --}}
              <div class="step" id="step1">
                <h2> Step 1: General Information </h2>
                <div class="mb-3 mt-3 form-floating">
                  <input type="text" class="form-control" maxlength="60" id="institutename" name="institutename" value="{{ old('institutename') }}" placeholder="What is your Institution Name?" autofocus>
                  <label for="institutename" class="label_institute"> Institution Name <span style="color: red"> * </span> </label>
                  <span id="institutename_error">  </span>
                </div>

                <div class="mb-3 mt-3 form-floating">
                  <input type="email" maxlength="200" id="adminemailregister" name="adminemailregister" value="{{ old('adminemailregister') }}" class="form-control" placeholder="Enter your email">
                  <label for="adminemailregister"> Email  <span style="color: red"> * </span> </label>
                    <span id="admin_email_reg_error_check">  </span>
                </div>

                <div class="mb-3 mt-3">
                  <div class="input-group has-validation">
                    <span class="input-group-text">@</span>
                    <input type="text" class="form-control" minlength="3" maxlength="30" id="adminusernameregister" name="adminusernameregister" placeholder="Username">
                  </div>
                  <div class="mt-2">
                    <span id="admin_username_reg_check_error">  </span>
                  </div>
                </div>
                <button type="button" id="nextbtnstep1" class="btn btn-primary next">Next</button>
              </div>
              <div class="step" id="step2" style="display:none">
                <h2> Step 2: Password </h2>
                <div class="mb-3 mt-3 form-floating">
                  <input type="password" maxlength="72" class="form-control" id="password" name="password" placeholder="Enter your password">
                  <label for="password"> Password  <span style="color: red"> * </span> </label>
                  <a id="anchortag" class="text-decoration-none btn btn-link" onclick="togglePasswordregisteradmin()"> Show/Hide </a>
                </div>
                <div class="mb-3 mt-3 form-floating">
                  <input type="password" maxlength="72" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Enter your password again">
                  <label for="confirmpassword"> Confirm Password  <span style="color: red"> * </span> </label>
                  <a id="confirmanchortag" class="text-decoration-none btn btn-link" onclick="togglePasswordCheckregisteradmin()"> Show/Hide </a>
                  <div class="mt-2">
                  <span id="password_error">  </span>
                  </div>
                </div>
                <div class="d-flex justify-content-between custom_prev_next">
                  <button type="button" class="btn btn-secondary prev mb-2"> <i class="fa-solid fa-circle-chevron-left"></i> Previous</button>
                  <button type="button" id="nextbtnstep2" class="btn btn-primary next"> Next <i class="fa-solid fa-circle-chevron-right"> </i> </button>
                </div>
              </div>
              <div class="step" id="step3" style="display:none">
                <h2> Step 3: Country </h2>
                <div class="mb-3 mt-3 form-floating">
                  @include('includes.country')
                  <label for="country"> Country <span style="color: red"> * </span> </label>
                </div>
                <div class="mt-3 mb-3">
                  <span id="country_error_error" class="text-danger">  </span>
                  </div>
      <div class="container" id="nepaldetailinfoshow" style="display:none">
        <div class="border-top border-bottom border-danger text-center">
            <h4 class="mb-0"> Permanent Address </h4>
            <small> <em> (optional for country other than Nepal) </em> </small>
        </div>
        <div class="mt-3 mb-3 text-center">
        <span id="country_error" class="text-danger">  </span>
        </div>
        {{-- <div class="mb-3 mt-3 form-floating">
        @include('includes.province')
          <label for="province"> Province </label>
        </div>
      --}}
        <div class="mt-3 d-flex flex-column justify-content-between gap-3">
        <div class="d-flex justify-content-center mb-2 d-none" id="loading_icon">
          <i class="fa-solid fa-spinner fa-spin me-3"></i> Loading...
        </div>
          <div class="row">
            <div class="col mb-2">
              <div class="form-floating">
                @include('includes.province')
                <label for="province"> Province </label>
                <span id="province_error" class="text-danger">  </span>
              </div>
            </div>

            <div class="col">
              <div class="form-floating">
                <select id="district"  class="form-select" name="district">
                <option style="display:none" disabled selected value> Select District </option>
                </select>
                <label for="district"> District </label>
                <span id="district_error" class="text-danger">  </span>
              </div>

            </div>
          </div>

          <div class="form-floating">
              <select id="village"  class="form-select"  name="village">
              <option style="display:none" disabled selected value> Select Village </option>
              </select>
              <label for="village"> Village </label>
              <span id="village_error" class="text-danger">  </span>
          </div>
        </div>

        <div class="mb-3 mt-3 form-floating">
            <select id="wardno" class="form-select"  name="wardno">
              <option style="display:none" disabled selected value> Ward Number </option>
            </select>
            <label for="wardno"> Ward No </label>
            <span id="ward_error" class="text-danger">  </span>
        </div>

        <div class="mb-3 mt-3 form-floating">
            <input type="text"  maxlength="60" placeholder="Enter Street Address" class="form-control" name="streetaddress" id="streetaddress">
            <label for="streetaddress"> Street Address </label>
            <span class="text-danger" id="street_address_error">  </span>
        </div>

    </div>
                <div class="d-flex justify-content-between custom_prev_next">
                  <button type="button" class="btn btn-secondary prev mb-2"> <i class="fa-solid fa-circle-chevron-left"></i> Previous</button>
                  <button type="button" id="nextbtnstep3" class="btn btn-primary next"> Next <i class="fa-solid fa-circle-chevron-right"> </i> </button>
                </div>
              </div>
              <div class="step" id="step4" style="display:none">
                <h2>Step 4: Other Information </h2>

                <div class="mt-4">
                  <p class="text-success" id="verificationmessage"> Verification Code is a sent to your email.</p>
                </div>

                {{-- <div class="mb-3 mt-3 form-floating">
                  <input type="number" class="form-control" id="college_id" name="college_id" min="1" max="99999999" value="{{ old('college_id') }}" placeholder="Enter College ID" disabled>
                  <label for="college_id"> College ID  <span style="color: red"> * </span> </label>
                  <div class="mt-2">
                    <span id="collegeid_error">  </span>
                  </div>
                </div> --}}
                <div class="mb-3 mt-3 form-floating">
                  <input type="text" class="form-control" id="verification_code" name="verification_code" value="{{ old('verificationcode') }}" placeholder="Enter Verification Code">
                  <label for="verification_code"> Verification Code <span style="color: red"> * </span> </label>


                  <div class="mt-2">
                    <span id="verification_error">  </span>
                  </div>
                </div>

                <div class="d-flex justify-content-center">
                  {{-- <button type="button" class="btn btn-secondary prev"> <i class="fa-solid fa-circle-chevron-left"></i> Previous </button> --}}
                  <button type="submit" id="reg_submit_register" class="btn btn-primary"> Register </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

<script>
    let checkEmailRoute = "{{ route('check_email_available') }}";
    let checkusernameRoute = "{{ route('check_username_available') }}";
    let checkusernameandEmailRoute = "{{ route('check_username_email_available') }}";
    let checkVerificationCode = "{{ route('check_verificationcode_available') }}";
    let send_verfication_code = "{{ route('send_verfication_code') }}";
    let get_district_url = "{{ route('get_districts') }}";
    let get_villages_url = "{{ route('get_villages') }}";
    let get_wards_url = "{{ route('get_wards') }}";
</script>


  <script src="{{ asset('js/custom/mutli_step_pagination_form.js') }}"></script>
  <script src="{{ asset('js/custom/password_toggle.js') }}"></script>
  {{-- <script src="{{ asset('js/custom/admin_registration_email_username_check.js') }}"></script> --}}
  <script src="{{ asset('js/custom/main_new_province_system.js') }}"> </script>
  <script src="{{ asset('js/custom/nexpageinadminmultipageform.js') }}"> </script>
@endsection


