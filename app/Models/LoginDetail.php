<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginDetail extends Model
{
    use HasFactory;

    protected $table = 'login_details';

    protected $fillable = [
        'username',
        'IP_Address',
        'MAC_Address',
        'User_Agent',
        'Login_DateandTime',
        'Login_Type',
        'User_Type',
        'Browser',
        'Platform',
        'Device',
    ];

    protected $hidden = ['remember_token'];
}
