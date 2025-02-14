<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventShowController extends Controller
{
    public function __invoke($id)
    {
        $event =  Event::findOrFail($id);
        $like = $event->likes()->where('user_id', Auth::id())->first();
        $savedEvent = $event->savedEvents()->where('user_id', Auth::id())->first();
        $attending = $event->attendings()->where('user_id', Auth::id())->first();

        return view('eventShow', compact('event', 'savedEvent', 'attending', 'like'));
    }
}
