<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;

class Calendar extends Component
{
    public $events = [];

    public function mount()
    {
        $this->events = Event::query()
            ->where('status', 'confirmed')
            ->with('client')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => ($event->client?->name ?? 'Sin cliente') . ' - ' . $event->detail,
                    'start' => $event->event_date->format('Y-m-d') . ($event->start_time ? 'T' . \Carbon\Carbon::parse($event->start_time)->format('H:i:s') : ''),
                    'end' => $event->event_date->format('Y-m-d') . ($event->end_time ? 'T' . \Carbon\Carbon::parse($event->end_time)->format('H:i:s') : ''),
                    'url' => route('events.show', $event),
                    'color' => '#4f46e5', // Indigo
                ];
            })
            ->toArray();
    }

    public function render()
    {
        return view('livewire.calendar');
    }
}
