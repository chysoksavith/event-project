<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Like extends Model
{
    protected $table = 'likes';
    protected $fillable = [
        'user_id',
        'event_id',
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function event(): BelongsTo
    {
        return $this->belongsTo(Event::class);
    }
}
