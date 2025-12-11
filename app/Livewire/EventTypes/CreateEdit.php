<?php

namespace App\Livewire\EventTypes;

use App\Models\EventType;
use Livewire\Component;

class CreateEdit extends Component
{
    public $eventTypeId;
    public $name = '';

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function mount($eventTypeId = null)
    {
        $this->eventTypeId = $eventTypeId;
        
        if ($eventTypeId) {
            $eventType = EventType::findOrFail($eventTypeId);
            
            $this->name = $eventType->name;
        }
    }

    public function save()
    {
        $this->validate();

        if ($this->eventTypeId) {
            // Update
            $eventType = EventType::findOrFail($this->eventTypeId);
            
            if ($eventType->user_id !== auth()->id()) {
                abort(403);
            }
            
            $eventType->update(['name' => $this->name]);
            $message = 'Tipo de evento actualizado.';
        } else {
            // Create
            EventType::create(['name' => $this->name]);
            $message = 'Tipo de evento creado.';
        }

        session()->flash('success', $message);
        
        $this->dispatch('event-type-saved');
        $this->dispatch('close-modal');
    }

    public function render()
    {
        return view('livewire.event-types.create-edit');
    }
}
