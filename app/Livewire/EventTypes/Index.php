<?php

namespace App\Livewire\EventTypes;

use App\Models\EventType;
use Livewire\Component;
use Livewire\Attributes\On;

class Index extends Component
{
    public $showModal = false;
    public $editingId = null;

    #[On('event-type-saved')]
    public function refreshList()
    {
        $this->reset('editingId', 'showModal');
    }

    public function create()
    {
        $this->editingId = null;
        $this->showModal = true;
    }

    public function edit($id)
    {
        $this->editingId = $id;
        $this->showModal = true;
    }

    public function delete($id)
    {
        $eventType = EventType::findOrFail($id);
        


        $eventType->delete();
        
        session()->flash('success', 'Tipo de evento eliminado.');
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editingId = null;
    }

    public function render()
    {
        $eventTypes = EventType::orderBy('name')->get();
        
        return view('livewire.event-types.index', [
            'eventTypes' => $eventTypes
        ]);
    }
}
