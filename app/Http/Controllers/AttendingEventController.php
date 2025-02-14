<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendingEventController extends Controller
{
    public function __invoke()
    {
        $events = Event::with('attendings')->whereHas('attendings', function ($q) {
            $q->where('user_id', Auth::id());
        })->get();
        return view('attending', compact('events'));
    }
}
