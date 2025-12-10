<?php

namespace App\Livewire\Transactions;

use App\Models\Transaction;
use App\Models\Category;
use App\Models\Event;
use Livewire\Component;

class CreateEdit extends Component
{
    public $transactionId;
    public $amount = '';
    public $type = 'expense';
    public $category_id = '';
    public $description = '';
    public $date = '';
    public $event_id = '';
    public $payment_method = '';

    protected $rules = [
        'amount' => 'required|numeric|min:0.01',
        'type' => 'required|in:income,expense',
        'category_id' => 'required|exists:categories,id',
        'description' => 'required|string|max:255',
        'date' => 'required|date',
        'event_id' => 'nullable|exists:events,id',
        'payment_method' => 'nullable|string',
    ];

    public function mount($transactionId = null, $eventId = null, $type = 'expense')
    {
        $this->transactionId = $transactionId;
        $this->date = date('Y-m-d');
        
        if ($transactionId) {
            $transaction = Transaction::findOrFail($transactionId);
            
            if ($transaction->user_id !== auth()->id()) {
                abort(403);
            }
            
            $this->amount = $transaction->amount;
            $this->type = $transaction->type;
            $this->category_id = $transaction->category_id;
            $this->description = $transaction->description;
            $this->date = $transaction->date;
            $this->event_id = $transaction->event_id;
            $this->payment_method = $transaction->payment_method;
        } else {
            // Pre-fill creation data
            if ($eventId) {
                $this->event_id = $eventId;
            }
            $this->type = $type;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'amount' => $this->amount,
            'type' => $this->type,
            'category_id' => $this->category_id,
            'description' => $this->description,
            'date' => $this->date,
            'event_id' => $this->event_id ?: null,
            'payment_method' => $this->payment_method,
        ];

        if ($this->transactionId) {
            // Update
            $transaction = Transaction::findOrFail($this->transactionId);
            
            if ($transaction->user_id !== auth()->id()) {
                abort(403);
            }
            
            $transaction->update($data);
            $message = 'Movimiento actualizado.';
        } else {
            // Create
            auth()->user()->transactions()->create($data);
            $message = 'Movimiento creado.';
        }

        session()->flash('success', $message);
        
        $this->dispatch('transaction-saved');
        $this->dispatch('close-modal');
    }

    public function render()
    {
        $categories = Category::all();
        $events = auth()->user()->events()->with('client')->where('status', '!=', 'completed')->get();
        
        return view('livewire.transactions.create-edit', [
            'categories' => $categories,
            'events' => $events,
        ]);
    }
}
