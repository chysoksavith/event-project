<?php

namespace App\Http\Controllers;

use App\Models\Gellery;
use Illuminate\Http\Request;

class GalleryIndexControlelr extends Controller
{
    public function __invoke()
    {
        $galleries = Gellery::orderBy('created_at', 'desc')->paginate(1);
        return view('galleryIndex', compact('galleries'));
    }
}
