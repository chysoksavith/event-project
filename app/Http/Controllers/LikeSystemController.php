<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeSystemController extends Controller
{
    public function __invoke($id)
    {
        $event = Event::findOrFail($id);
        $like = $event->likes()->where('user_id', Auth::id())->first();

        if (!is_null($like)) {
            $like->delete();
            return null;
        } else {
            $like = $event->likes()->create([
                'user_id' => Auth::id(),
            ]);
            return $like;
        }
    }
}
