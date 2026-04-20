<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

class FollowUp extends Component
{
    use WithPagination;

    public function recordFollowUp($eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->update([
            'last_follow_up_at' => now(),
        ]);
        
        // This is where the frontend would handle opening the WhatsApp link.
        // We can dispatch an event if needed, but the button itself can be a link.
        $this->dispatch('follow-up-recorded', eventId: $eventId);
    }

    public function render()
    {
        // Filter events:
        // 1. Status: sent or pending
        // 2. Age: updated_at >= 3 days ago AND updated_at <= 7 days ago
        // 3. Optional: Filter out if already followed up today
        
        $query = Event::with('client')
            ->whereIn('status', ['sent', 'pending'])
            ->where('updated_at', '<=', now()->subDays(3))
            ->where('updated_at', '>=', now()->subDays(7));

        // Order by age (oldest first)
        $events = $query->orderBy('updated_at', 'asc')->paginate(10);

        return view('livewire.events.follow-up', [
            'events' => $events
        ]);
    }
}
