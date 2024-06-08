<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class Users extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;

    protected $table = 'users';


    protected $fillable = [
        'Rank',
        'First_Name',
        'Middle_Name',
        'Last_Name',
        'image_file_path',
        'email',
        'password',
        'user_username',
        'institute_username',
        'Gender',
        'Country',
        'Province_Name_Nepal',
        'District_Nepal',
        'Village_Nepal',
        'Ward_No_Nepal',
        'Street_Address_Nepal',
        'Last_First_Name_Update',
        'Last_Middle_Name_Update',
        'Last_Last_Name_Update',
        'Last_Password_Update', 
        'Login_Device_Info',
    ];

    protected $hidden = [
        'password',
        'Previous_Password',
        'remember_token',
    ];

    // public function verifyUser()
    // {
    //     return $this->hasOne('App\VerifyUser');
    // }

    // public function answers(){
    //     return $this->hasMany('App\Answer');
    // }
}
