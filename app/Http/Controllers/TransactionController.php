<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Download receipt PDF for a transaction
     */
    public function downloadReceipt(Transaction $transaction)
    {
        // Increase memory and execution time limits for PDF generation
        ini_set('memory_limit', '512M');
        set_time_limit(120);

        // Load necessary relationships
        $transaction->load(['event.client', 'event.eventType', 'category']);
        
        // Calculate event balance
        $event = $transaction->event;
        $income = $event->transactions()->where('type', 'income')->sum('amount');
        $expense = $event->transactions()->where('type', 'expense')->sum('amount');
        $balance = $income - $expense;
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('transactions.receipt-pdf', compact('transaction', 'income', 'expense', 'balance'));
        
        $filename = 'recibo-' . str_pad($transaction->id, 5, '0', STR_PAD_LEFT) . '.pdf';
        
        return $pdf->download($filename);
    }
}
