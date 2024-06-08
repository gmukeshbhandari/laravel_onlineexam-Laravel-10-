<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Ward extends Model
{
    use HasFactory;

    protected $table = 'wards';
	
	protected $fillable = [
        'Ward',
        'village_id',
    ];

    protected $hidden = [
        'remember_token',
    ];
	
	// public function electioncenters(): HasMany
	// {
		// return $this->hasMany(ElectionCenter::class);
	// }
	
	public function villages(): BelongsToMany
    {
        return $this->BelongsToMany(Village::class);
		//This implies that Ward can belong to multiple Village models, and a Village can have multiple Ward models
    }
}
