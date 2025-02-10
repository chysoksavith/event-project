<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateEventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('events.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        return view('events.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateEventRequest $request)
    {
        // Validate request data
        $data = $request->validated();

        // Debugging
        Log::info('Request Data: ', $data);

        // 🔹 Validate and format dates
        $startDate = Carbon::parse($request->start_date)->format('Y-m-d');
        $endDate = Carbon::parse($request->end_date)->format('Y-m-d');

        // Validate the date ranges manually (if outside reasonable limits)
        if ($startDate < '2000-01-01' || $startDate > '2100-12-31') {
            return back()->withErrors(['start_date' => 'Start date is out of allowed range.'])->withInput();
        }

        if ($endDate < '2000-01-01' || $endDate > '2100-12-31') {
            return back()->withErrors(['end_date' => 'End date is out of allowed range.'])->withInput();
        }

        // Assign formatted dates to data array
        $data['start_date'] = $startDate;
        $data['end_date'] = $endDate;

        // Handle image upload (keeping your original code)
        if ($request->hasFile('image')) {
            $data['image'] = Storage::disk('public')->putFile('events', $request->file('image'));
        }
        // Ensure user ID is always set
        $data['user_id'] = Auth::user()->id;

        // Generate slug
        $data['slug'] = Str::slug($request->title);

        // Ensure unique slug
        if (Event::where('slug', $data['slug'])->exists()) {
            return back()->withErrors(['slug' => 'Slug already exists. Try a different title.'])->withInput();
        }

        // Create event without try-catch
        if (Event::create($data)) {
            return redirect()->route('eventss.index')->with('success', 'Record created Successfully');
        }

        return back()->withErrors(['error' => 'An error occurred while saving the event.'])->withInput();
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
