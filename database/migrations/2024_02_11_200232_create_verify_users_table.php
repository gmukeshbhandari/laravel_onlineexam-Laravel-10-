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
        Schema::create('verify_users', function (Blueprint $table) {
            $table->id();
            $table->string('name',150)->nullable();
            $table->string('email',200);
            $table->string('token');
            $table->dateTime('Date_Sent');
            $table->enum('Status',['0','1'])->default('1');    
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verify_users');
    }
};
