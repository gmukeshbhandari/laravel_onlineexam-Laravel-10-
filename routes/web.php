<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CountryInfoController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\QuestionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Route::get('/sendmail',[AdminController::class,'sendmail'])->name('sendmail');
Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('/get-districts', function () {
    return view('pagenotfound');
});

Route::get('/admin/manage-question', function () {
    return view('pagenotfound');
});

Route::get('/get-villages', function () {
    return view('pagenotfound');
});

Route::get('/get-wards', function () {
    return view('pagenotfound');
});



Route::post('/get-districts',[CountryInfoController::class,'getDistricts'])->name('get_districts');

Route::post('/get-villages',[CountryInfoController::class,'getVillages'])->name('get_villages');

Route::post('/get-wards',[CountryInfoController::class,'getWards'])->name('get_wards');

// Route::view('/','welcome');
//User
Route::get('/userhome',[UsersController::class,'index'])->name('user_homepage');
Route::post('/userhome',[UsersController::class,'checkLogin'])->name('user_checklogin');
Route::get('/feedback',[AdminController::class,'feedback'])->name('feedback');
Route::post('/feedback/checkdata',[AdminController::class,'checkFeedback'])->name('checkingFeedback');
Route::get('/userregister',[UsersController::class,'register'])->name('registering_user');
Route::post('/userregister/check',[UsersController::class,'registerCheck'])->name('registering_user_check');
// Route::get('/country',[CountryInfoController::class,'country'])->name('country');
Route::group(['middleware'=>'customuser'],function(){
    Route::get('/user/dashboard',[UsersController::class,'userDashboard'])->name('user_dashboard');
    Route::get('/user/accountdetails',[UsersController::class,'accountDetails'])->name('account_details_user');
    Route::get('/user/changepassword',[UsersController::class,'changePassword'])->name('change_user_password');
    Route::get('/user/deleteaccount',[UsersController::class,'deleteAccount'])->name('delete_user_account');
    Route::post('/user/deleteaccountcheck',[UsersController::class,'deleteAccountCheck'])->name('delete_user_account_check');
    Route::get('/user/logout',[UsersController::class,'logout'])->name('log_out_user');
});




//Admin
//Route::match(['get', 'post'], '/adminhome', [AdminController::class,'index'])->name('admin_homepage');
Route::get('/adminhome',[AdminController::class,'index'])->name('admin_homepage');
//afte submission of form post method will apply
Route::post('/adminhome',[AdminController::class,'checkLogin'])->name('admin_checklogin');
Route::get('/adminregister',[AdminController::class,'register'])->name('registering_admin');
Route::post('/adminregister/sendverificationcode',[AdminController::class,'sendVerificationCodeToEmail'])->name('send_verfication_code');
Route::get('/forgot-password',[AdminController::class,'forgotPassword'])->name('forgotpassword');
Route::post('/forgot-password-check',[AdminController::class,'checkForgotPassword'])->name('forgotpassword_check');
Route::get('/forgotpassword', function () {
    return view('resetemailsent');
})->name('reset_email_sent');
Route::get('/resetpassword/{token}',[AdminController::class,'resetPassword'])->name('reset_password');
Route::post('/resetpassword/check',[AdminController::class,'resetPasswordCheck'])->name('reset_password_check');
Route::post('/admin-registration-check',[AdminController::class,'checkregistration'])->name('admin_register_check');
Route::post('/register/email-available-check',[AdminController::class,'checkEmailAvailability'])->name('check_email_available');

Route::post('/register/username_email_available_check',[AdminController::class,'checkUsernameEmailAvailablity'])->name('check_username_email_available');

Route::post('/register/username-available-check',[AdminController::class,'checkusernameAvailablity'])->name('check_username_available');
Route::post('/register/check-verification-code',[AdminController::class,'checkVerificationCode'])->name('check_verificationcode_available');
Route::group(['middleware'=>'admin'],function(){
    Route::get('/admin/dashboard',[AdminController::class,'adminDashboard'])->name('admin_dashboard');
    Route::get('/admin/studentlist',[AdminController::class,'studentList'])->name('student_list');
    Route::get('/admin/manage-faculties',[FacultyController::class,'manageFaculties'])->name('admin_manage_faculties');
    Route::post('/admin/manage-faculties/add',[FacultyController::class,'addFaculties'])->name('admin_add_faculties');
    Route::get('/admin/manage-faculties/manage/single/{id}',[FacultyController::class,'manageFacultyIndividual'])->name('manage_faculty_individual');
    Route::post('/admin/manage-faculties/manage/single/edit/{id}',[FacultyController::class,'manageFacultyIndividualEdit'])->name('manage_faculty_individual_edit');
    Route::post('/admin/manage-faculties/manage/mass',[FacultyController::class,'massManageFaculties'])->name('mass_manage');
    Route::get('/admin/manage-subjects',[SubjectController::class,'manageSubjects'])->name('admin_manage_subjects');
    Route::post('/admin/manage-subjects/add',[SubjectController::class,'addSubjects'])->name('admin_add_subjects');
    Route::post('/admin/manage-subjects/manage/single/edit/{id}',[SubjectController::class,'manageSubjectIndividualEdit'])->name('manage_subject_individual_edit');
    Route::get('/admin/manage-subjects/manage/single/{id}',[SubjectController::class,'manageSubjectIndividual'])->name('manage_subject_individual');
    Route::post('/admin/manage-subjects/manage/mass',[SubjectController::class,'massManageSubjects'])->name('mass_manage_subjects');
    Route::get('/admin/manage-questions',[QuestionController::class,'manageQuestions'])->name('admin_manage_questions');
    Route::post('/admin/manage-question',[QuestionController::class,'manageQuestionsSelected'])->name('admin_manage_questions_selected');
    Route::post('/admin/manage-questions/get-subject',[QuestionController::class,'getSubject'])->name('get_subject');
    Route::post('/admin/manage-questions/add',[QuestionController::class,'addQuestions'])->name('admin_add_questions');
    Route::get('/admin/accountdetails',[AdminController::class,'accountDetails'])->name('account_details_admin');
    Route::get('/admin/changepassword',[AdminController::class,'changePassword'])->name('change_admin_password');
    Route::post('/admin/changepassword/check',[AdminController::class,'changePasswordCheck'])->name('change_admin_password_check');
    Route::get('/admin/deleteaccount',[AdminController::class,'deleteAccount'])->name('delete_admin_account');
    Route::post('/admin/deleteaccountcheck',[AdminController::class,'deleteAccountCheck'])->name('delete_admin_account_check');
    Route::get('/admin/studentlist/changeaccountstatus/{id}',[AdminController::class,'changeAccountStatus'])->name('change_student_account_status');
    Route::post('/admin/studentlist/changeaccountstatus/mass',[AdminController::class,'changeMassAccountStatus'])->name('mass_inactivate_activate_student');
 Route::post('/admin/deleteaccountcheck',[AdminController::class,'deleteAccountCheck'])->name('delete_admin_account_check');    Route::get('/admin/logout',[AdminController::class,'logout'])->name('log_out_admin');
});







