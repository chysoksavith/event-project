<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateGalleryRequest;
use App\Models\Gellery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $galleries = Auth::user()->galleries()->orderBy('created_at', 'desc')->paginate(1);
        return view('galleries.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('galleries.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateGalleryRequest $request)
    {
        // Validate the incoming data
        $data = $request->validated();

        // Check if the user uploaded an image
        if ($request->hasFile('image')) {
            // Store the gallery record with the image and caption
            Auth::user()->galleries()->create([
                'caption' => $request->input('caption'),
                'image' => $request->file('image')->store('events', 'public'),
            ]);

            // Redirect back to gallery index with success message
            return redirect()->route('galleries.index')->with('success', 'Record Created successfully');
        }

        // If no file is provided, return back with an error message
        return back()->with('error', 'No image was uploaded');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $gallery = Gellery::findOrFail($id);
        return view('galleries.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateGalleryRequest $request, string $id)
    {
        $data =  $request->validated();
        $gallery = Gellery::findOrFail($id);
        if ($request->hasFile('image')) {
            if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
                Storage::disk('public')->delete($gallery->image);
            }
            $data['image'] = $request->file('image')->store('events', 'public');
        }
        $gallery->update($data);
        return redirect()->route('galleries.index')->with('success', 'Gallery updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $gallery = Gellery::findOrFail($id);
        if ($gallery->image && Storage::disk('public')->exists($gallery->image)) {
            Storage::disk('public')->delete($gallery->image);
        }
        $gallery->delete();
        return redirect()->back()->with('success', 'Record deleted successfully');
    }
}
