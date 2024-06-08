<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Village extends Model
{
    use HasFactory;

    protected $table = 'villages';
	
	protected $fillable = [
        'Village',
        'district_id',
    ];

    protected $hidden = [
        'remember_token',
    ];
	
	public function wards(): HasMany
	{
		return $this->hasMany(Ward::class);
	}
	
	public function districts(): BelongsTo
    {
        return $this->belongsTo(District::class);
		//return $this->belongsTo(District::class, 'custom_foreign_key');
		//This implies that a Village belongs to a single District Model
    }
}
