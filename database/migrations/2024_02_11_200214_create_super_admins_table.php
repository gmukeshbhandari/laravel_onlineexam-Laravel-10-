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
        Schema::create('super_admins', function (Blueprint $table) {
            $table->id();
            $table->string('First_Name',50);
            $table->string('Middle_Name',50)->nullable();
            $table->string('Last_Name',50);
            $table->string('email',200);
            $table->string('password',72);
            $table->string('superadmin_username',30);
            $table->ipAddress('IP_Address')->nullable();
            $table->macAddress('MAC_Address')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('super_admins');
    }
};
