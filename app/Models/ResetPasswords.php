<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetPasswords extends Model
{
    use HasFactory;

    protected $table = 'reset_passwords';

    protected $fillable = ['name','email','token','Date_Sent','Status'];
    protected $hidden = ['remember_token'];
}
