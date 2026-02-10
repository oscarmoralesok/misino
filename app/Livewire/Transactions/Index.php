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
    public $filterMonth = '';
    public $filterYear = '';
    public $filterCategoryId = '';
    public $showModal = false;
    public $editingId = null;
    public $create = false;
    public $initialEventId = null;
    public $initialType = 'expense';

    protected $queryString = [
        'filterType', 
        'filterMonth', 
        'filterYear', 
        'filterCategoryId', 
        'create', 
        'initialEventId' => ['as' => 'event_id'], 
        'initialType' => ['as' => 'type']
    ];

    public function mount()
    {
        if ($this->create) {
            $this->showModal = true;
        }

        // Default to current month and year could be an option, 
        // but often 'All' is better for inventory-like views.
        // If we want current year by default:
        // $this->filterYear = date('Y');
    }

    public function updatingFilterType()
    {
        $this->resetPage();
    }

    public function updatingFilterMonth()
    {
        $this->resetPage();
    }

    public function updatingFilterYear()
    {
        $this->resetPage();
    }

    public function updatingFilterCategoryId()
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
        $query = Transaction::query()
            ->with(['category', 'event.client'])
            ->when($this->filterType, function($query) {
                $query->where('type', $this->filterType);
            })
            ->when($this->filterMonth, function($query) {
                $query->whereMonth('date', $this->filterMonth);
            })
            ->when($this->filterYear, function($query) {
                $query->whereYear('date', $this->filterYear);
            })
            ->when($this->filterCategoryId, function($query) {
                $query->where('category_id', $this->filterCategoryId);
            });

        $transactions = $query->clone()->latest('date')->paginate(10);
        
        // Calculate totals based on same filters
        $totals = Transaction::query()
            ->when($this->filterType, function($query) {
                $query->where('type', $this->filterType);
            })
            ->when($this->filterMonth, function($query) {
                $query->whereMonth('date', $this->filterMonth);
            })
            ->when($this->filterYear, function($query) {
                $query->whereYear('date', $this->filterYear);
            })
            ->when($this->filterCategoryId, function($query) {
                $query->where('category_id', $this->filterCategoryId);
            })
            ->selectRaw('type, SUM(amount) as total')
            ->groupBy('type')
            ->pluck('total', 'type');

        $categories = \App\Models\Category::all();
        
        return view('livewire.transactions.index', [
            'transactions' => $transactions,
            'totalIncome' => $totals['income'] ?? 0,
            'totalExpense' => $totals['expense'] ?? 0,
            'categories' => $categories,
        ]);
    }
}
