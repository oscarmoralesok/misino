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
    public $transactionType = 'expense';

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->event->load(['items', 'client', 'eventType', 'images']);
    }

    #[On('transaction-saved')]
    #[On('close-modal')]
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
        $this->event->update(['status' => 'confirmed']);
        $this->refreshData();
        session()->flash('success', 'Evento confirmado con éxito.');
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
