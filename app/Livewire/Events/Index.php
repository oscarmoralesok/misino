<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $filterStatus = 'pending';
    public $search = '';

    protected $queryString = [
        'filterStatus' => ['except' => 'pending', 'as' => 'status'],
        'search' => ['except' => '', 'as' => 'q'],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function delete($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();
        
        session()->flash('success', 'Evento eliminado.');
        $this->resetPage();
    }

    public function render()
    {
        $query = Event::with(['client', 'eventType']);

        // Filter by status
        if ($this->filterStatus === 'confirmed') {
            $query->whereIn('status', ['confirmed', 'completed', 'paid']);
        } else {
            $query->whereIn('status', ['draft', 'sent', 'pending', 'cancelled']);
        }

        // Search
        if ($this->search) {
            $query->whereHas('client', function($q) {
                $q->where('name', 'like', '%' . $this->search . '%');
            })->orWhere('detail', 'like', '%' . $this->search . '%');
        }

        $events = $query->latest('event_date')->paginate(10);
        
        return view('livewire.events.index', [
            'events' => $events
        ]);
    }
}
