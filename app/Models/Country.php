<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    protected $table = 'countries';
    protected $fillable = ['name'];
    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
    public function events(): HasMany{
        return $this->hasMany(Event::class);
    }
}
