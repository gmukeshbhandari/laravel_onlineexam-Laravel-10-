<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';

    protected $fillable = [
        'email',
        'Topic',
        'Description',
        'image_file_location',
        'User_Agent',
        'User_Type',
        'IP_Address',
        'MAC_Address',
        'Feedback_DateandTime',
    ];

    protected $hidden = [
        'remember_token',
    ];

}
