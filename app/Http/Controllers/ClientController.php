<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = auth()->user()->clients()->latest()->paginate(10);
        return view('clients.index', compact('clients'));
    }

    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_relationship' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
        ]);

        $client = $request->user()->clients()->create($validated);

        if ($request->input('action') === 'save_and_quote') {
            return redirect()->route('quotes.create', ['client_id' => $client->id])
                ->with('success', 'Cliente registrado. Ahora puedes crear el presupuesto.');
        }

        return redirect()->route('clients.index')
            ->with('success', 'Cliente registrado correctamente.');
    }

    public function edit(Client $client)
    {
        if ($client->user_id !== auth()->id()) {
            abort(403);
        }

        return view('clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        if ($client->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'contact_name' => 'nullable|string|max:255',
            'contact_relationship' => 'nullable|string|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'instagram' => 'nullable|string|max:255',
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')
            ->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Client $client)
    {
        if ($client->user_id !== auth()->id()) {
            abort(403);
        }

        $client->delete();

        return redirect()->route('clients.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }
}
