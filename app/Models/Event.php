<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Event extends Model
{
    protected $table = 'events';
    protected $fillable = [
        'title',
        'country_id',
        'city_id',
        'address',
        'start_date',
        'end_date',
        'start_time',
        'num_tickets',
        'description',
        'image',
        'user_id',
        'slug'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }
    public function attendings(): HasMany
    {
        return $this->hasMany(Attending::class);
    }
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
    public function hasTag($tag)
    {
        return $this->tags->contains($tag);
    }
    public function savedEvents(): HasMany
    {
        return $this->hasMany(SavedEvent::class);
    }
}
