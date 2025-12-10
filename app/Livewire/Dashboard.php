<?php

namespace App\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $income = 0;
    public $expense = 0;
    public $balance = 0;

    public function mount()
    {
        $user = auth()->user();

        $this->income = $user->transactions()
            ->where('type', 'income')
            ->whereMonth('date', now()->month)
            ->sum('amount');

        $this->expense = $user->transactions()
            ->where('type', 'expense')
            ->whereMonth('date', now()->month)
            ->sum('amount');

        $this->balance = $this->income - $this->expense;
    }

    public function render()
    {
        $recentTransactions = auth()->user()->transactions()
            ->with(['category', 'event'])
            ->latest('date')
            ->take(5)
            ->get();

        return view('livewire.dashboard', [
            'recentTransactions' => $recentTransactions
        ]);
    }
}
