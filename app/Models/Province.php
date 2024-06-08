<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Province extends Model
{
    use HasFactory;
	
    protected $table = 'provinces';

	protected $fillable = [
        'Province',
        'country_id',
    ];

    protected $hidden = [
        'remember_token',
    ];
	
	public function districts(): HasMany
    {
        return $this->hasMany(District::class);
    }
	
	public function countries(): BelongsTo
    {
        return $this->belongsTo(Country::class);
		//return $this->belongsTo(Country::class, 'custom_foreign_key');
		//This implies that a Province belongs to a single Country.
    }
}




