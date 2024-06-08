<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('login_details', function (Blueprint $table) {
            $table->id();
            $table->string('username',30);
            // $table->foreign('username')->references('institute_username')->on('admins')->onDelete('cascade');
            $table->ipAddress('IP_Address');
            $table->macAddress('MAC_Address')->nullable();
            $table->string('User_Agent');
            $table->string('Browser');
            $table->string('Platform');
            $table->string('Device');
            $table->dateTime('Login_DateandTime');
            $table->enum('Login_Type',['Account Creation','Log In with Password','Log Out','Log Out - Change Password','Log Out - Reset Password','Reset Password Without Log Out','Log Out - Account Deleted','Log Out - Disable by Admin','Disable by Admin Without Log Out','Log Out-Disable by SuperAdmin','Disable by SuperAdmin Without Log Out','Opened when already logged']);
            $table->enum('User_Type',['user','admin','superadmin']);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_details');
    }
};
