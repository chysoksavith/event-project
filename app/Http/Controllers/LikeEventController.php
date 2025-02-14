<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeEventController extends Controller
{
    public function __invoke()
    {
        $events = Event::with('likes')->whereHas('likes', function ($q) {
            $q->where('user_id', Auth::id());
        })->get();
        return view('likedEvent', compact('events'));
    }
}
