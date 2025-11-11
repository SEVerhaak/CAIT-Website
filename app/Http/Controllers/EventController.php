<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function create()
    {
        return view('events.create');
    }

    public function index(Request $request)
    {
        // Default per page
        $perPage = $request->input('per_page', 5);
        $perPage = in_array($perPage, [5, 10, 20]) ? $perPage : 5;

        $events = Event::orderBy('begin_time', 'desc')->paginate($perPage)->withQueryString();

        return view('events.index', compact('events', 'perPage'));
    }

    public function show(Event $event)
    {
        return view('events.show', compact('event'));
    }


    public function edit(Event $event)
    {
        return view('events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->merge([
            'limit' => $request->has('limit') ? 1 : 0,
            'requires_payment' => $request->has('requires_payment') ? 1 : 0,
            'requires_membership' => $request->has('requires_membership') ? 1 : 0,
            'send_mail' => $request->has('send_mail') ? 1 : 0,
            'active' => $request->has('active') ? 1 : 0,
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img' => 'nullable|image|max:2048',
            'begin_time' => 'required|date',
            'end_time' => 'required|date|after:begin_time',
            'limit' => 'boolean',
            'max_people' => 'required_if:limit,1|nullable|integer|min:1',
            'requires_payment' => 'boolean',
            'requires_membership' => 'boolean',
            'send_mail' => 'boolean',
            'active' => 'boolean',
        ]);

        // Handle image replacement
        if ($request->hasFile('img')) {
            if ($event->img && \Storage::disk('public')->exists($event->img)) {
                \Storage::disk('public')->delete($event->img);
            }
            $validated['img'] = $request->file('img')->store('event_images', 'public');
        }

        // Normalize datetime
        $validated['begin_time'] = str_replace('T', ' ', $validated['begin_time']);
        $validated['end_time'] = str_replace('T', ' ', $validated['end_time']);

        $event->update($validated);

        return redirect()->route('events.edit', $event)->with('success', 'Event updated successfully!');
    }



    public function store(Request $request)
    {
        // Set default values for checkboxes
        $request->merge([
            'limit' => $request->has('limit') ? 1 : 0,
            'requires_payment' => $request->has('requires_payment') ? 1 : 0,
            'requires_membership' => $request->has('requires_membership') ? 1 : 0,
            'send_mail' => $request->has('send_mail') ? 1 : 0,
            'active' => $request->has('active') ? 1 : 0,
        ]);

        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'img' => 'nullable|image|max:2048', // already nullable
            'begin_time' => 'required|date',
            'end_time' => 'required|date|after:begin_time',
            'limit' => 'boolean',
            'max_people' => 'required_if:limit,1|nullable|integer|min:1', // only required if limit is 1
            'requires_payment' => 'boolean',
            'requires_membership' => 'boolean',
            'send_mail' => 'boolean',
            'active' => 'boolean',
        ]);

        // Handle image upload
        if ($request->hasFile('img')) {
            $validated['img'] = $request->file('img')->store('event_images', 'public');
        }

        // Normalize datetime format for MySQL (replace 'T' with space)
        $validated['begin_time'] = str_replace('T', ' ', $validated['begin_time']);
        $validated['end_time'] = str_replace('T', ' ', $validated['end_time']);

        // Create event
        Event::create($validated);

        // Redirect back with success message
        return redirect()->route('events.create')->with('success', 'Event created successfully!');
    }

    // Show confirmation page
    public function confirmDelete(Event $event)
    {
        return view('events.confirm-delete', compact('event'));
    }

    // Perform deletion
    public function destroy(Event $event)
    {
        // Delete image if exists
        if ($event->img && \Storage::disk('public')->exists($event->img)) {
            \Storage::disk('public')->delete($event->img);
        }

        $event->delete();

        return redirect()->route('events.index')->with('success', 'Event deleted successfully!');
    }

}
