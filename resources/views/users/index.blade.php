<x-app-layout>
    <div class="space-y-8">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row justify-between items-end gap-6">
            <div>
                <h2 class="font-display font-bold text-3xl text-gray-800 dark:text-white leading-tight">Gestión de Usuarios</h2>
                <p class="text-gray-400 dark:text-gray-500 text-sm mt-1 font-medium">Administra los accesos y perfiles del sistema.</p>
            </div>
            <a href="{{ route('users.create') }}" 
               class="btn-primary w-full md:w-auto flex items-center justify-center shadow-soft">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                Nuevo Usuario
            </a>
        </div>

        <div class="space-y-6">
        {{-- Users Table Container --}}
        <div class="premium-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 dark:bg-gray-800/50 border-b border-gray-100 dark:border-gray-700">
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Usuario</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Correo Electrónico</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em]">Registrado el</th>
                            <th class="px-6 py-4 text-[10px] font-bold text-gray-400 uppercase tracking-[0.2em] text-center">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-800">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-800/30 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-primary-100 dark:bg-primary-900/30 flex items-center justify-center text-primary-600 dark:text-primary-400 font-bold text-xs mr-3">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="text-sm font-bold text-gray-800 dark:text-gray-100">
                                            {{ $user->name }}
                                        </div>
                                        @if(auth()->id() === $user->id)
                                            <span class="text-[10px] text-primary-500 font-bold uppercase tracking-wider">Tú</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ $user->email }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-xs text-gray-400 dark:text-gray-500">
                                    {{ $user->created_at->format('d M, Y') }}
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    @if(auth()->id() !== $user->id)
                                        <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    class="p-2 text-accent-400 hover:text-accent-600 hover:bg-accent-50 dark:hover:bg-accent-900/10 rounded-xl transition-all"
                                                    title="Eliminar usuario">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-[10px] text-gray-300 uppercase tracking-widest italic select-none">Sin acciones</span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-100 dark:border-gray-700 bg-gray-50/30">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
