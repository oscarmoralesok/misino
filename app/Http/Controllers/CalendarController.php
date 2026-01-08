<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar');
    }

    public function events()
    {
        $events = auth()->user()->events()
            ->where('status', 'confirmed')
            ->with('client')
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->client->name . ' - ' . $event->detail, // Simplification
                    'start' => $event->event_date->format('Y-m-d') . ($event->start_time ? 'T' . \Carbon\Carbon::parse($event->start_time)->format('H:i:s') : ''),
                    'end' => $event->event_date->format('Y-m-d') . ($event->end_time ? 'T' . \Carbon\Carbon::parse($event->end_time)->format('H:i:s') : ''),
                    'url' => route('events.show', $event),
                    'color' => '#4f46e5', // Indigo
                ];
            });

        return response()->json($events);
    }
}
