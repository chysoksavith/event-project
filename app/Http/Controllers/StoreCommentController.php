<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreCommentController extends Controller
{
    public function __invoke(Request $request, string $id)
    {
        $event = Event::findOrFail($id);
        $event->comments()->create([
            'content' => $request->content,
            'user_id' => Auth::id(),
        ]);
        return back();
    }
}
