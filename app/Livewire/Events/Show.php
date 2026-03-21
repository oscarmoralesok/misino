<?php

namespace App\Livewire\Events;

use App\Models\Event;
use App\Models\Transaction;
use Livewire\Component;
use Livewire\Attributes\On;

class Show extends Component
{
    public Event $event;
    public $showTransactionModal = false;
    public $editingTransactionId = null;
    public $transactionType = 'income'; // Changed from 'expense' to 'income'

    // Contact Modal properties
    public $showContactModal = false;
    public $contact_name = '';
    public $contact_phone = '';
    public $contact_relationship = '';

    // Replaced #[On] attributes with $listeners property
    protected $listeners = [
        'transaction-saved' => 'refreshData',
        'close-modal' => 'refreshData', // Assuming 'close-modal' should still trigger refreshData
    ];

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->event->load(['items', 'client', 'eventType', 'images']);
    }

    // #[On('transaction-saved')] // Removed, now handled by $listeners
    // #[On('close-modal')] // Removed, now handled by $listeners
    public function refreshData()
    {
        $this->showTransactionModal = false;
        $this->editingTransactionId = null;
        $this->event->refresh();
        $this->event->load(['items', 'client', 'eventType', 'images']);
    }

    public function openCreateTransaction($type = 'expense')
    {
        $this->editingTransactionId = null;
        $this->transactionType = $type;
        $this->showTransactionModal = true;
    }

    public function editTransaction($id)
    {
        $this->editingTransactionId = $id;
        $this->showTransactionModal = true;
    }

    public function deleteTransaction($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
        $this->refreshData();
    }

    public function confirmEvent()
    {
        // Check if client has contact_phone
        if (empty($this->event->client->contact_phone)) {
            $this->contact_name = $this->event->client->contact_name;
            $this->contact_phone = $this->event->client->contact_phone;
            $this->contact_relationship = $this->event->client->contact_relationship;
            $this->showContactModal = true;
            return;
        }

        $this->event->update(['status' => 'confirmed']);
        $this->refreshData();
        session()->flash('success', 'Evento confirmado con éxito.');
    }

    public function saveContactAndConfirm()
    {
        $this->validate([
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'contact_relationship' => 'nullable|string|max:100',
        ]);

        $this->event->client->update([
            'contact_name' => $this->contact_name,
            'contact_phone' => $this->contact_phone,
            'contact_relationship' => $this->contact_relationship,
        ]);

        $this->showContactModal = false;
        
        $this->event->update(['status' => 'confirmed']);
        $this->refreshData();
        session()->flash('success', 'Datos de contacto guardados y evento confirmado.');
    }

    public function deleteImage($id)
    {
        $image = $this->event->images()->findOrFail($id);
        \Illuminate\Support\Facades\Storage::disk('public')->delete($image->image_path);
        $image->delete();
        $this->refreshData();
        session()->flash('success', 'Imagen eliminada.');
    }

    public function render()
    {
        $income = $this->event->transactions()->where('type', 'income')->sum('amount');
        $expense = $this->event->transactions()->where('type', 'expense')->sum('amount');
        $balance = $income - $expense;
        $pendingBalance = $this->event->total_amount - $income;
        $transactions = $this->event->transactions()->with('category')->latest('date')->get();

        return view('livewire.events.show', [
            'income' => $income,
            'expense' => $expense,
            'balance' => $balance,
            'pendingBalance' => $pendingBalance,
            'transactions' => $transactions,
        ])->layout('layouts.app');
    }
}
