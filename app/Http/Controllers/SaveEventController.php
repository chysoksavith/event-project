<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveEventController extends Controller
{
    public function __invoke()
    {
        $events = Event::with('savedEvents')->whereHas('savedEvents', function ($q) {
            $q->where('user_id', Auth::id());
        })->get();
        return view('savedEvent', compact('events'));
    }
}
