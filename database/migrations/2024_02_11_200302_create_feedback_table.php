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
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->string('email',200);
            $table->string('Topic',100);
            $table->text('Description');
            $table->string('image_file_location')->nullable();
            $table->string('User_Agent',253);
            $table->enum('User_Type',['user','admin','superadmin']);
            $table->ipAddress('IP_Address');
            $table->macAddress('MAC_Address')->nullable();
            $table->dateTime('Feedback_DateandTime');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback');
    }
};
