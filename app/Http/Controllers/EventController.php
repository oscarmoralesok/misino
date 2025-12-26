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
        $event->load(['client', 'items']);
        
        $pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('events.pdf', compact('event'));
        
        return $pdf->download('presupuesto-' . $event->id . '.pdf');
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
