<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Optional: seed default categories for new admin
        $categories = [
            ['name' => 'Anticipo Cliente', 'type' => 'income', 'color' => '#10B981'],
            ['name' => 'Pago Final', 'type' => 'income', 'color' => '#34D399'],
            ['name' => 'Globos', 'type' => 'expense', 'color' => '#EF4444'],
            ['name' => 'Bases/Estructuras', 'type' => 'expense', 'color' => '#F87171'],
            ['name' => 'Transporte', 'type' => 'expense', 'color' => '#FBBF24'],
            ['name' => 'Personal', 'type' => 'expense', 'color' => '#60A5FA'],
        ];

        foreach ($categories as $category) {
            $user->categories()->create($category);
        }

        return redirect()->route('users.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function destroy(User $user)
    {
        if (auth()->id() === $user->id) {
            return back()->with('error', 'No puedes eliminar tu propia cuenta.');
        }

        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }
}
