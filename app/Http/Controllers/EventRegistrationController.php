<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EventRegistrationController extends Controller
{
    public function confirm(Event $event)
    {
        // Check if user already registered
        $user = Auth::user();
        $alreadyRegistered = $event->users()->where('user_id', $user->id)->exists();

        if ($alreadyRegistered) {
            return redirect()->route('events.show', $event)
                ->with('error', 'You are already registered for this event.');
        }

        return view('events.register-confirm', compact('event'));
    }

    public function register(Request $request, Event $event)
    {
        $user = Auth::user();

        // Check if event is active
        if (! $event->active) {
            return redirect()->route('events.register.confirm', $event)
                ->withErrors(['active' => 'This event is no longer active.']);
        }

        // Check if event has a limit
        if ($event->limit && $event->users()->count() >= $event->max_people) {
            return redirect()->route('events.register.confirm', $event)
                ->withErrors(['capacity' => 'This event has reached its maximum capacity.']);
        }

        // Prevent double registration
        if ($event->users()->where('user_id', $user->id)->exists()) {
            return redirect()->route('events.register.confirm', $event)
                ->withErrors(['registered' => 'You are already registered for this event.']);
        }

        // Register the user
        $event->users()->attach($user->id, ['registered_at' => now()]);

        return redirect()->route('events.show', $event)
            ->with('success', 'You have successfully registered for this event.');
    }

}
