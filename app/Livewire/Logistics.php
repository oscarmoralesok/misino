<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Event;
use Carbon\Carbon;

class Logistics extends Component
{
    protected $queryString = ['date'];

    public $date;

    public function mount()
    {
        $this->date = request()->date ?? now()->format('Y-m-d');
    }

    public function updatedDate()
    {
        // Livewire updates automatically
    }

    public function render()
    {
        $events = Event::query()
            ->with(['client', 'eventType', 'items.product']) // Load items and their products
            ->where('status', 'confirmed') // Only confirmed events
            ->whereDate('event_date', $this->date)
            ->orderBy('start_time')
            ->get();

        return view('livewire.logistics', [
            'events' => $events
        ]);
    }
}
