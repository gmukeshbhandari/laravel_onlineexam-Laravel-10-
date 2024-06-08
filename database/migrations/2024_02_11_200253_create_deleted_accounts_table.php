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
        Schema::create('deleted_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('email',200);
            $table->string('username',30)->unique();
            $table->dateTime('Deleted_Date_Time');
            $table->ipAddress('IP_Address');
            $table->macAddress('MAC_Address')->nullable();
            $table->string('User_Agent',253);
            $table->enum('Account_Type',['user','admin']);
            $table->string('Browser');
            $table->string('Platform');
            $table->string('Device');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deleted_accounts');
    }
};
