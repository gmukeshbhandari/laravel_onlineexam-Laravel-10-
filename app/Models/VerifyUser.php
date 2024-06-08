<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyUser extends Model
{
    use HasFactory;

    protected $table = 'verify_users';

    protected $fillable = ['name','email','token','Date_Sent','Status'];
    protected $hidden = ['remember_token'];

    // public function users()
    // {
    //     return $this->belongsTo('App\Users','id');
    // }

    // public function admin()
    // {
    //     return $this->belongsTo('App\Admin','id');
    // }
}
