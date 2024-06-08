<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculties';

    protected $fillable = ['Faculty_Name','Institute_Username','Faculty_Name_Code','Old_Faculty_Names','Date_Added','Faculty_Name_Last_Updated_Date','Status'];

    protected $hidden = ['remember_token'];

    public function subjects(): HasMany
    {
        return $this->hasMany(Subject::class);
    }
}
