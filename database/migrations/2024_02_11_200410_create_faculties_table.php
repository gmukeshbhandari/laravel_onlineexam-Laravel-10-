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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
            $table->string('Faculty_Name',100);
            $table->string('Institute_Username',30);
            $table->foreign('Institute_Username')->references('institute_username')->on('admins')->onDelete('cascade');
            //combination of Faculty_Name and Institute_Username is unique. i.e Faculty Name cannot be same for same institute.
            $table->unique(['Faculty_Name', 'Institute_Username']); 
            $table->string('Faculty_Name_Code',10)->unique();
            $table->text('Old_Faculty_Names')->nullable();
            $table->dateTime('Date_Added');
            $table->dateTime('Faculty_Name_Last_Updated_Date')->nullable();
            $table->enum('Status',['0','1'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faculties');
    }
};
