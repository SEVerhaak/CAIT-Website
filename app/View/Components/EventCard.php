<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Event;

class EventCard extends Component
{
    public Event $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function render()
    {
        return view('components.event-card');
    }
}
