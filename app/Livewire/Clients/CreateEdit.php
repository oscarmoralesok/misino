<?php

namespace App\Livewire\Clients;

use App\Models\Client;
use Livewire\Component;

class CreateEdit extends Component
{
    public $clientId;
    public $name = '';
    public $phone = '';
    public $email = '';
    public $contact_name = '';
    public $contact_relationship = '';
    public $contact_phone = '';
    public $instagram = '';

    protected $rules = [
        'name' => 'required|string|max:255',
        'phone' => 'required|string|max:20',
        'email' => 'nullable|email|max:255',
        'contact_name' => 'nullable|string|max:255',
        'contact_relationship' => 'nullable|string|max:255',
        'contact_phone' => 'nullable|string|max:20',
        'instagram' => 'nullable|string|max:255',
    ];

    public function mount($clientId = null)
    {
        $this->clientId = $clientId;
        
        if ($clientId) {
            $client = Client::findOrFail($clientId);
            
            // Global access
            // if ($client->user_id !== auth()->id()) { abort(403); }
            
            $this->name = $client->name;
            $this->phone = $client->phone;
            $this->email = $client->email;
            $this->contact_name = $client->contact_name;
            $this->contact_relationship = $client->contact_relationship;
            $this->contact_phone = $client->contact_phone;
            $this->instagram = $client->instagram;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'contact_name' => $this->contact_name,
            'contact_relationship' => $this->contact_relationship,
            'contact_phone' => $this->contact_phone,
            'instagram' => $this->instagram,
        ];

        if ($this->clientId) {
            // Update
            $client = Client::findOrFail($this->clientId);
            
            $client->update($data);
            $message = 'Cliente actualizado.';
            
            session()->flash('success', $message);
            $this->dispatch('client-saved');
            $this->dispatch('close-modal');
        } else {
            // Create
            Client::create($data);
            $message = 'Cliente creado.';
            
            session()->flash('success', $message);
            $this->dispatch('client-saved');
            $this->dispatch('close-modal');
        }
    }

    public function saveAndCreateEvent()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'contact_name' => $this->contact_name,
            'contact_relationship' => $this->contact_relationship,
            'contact_phone' => $this->contact_phone,
            'instagram' => $this->instagram,
        ];

        if ($this->clientId) {
            $client = Client::findOrFail($this->clientId);
            $client->update($data);
        } else {
            $client = Client::create($data);
        }

        session()->flash('success', 'Cliente guardado. Redirigiendo a crear evento...');
        return redirect()->route('events.create', ['client_id' => $client->id]);
    }

    public function render()
    {
        return view('livewire.clients.create-edit');
    }
}
