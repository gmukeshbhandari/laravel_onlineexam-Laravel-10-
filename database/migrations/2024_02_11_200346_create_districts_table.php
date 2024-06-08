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
        Schema::create('districts', function (Blueprint $table) {
            $table->id();
			// $table->string('District');
            $table->enum('District', ['Bhojpur','Dhankuta','Ilam','Jhapa','Khotang','Morang','Okhaldhunga','Panchthar','Sankhuwasabha','Solukhumbu','Sunsari','Taplejung','Terhathum','Udayapur','Bara','Dhanusa','Mahottari','Parsa','Rautahat','Saptari','Sarlahi','Siraha','Bhaktapur','Chitwan','Dhading','Dolakha','Kathmandu','Kavrepalanchok','Lalitpur','Makwanpur','Nuwakot','Ramechhap','Rasuwa','Sindhuli','Sindhupalchok','Baglung','Gorkha','Kaski','Lamjung','Manang','Mustang','Myagdi','Nawalparasi - East of Bardaghat Susta','Parbat','Syangja','Tanahun','Arghakhanchi','Banke','Bardiya','Dang','Gulmi','Kapilvastu','Nawalparasi - West of Bardaghat Susta','Palpa','Pyuthan','Rolpa','Rukum - East Part','Rupandehi','Dailekh','Dolpa','Humla','Jajarkot','Jumla','Kalikot','Mugu','Rukum - West Part','Salyan','Surkhet','Achham','Baitadi','Bajhang','Bajura','Dadeldhura','Darchula','Doti','Kailali','Kanchanpur']);
			$table->foreignId('province_id')->constrained();
            $table->timestamps();
        });
    }
 

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
};
