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
        // Removed auth check as requested
        // if ($event->user_id !== auth()->id()) {
        //     abort(403);
        // }

        $event->delete();

        return redirect()->route('events.index')
            ->with('success', 'Evento eliminado correctamente.');
    }
    public function confirm(Event $event)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }

        $event->update(['status' => 'confirmed']);

        return back()->with('success', '¡Evento confirmado exitosamente!');
    }

    public function destroyImage(Event $event, $imageId)
    {
        if ($event->user_id !== auth()->id()) {
            abort(403);
        }

        $image = $event->images()->findOrFail($imageId);
        
        // Delete the file from storage
        Storage::disk('public')->delete($image->image_path);
        
        // Delete the database record
        $image->delete();

        return back()->with('success', 'Imagen eliminada exitosamente.');
    }
}
