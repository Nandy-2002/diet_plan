<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;
use Carbon\Carbon;

class UpcomingEvents extends Component
{
    public function render()
    {
        // Fetch upcoming events where `start_date` is in the future
        $upcomingEvents = Event::where('start_date', '>=', now())
            ->orderBy('start_date')
            ->get();

        return view('livewire.upcoming-events', [
            'upcomingEvents' => $upcomingEvents,
        ]);
    }

    // Check if an event is new (added within the last 7 days)
    public function isNew($event)
    {
        return $event->created_at->greaterThanOrEqualTo(Carbon::now()->subDays(7));
    }
}
