<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;

class Dashboard extends Component
{
    public $income = 0;
    public $expense = 0;
    public $balance = 0;

    public function mount()
    {
        $user = auth()->user();

        $this->income = Transaction::query()
            ->where('type', 'income')
            ->whereMonth('date', now()->month)
            ->sum('amount');

        $this->expense = Transaction::query()
            ->where('type', 'expense')
            ->whereMonth('date', now()->month)
            ->sum('amount');

        $this->balance = $this->income - $this->expense;
    }

    public function render()
    {
        $recentTransactions = Transaction::query()
            ->with(['category', 'event'])
            ->latest('date')
            ->take(5)
            ->get();

        return view('livewire.dashboard', [
            'recentTransactions' => $recentTransactions
        ]);
    }
}
