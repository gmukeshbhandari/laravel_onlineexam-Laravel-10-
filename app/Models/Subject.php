<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subject extends Model
{
    use HasFactory;

    protected $table = 'subjects';

    protected $fillable = ['Subject_Name','Faculty_ID','Subject_Name_Code','Exam_Duration','Full_Marks','Pass_Marks','Date_of_Exam','Date_Added','Status'];

    protected $hidden = ['remember_token'];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function faculties(): BelongsTo
    {
        return $this->belongsTo(Faculty::class,'Faculty_ID', 'id');
    }
}
