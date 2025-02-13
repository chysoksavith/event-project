<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Event;
use App\Models\Country;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateEventRequest;
use App\Http\Requests\updateEventRequest;
use Illuminate\Http\RedirectResponse;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::with('country')->orderBy('created_at', 'desc')->paginate(15);
        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        $tags = Tag::all();
        return view('events.create', compact('countries', 'tags'));
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

        try {
            // Create event
            $event = Event::create($data);
            // Attach tags if present
            if ($request->has('tags')) {
                $event->tags()->attach($request->tags);
            }
            return redirect()->route('eventss.index')->with('success', 'Event created successfully');
        } catch (\Exception $e) {
            // Handle exception if necessary
            Log::error('Error creating event: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to create event. Please try again.']);
        }
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
    public function edit($id): View
    {

        $countries = Country::all();
        $tags = Tag::all();
        $event = Event::findOrFail($id);
        return view('events.edit', compact('countries', 'tags', 'event'));
    }

    /**
     * Update the specified resource in storage.
     */
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventRequest $request, Event $event)
    {
        // Validate request data
        $data = $request->validated();

        // Debugging
        Log::info('Request Data for Update: ', $data);

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

        // Handle image upload (if present)
        if ($request->hasFile('image')) {
            Log::info('Image uploaded: ', [$request->file('image')->getClientOriginalName()]);

            // Delete the old image if it exists
            if ($event->image) {
                Log::info('Deleting old image: ' . $event->image);
                Storage::disk('public')->delete($event->image);
            }

            // Store new image
            $data['image'] = Storage::disk('public')->putFile('events', $request->file('image'));
            Log::info('New image stored: ' . $data['image']);
        }


        // Ensure the slug is unique, even if the title is the same
        $data['slug'] = Str::slug($request->title);

        // Check if slug exists and is not the current event's slug
        if (Event::where('slug', $data['slug'])->where('id', '!=', $event->id)->exists()) {
            return back()->withErrors(['slug' => 'Slug already exists. Try a different title.'])->withInput();
        }

        try {
            // Update the event
            $event->update($data);

            // Update tags if present
            $event->tags()->sync($request->tags);
            return redirect()->route('eventss.index')->with('success', 'Event updated successfully');
        } catch (\Exception $e) {
            // Handle exception if necessary
            Log::error('Error updating event: ' . $e->getMessage());
            return back()->withInput()->withErrors(['error' => 'Failed to update event. Please try again.']);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Manually find the event
        $event = Event::findOrFail($id);


        // Check if the image exists in the storage
        if ($event->image && Storage::disk('public')->exists($event->image)) {
            // Delete the image
            Storage::disk('public')->delete($event->image);
        }

        // Detach tags and delete the event
        $event->tags()->detach();
        $event->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Record deleted successfully');
    }
}
