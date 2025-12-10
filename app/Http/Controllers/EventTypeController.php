<?php

namespace App\Http\Controllers;

use App\Models\EventType;
use Illuminate\Http\Request;

class EventTypeController extends Controller
{
    public function index()
    {
        $eventTypes = auth()->user()->eventTypes()->orderBy('name')->get();
        return view('event_types.index', compact('eventTypes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $request->user()->eventTypes()->create($validated);

        return redirect()->back()->with('success', 'Tipo de evento creado.');
    }

    public function update(Request $request, EventType $eventType)
    {
        if ($eventType->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $eventType->update($validated);

        return redirect()->back()->with('success', 'Tipo de evento actualizado.');
    }

    public function destroy(EventType $eventType)
    {
        if ($eventType->user_id !== auth()->id()) {
            abort(403);
        }

        $eventType->delete();

        return redirect()->back()->with('success', 'Tipo de evento eliminado.');
    }
}
