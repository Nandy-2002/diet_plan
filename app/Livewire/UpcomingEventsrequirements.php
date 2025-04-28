<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class UpcomingEventsrequirements extends Component
{
    public $events;
    public $selectedRequirements = [];

    public function mount()
    {
        // Load upcoming events
        $this->events = Event::where('event_status', 'upcoming')->get();
    }

    public function showRequirements($requirements)
    {
        $this->selectedRequirements = is_string($requirements) ? json_decode($requirements, true) : $requirements;
    }

    public function render()
    {
        return view('livewire.upcoming-eventsrequirements');
    }
}
