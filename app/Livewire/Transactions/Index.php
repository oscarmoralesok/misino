<?php

namespace App\Livewire\Transactions;

use App\Models\Transaction;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;

    public $filterType = '';
    public $showModal = false;
    public $editingId = null;
    public $create = false;
    public $initialEventId = null;
    public $initialType = 'expense';

    protected $queryString = ['filterType', 'create', 'initialEventId' => ['as' => 'event_id'], 'initialType' => ['as' => 'type']];

    public function mount()
    {
        if ($this->create) {
            $this->showModal = true;
        }
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    #[On('transaction-saved')]
    public function refreshList()
    {
        $this->resetPage();
        $this->reset('editingId', 'showModal', 'create', 'initialEventId', 'initialType');
    }

    public function openCreateModal()
    {
        $this->editingId = null;
        $this->showModal = true;
        // Reset creating params so they don't stick if we close/reopen
        $this->initialEventId = null;
        $this->initialType = 'expense'; 
    }

    public function edit($id)
    {
        $this->editingId = $id;
        $this->showModal = true;
    }

    public function delete($id)
    {
        $transaction = Transaction::findOrFail($id);
        


        $transaction->delete();
        
        session()->flash('success', 'Movimiento eliminado.');
        $this->resetPage();
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->editingId = null;
    }

    public function render()
    {
        $transactions = Transaction::query()
            ->with(['category', 'event.client'])
            ->when($this->filterType, function($query) {
                $query->where('type', $this->filterType);
            })
            ->latest('date')
            ->paginate(10);
        
        // Calculate totals
        $totals = Transaction::query()
            ->when($this->filterType, function($query) {
                $query->where('type', $this->filterType);
            })
            ->selectRaw('type, SUM(amount) as total')
            ->groupBy('type')
            ->pluck('total', 'type');
        
        return view('livewire.transactions.index', [
            'transactions' => $transactions,
            'totalIncome' => $totals['income'] ?? 0,
            'totalExpense' => $totals['expense'] ?? 0,
        ]);
    }
}
