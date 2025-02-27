<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    protected $table = 'cities';
    protected $fillable = [
        'country_id',
        'name'
    ];
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }
}
