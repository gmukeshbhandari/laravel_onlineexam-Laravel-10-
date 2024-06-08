<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeletedAccount extends Model
{
    use HasFactory;

    protected $table = 'deleted_accounts';

    protected $fillable = [
        'email',
        'username',
        'Deleted_Date_Time',
        'IP_Address',
        'MAC_Address',
        'User_Agent',
        'Account_Type',
        'Browser',
        'Platform',
        'Device',
    ];

    protected $hidden = ['remember_token'];

}
