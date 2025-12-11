<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;

    public $showModal = false;
    public $editingId = null;
    public $search = '';

    protected $queryString = ['search'];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    #[On('client-saved')]
    public function refreshList()
    {
        $this->resetPage();
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
        $client = Client::findOrFail($id);
        
        $client->delete();
        
        session()->flash('success', 'Cliente eliminado.');
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editingId = null;
    }

    public function render()
    {
        $clients = Client::query()
            ->when($this->search, function($query) {
                $query->where('name', 'like', '%' . $this->search . '%')
                      ->orWhere('phone', 'like', '%' . $this->search . '%')
                      ->orWhere('email', 'like', '%' . $this->search . '%');
            })
            ->latest()
            ->paginate(10);
        
        return view('livewire.clients.index', [
            'clients' => $clients
        ]);
    }
}
