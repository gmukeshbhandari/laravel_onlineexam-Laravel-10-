@extends('layouts.master')
@section('User Registration - Online Examination System')
@section('content')
{{-- <div class="container-fluid text-center bg-primary">
    <div class="row justify-content-center">
        <div class="col-8 bg-danger">
            abcde
        </div>
    </div>
</div> --}}


<div class="d-flex justify-content-center align-items-center custom-user-register">
    <div style="width:66.67vw">
        <div class="card border border-2 border-success">
            <div class="card-header">
                User Registration
            </div>
            <div class="card-body d-flex flex-column">
                <form action="{{ route('registering_user_check') }}" id="user_form" method="post" enctype="multipart/form-data">
                    @csrf
                {{-- <h5 class="card-title"> Card Body Title </h5> --}}
                <p class="card-text border-top border-bottom border-danger py-2 fw-light"> Fields marked with * are mandatory. </p>
                <div class="d-flex flex-column align-items-center gap-3 mb-3">
                    <label class="form-label" for="user_image"> Upload Your Photo </label>
                    <div>
                        <img id="selectedImage" class="img-fluid" src="{{ asset('images/imageupload.jpg') }}" alt="" style="width: 200px;height:200px;border-radius: 50%;">
                    </div>
                    <div class="btn btn-primary btn-rounded">
                            <label class="form-label text-white m-1" for="user_image">Choose Photo</label>
                            <input type="file"  accept=".jpg, .jpeg, .bmp, .png" class="form-control d-none" name="user_image" id="user_image" onchange="displaySelectedImage(event, 'selectedImage')" />
                    </div>
                </div>
                
                
                <div class="d-flex gap-3 mb-3 flex-column flex-md-row">
                    <div class="w-100 flex-grow-1">
                        <label for="first_name" class="form-label"> First Name <span style="color: red"> * </span> </label>
                        <input type="text" maxlength="50" class="form-control" name="first_name" id="first_name" value="{{ old('first_name')}}" autofocus>
                        <span class="text-danger" id="first_name_error">   </span>
                    </div>
                    <div class="w-100 flex-grow-1">
                        <label for="middle_name" class="form-label"> Middle Name </label>
                        <input type="text" maxlength="50" class="form-control" name="middle_name" id="middle_name" value="{{ old('middle_name')}}">
                        <span class="text-danger" id="middle_name_error">  </span>
                    </div>
                    <div class="w-100 flex-grow-1">
                        <label for="last_name" class="form-label"> Last Name <span style="color: red"> * </span> </label>
                        <input type="text" maxlength="50" class="form-control" name="last_name" id="last_name" value="{{ old('last_name')}}">
                        <span class="text-danger" id="last_name_error"> </span>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-3 flex-column flex-md-row">
                    <div class="w-100 flex-grow-1">
                        <label for="email" class="form-label"> Email <span style="color: red"> * </span> </label>
                        <input type="email" maxlength="200" id="email" name="email" value="{{ old('email') }}" class="form-control">
                        <span class="text-danger" id="email_error">  </span>
                    </div>
                    <div class="w-100 flex-grow-1">
                        <label for="username" class="form-label"> Your Username <span style="color: red"> * </span> </label> 
                        <div class="input-group"> 
                            <span class="input-group-text"> @ </span>
                            <input type="text" class="form-control" minlength="3" maxlength="30" name="username" id="username" placeholder="Username">
                        </div>
                        <div class="mt-2">
                            <span class="text-danger" id="username_error">  </span>
                        </div>
                    </div>
                    <div class="w-100 flex-grow-1">
                        <label for="institute_username" class="form-label"> College Username <span style="color: red"> * </span> </label> 
                        <div class="input-group"> 
                            <span class="input-group-text"> @ </span>
                            <input type="text" class="form-control" minlength="3" maxlength="30" name="institute_username" id="institute_username" placeholder="Institute Username">
                        </div>
                        <div class="mt-2">
                            <span class="text-danger" id="institute_username_error">  </span>
                        </div>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-3 flex-column flex-sm-row">
                    <div>
                        <label for="gender" class="form-label"> Gender <span style="color: red"> * </span>  </label>
                        <select class="form-select" name="gender" id="gender" value="{{ old('gender') }}">
                            <option style="display:none" disabled selected value> Select your gender</option>
                            <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}> Male </option>
                            <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}> Female </option>
                            <option value="Non-Binary" {{ old('gender') == 'Non-Binary' ? 'selected' : '' }}> Non-Binary </option>
                            <option value="Prefer not to say" {{ old('gender') == 'Prefer not to say' ? 'selected' : '' }}> Prefer not to say </option>
                          </select>
                          <span class="text-danger" id="gender_error">  </span>
                    </div>
                </div>
                <div class="d-flex gap-3 mb-3 flex-column flex-sm-row">
                    <div class="w-100 flex-grow-1">
                        <label for="password" class="form-label"> Password <span style="color: red"> * </span>  </label>
                        <input type="password" maxlength="72" class="form-control" id="password" name="password">
                        <a id="anchortag" class="text-decoration-none btn btn-link" onclick="togglePasswordregisteradmin()"> Show/Hide </a>
                        <span class="text-danger" id="password_error">  </span>
                    </div>
                    <div class="w-100 flex-grow-1">
                        <label for="confirmpassword" class="form-label"> Confirm Password <span style="color: red"> * </span>  </label>
                        <input type="password" maxlength="72" class="form-control" id="confirmpassword" name="confirmpassword">
                        <a id="confirmanchortag" class="text-decoration-none btn btn-link" onclick="togglePasswordCheckregisteradmin()"> Show/Hide </a>
                        <span class="text-danger" id="confirm_password_error">  </span>
                    </div>
                </div>
                <div class="d-flex flex-column gap-3 mb-3">
                    <div class="mb-3">
                        <label for="country" class="form-label"> Country <span style="color: red"> * </span> </label>
                        @include('includes.country')
                        <span class="text-danger" id="country_error"> </span>
                    </div>
                    <div class="d-flex flex-column mb-3 p-2 d-none" id="nepal_detail_info_show" style="background-color: #f7fafc;">
                        <div class="text-center border-top border-2 border-success py-3">
                            <h4> Permanent Address </h4>
                            <small> <em> (optional for country other than Nepal) </em> </small>
                        </div>
                        <div class="d-flex flex-column mb-3 gap-3 flex-md-row">
                            <div class="w-100 flex-grow-1">
                                <label for="province" class="form-label"> Province </label>
                                <select class="form-select" name="province" id="province">
                                        <option style="display:none" disabled selected value> Select Province </option>
                                        <option value="Koshi"> Koshi </option>
                                        <option value="Madhesh"> Madhesh </option>
                                        <option value="Bagmati"> Bagmati </option>
                                        <option value="Gandaki"> Gandaki </option>
                                        <option value="Lumbini"> Lumbini </option>
                                        <option value="Karnali"> Karnali </option>
                                        <option value="Sudhurpaschim"> Sudhurpaschim </option>
                                </select>
                                <span class="text-danger" id="province_error">  </span>
                            </div>
                            <div class="w-100 flex-grow-1">
                                <label for="district" class="form-label"> District </label>
                                <select class="form-select" name="district" id="district">
                                    <option style="display:none" disabled selected value> Select District </option>
                                </select>
                                <span class="text-danger" id="district_error">  </span>
                            </div>
                        </div>
                        <div class="d-flex flex-column flex-md-row gap-3 mb-3">
                            <div class="w-100 flex-grow-1">
                                <label for="village" class="form-label"> Village </label>
                                {{-- <select class="form-select" name="village" id="village"  >
                                    <option style="display:none" disabled selected value> Select Village </option>
                                </select> --}}
                                <select class="form-select" name="village" id="village"  >
                                    <option style="display:none" disabled selected value> Select Village </option>
                                </select>
                                <span class="text-danger" id="village_error">  </span>
                            </div>
                            <div class="w-100 flex-grow-1">
                                <label for="ward_no" class="form-label"> Ward Number </label>
                                <select class="form-select" name="ward_no" id="ward_no"  >
                                    <option style="display:none" disabled selected value> Select Ward </option>
                                </select>
                                <span class="text-danger" id="ward_error">  </span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="street_address"> Street Address </label>
                            <input type="text"  maxlength="60" class="form-control" name="street_address" id="street_address"  value="{{ old('street_address')}}">   
                            <span class="text-danger" id="street_address_error">  </span>
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary w-100"> Register </button>
                </div>
            </form>
            </div>
            {{-- <div class="card-footer">
                Card Footer
            </div> --}}
        </div>
    </div>
</div>
<script>
    let get_district_url = "{{ route('get_districts') }}";
    let get_villages_url = "{{ route('get_villages') }}";
    let get_wards_url = "{{ route('get_wards') }}";
    let user_registration_check = "{{ route('registering_user_check') }}";
    let user_home_page_route = "{{ route('user_homepage') }}";
</script>
<script src="{{ asset('js/custom/password_toggle.js') }}"></script>
<script src="{{ asset('js/custom/user_country_change.js') }}"></script>
<script src="{{ asset('js/custom/user_registration_check.js') }}"></script>
@endsection


