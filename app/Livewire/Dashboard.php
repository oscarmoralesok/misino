<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Transaction;

class Dashboard extends Component
{
    public $income = 0;
    public $expense = 0;
    public $balance = 0;
    public $historicalIncome = 0;
    
    public $chartLabels = [];
    public $incomeData = [];
    public $expenseData = [];

    public function mount()
    {
        // $user = auth()->user();

        $this->income = Transaction::query()
            ->where('type', 'income')
            ->whereMonth('date', now()->month)
            ->sum('amount');

        $this->expense = Transaction::query()
            ->where('type', 'expense')
            ->whereMonth('date', now()->month)
            ->sum('amount');

        $this->balance = $this->income - $this->expense;

        $this->historicalIncome = Transaction::query()
            ->where('type', 'income')
            ->sum('amount');

        // Chart Data Calculation
        $this->chartLabels = [];
        $this->incomeData = [];
        $this->expenseData = [];

        for ($i = 11; $i >= 0; $i--) {
            $date = now()->subMonths($i);
            $monthName = $date->translatedFormat('M y'); // e.g. "Dec 24"
            $this->chartLabels[] = $monthName;

            $this->incomeData[] = Transaction::query()
                ->where('type', 'income')
                ->whereYear('date', $date->year)
                ->whereMonth('date', $date->month)
                ->sum('amount');

            $this->expenseData[] = Transaction::query()
                ->where('type', 'expense')
                ->whereYear('date', $date->year)
                ->whereMonth('date', $date->month)
                ->sum('amount');
        }
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
