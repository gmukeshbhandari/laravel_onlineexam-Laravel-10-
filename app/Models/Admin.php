<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;


class Admin extends Model implements Authenticatable
{
    use AuthenticatableTrait;
    use HasFactory;

    protected $table = 'admins';
    
    protected $fillable = [
        'Rank',
        'Institute_Name',
        'institute_username',
        'email',
        'password',
        'Country',
        'Province_Name_Nepal',
        'District_Nepal',
        'Village_Nepal',
        'Ward_No_Nepal',
        'Street_Address_Nepal',
        'Last_Institute_Name_Update',
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
    
// protected static function boot()
// {
//     parent::boot();

//     static::creating(function ($admin) {
//         $admin->adminloginpassword = bcrypt($admin->adminloginpassword);
//     });
// }

}
