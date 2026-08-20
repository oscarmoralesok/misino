<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        $event->load(['items', 'client', 'eventType', 'images']);

        $income = $event->transactions()->where('type', 'income')->sum('amount');
        $expense = $event->transactions()->where('type', 'expense')->sum('amount');
        $balance = $income - $expense;
        $transactions = $event->transactions()->with('category')->latest('date')->get();

        return view('events.show', compact('event', 'income', 'expense', 'balance', 'transactions'));
    }

    public function destroy(Event $event)
    {
        // Global access
        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Evento eliminado correctamente.');
    }
    public function confirm(Event $event)
    {


        $event->update(['status' => 'confirmed']);

        return back()->with('success', '¡Evento confirmado exitosamente!');
    }

    public function destroyImage(Event $event, $imageId)
    {


        $image = $event->images()->findOrFail($imageId);
        
        // Delete the file from storage
        Storage::disk('public')->delete($image->image_path);
        
        // Delete the database record
        $image->delete();

        return back()->with('success', 'Imagen eliminada exitosamente.');
    }

    public function downloadPdf(Event $event)
    {
        try {
            // Increase memory and execution time limits for PDF generation
            ini_set('memory_limit', '512M');
            set_time_limit(120);

            // Set numeric locale to standard C to prevent decimal parsing bugs in European timezones/locales
            setlocale(LC_NUMERIC, 'C');

            $event->load(['client', 'items', 'images']);
            
            $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('events.pdf', compact('event'));
            
            return $pdf->download('presupuesto-' . $event->id . '.pdf');
        } catch (\Throwable $e) {
            return response()->json([
                'error' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => explode("\n", $e->getTraceAsString())
            ], 500);
        }
    }

    public function serveFile($path)
    {
        // Decode path if needed, though usually automatic
        $fullPath = Storage::disk('public')->path($path);

        if (!file_exists($fullPath)) {
            abort(404);
        }

        return response()->file($fullPath);
    }
}
