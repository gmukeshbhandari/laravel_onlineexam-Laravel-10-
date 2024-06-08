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
        Schema::create('subjects', function (Blueprint $table) {
            $table->id();
            $table->string('Subject_Name',100);
            $table->unsignedBigInteger('Faculty_ID');
            $table->foreign('Faculty_ID')->references('id')->on('faculties')->onDelete('cascade');
            $table->unique(['Subject_Name', 'Faculty_ID']);
            $table->string('Subject_Name_Code',10)->unique();
            $table->text('Old_Subject_Names')->nullable();
            $table->unsignedSmallInteger('Exam_Duration')->nullable();
            $table->decimal('Full_Marks', $precision = 7, $scale = 3)->nullable();
            $table->decimal('Pass_Marks', $precision = 7, $scale = 3)->nullable();
            $table->date('Date_of_Exam')->nullable();
            $table->dateTime('Date_Added');
            $table->dateTime('Subject_Name_Last_Updated_Date')->nullable();
            $table->enum('Status',['0','1'])->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subjects');
    }
};
