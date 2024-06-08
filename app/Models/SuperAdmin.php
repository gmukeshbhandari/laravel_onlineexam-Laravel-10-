<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuperAdmin extends Model
{
    use HasFactory;

    protected $table = 'super_admins';

    protected $fillable = ['email','First_Name','Middle_Name','Last_Name','superadmin_username','password','IP_Address','MAC_Address','created_at','updated_at'];
    //protected $guarded = ['', ''];

    protected $hidden = ['password','remember_token'];
}
