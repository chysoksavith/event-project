<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SaveSystemController extends Controller
{
    public function __invoke($id)
    {
        $event = Event::findOrFail($id);
        $saveEvent = $event->savedEvents()->where('user_id', Auth::id())->first();
        if (!is_null($saveEvent)) {
            $saveEvent->delete();
            return null;
        } else {
            $saveEvent = $event->savedEvents()->create([
                'user_id' => Auth::id(),

            ]);
            return $saveEvent;
        }
    }
}
