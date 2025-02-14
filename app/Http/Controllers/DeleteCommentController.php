<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class DeleteCommentController extends Controller
{
    public function __invoke($id, Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
