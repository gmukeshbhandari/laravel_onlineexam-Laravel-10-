<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;
	
	protected $table = 'countries';

	protected $fillable = [
		'Country',
	];

	protected $hidden = [
		'remember_token',
	];
	
	public function provinces()
	{
		return $this->hasMany(Province::class);
	}
}
