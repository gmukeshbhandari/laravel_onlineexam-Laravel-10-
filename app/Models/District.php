<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class District extends Model
{
    use HasFactory;

    protected $table = 'districts';
	
	protected $fillable = [
        'District',
        'province_id',
    ];

    protected $hidden = [
        'remember_token',
    ];
	
	public function villages(): HasMany
	{
		return $this->hasMany(Village::class);
	}
	
	public function provinces(): BelongsTo
    {
        return $this->belongsTo(Province::class);
		//return $this->belongsTo(Province::class, 'custom_foreign_key');
		//This implies that a District belongs to a single Province.
    }
}
