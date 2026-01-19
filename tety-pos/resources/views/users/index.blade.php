<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight border-l-4 border-[#d13d7c] pl-4">
                {{ __('Gestión de Usuarios') }}
            </h2>
            <a href="{{ route('users.create') }}" class="w-full sm:w-auto text-center inline-flex justify-center items-center px-6 py-3 bg-[#d13d7c] border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-widest hover:bg-[#b03368] transform active:scale-95 transition-all shadow-lg">
                + Nuevo Usuario
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div id="alert"
                    class="fixed top-5 right-5 bg-green-100 text-green-700 px-6 py-3 rounded-xl shadow-lg font-bold flex items-center z-50">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div id="alert"
                    class="fixed top-5 right-5 bg-red-100 text-red-700 px-6 py-3 rounded-xl shadow-lg font-bold flex items-center z-50">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    {{ session('error') }}
                </div>
            @endif

            @if ($errors->any())
                <div id="alert"
                    class="fixed top-5 right-5 bg-red-100 text-red-700 px-6 py-4 rounded-xl shadow-lg font-bold z-50">
                    <strong>⚠️ Atención: Revisa los campos</strong>
                    <ul class="mt-2 list-disc list-inside text-sm font-normal">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                
                <div class="hidden sm:block">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-[#d13d7c] text-white">
                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider">Perfil / Nombre</th>
                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider">Correo Electrónico</th>
                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider">Rol Asignado</th>
                                <th class="px-6 py-4 text-right text-xs font-black uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach ($users as $user)
                                <tr class="hover:bg-pink-50 transition-colors">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-10 w-10 rounded-xl bg-pink-100 text-[#d13d7c] flex items-center justify-center font-black shadow-sm border border-pink-200 uppercase mr-3">
                                                {{ substr($user->name, 0, 2) }}
                                            </div>
                                            <div class="text-sm font-black text-gray-800 uppercase tracking-tight">
                                                {{ $user->name }}
                                                @if(auth()->id() === $user->id)
                                                    <span class="ml-2 text-[10px] bg-white text-[#d13d7c] border border-pink-200 px-2 py-0.5 rounded-md italic font-bold">Tú</span>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500 font-mono italic">
                                        {{ $user->email }}
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        @forelse($user->getRoleNames() as $rol)
                                            <span class="px-3 py-1 text-[10px] font-black rounded-full bg-gray-100 text-gray-600 border border-gray-200 uppercase tracking-widest">
                                                {{ $rol }}
                                            </span>
                                        @empty
                                            <span class="px-3 py-1 text-[10px] font-bold rounded-full bg-red-50 text-red-400 border border-red-100 uppercase italic">
                                                Sin Acceso
                                            </span>
                                        @endforelse
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-right">
                                        <div class="flex justify-end items-center gap-2">
                                            <a href="{{ route('users.edit', $user) }}" class="p-2 text-gray-400 hover:text-[#d13d7c] transition hover:bg-white hover:shadow-sm rounded-lg" title="Editar Usuario">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </a>
                                            
                                            @if(auth()->id() !== $user->id)
                                                <form action="{{ route('users.destroy', $user) }}" method="POST" class="inline">
                                                    @csrf @method('DELETE')
                                                    <button type="submit" 
                                                            onclick="return confirm('¿Eliminar a {{ $user->name }}?')"
                                                            class="p-2 text-gray-400 hover:text-red-600 transition hover:bg-white hover:shadow-sm rounded-lg" title="Eliminar Usuario">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="block sm:hidden divide-y divide-gray-100">
                    @foreach ($users as $user)
                        <div class="p-6 bg-white active:bg-pink-50 transition">
                            <div class="flex justify-between items-start mb-4">
                                <div class="flex items-center gap-3">
                                    <div class="h-12 w-12 rounded-2xl bg-pink-100 text-[#d13d7c] flex items-center justify-center font-black border border-pink-200 uppercase">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <h3 class="text-base font-black text-gray-800 uppercase tracking-tight leading-none">{{ $user->name }}</h3>
                                        <p class="text-[11px] text-gray-400 font-mono mt-1 italic">{{ $user->email }}</p>
                                    </div>
                                </div>
                                @if(auth()->id() === $user->id)
                                    <span class="text-[9px] bg-[#d13d7c] text-white px-2 py-1 rounded font-black uppercase tracking-tighter shadow-sm shadow-pink-200">Tú</span>
                                @endif
                            </div>

                            <div class="flex flex-wrap gap-1 mb-5">
                                @foreach($user->getRoleNames() as $rol)
                                    <span class="px-2 py-0.5 text-[9px] font-black rounded-md bg-gray-50 text-gray-500 border border-gray-200 uppercase tracking-tighter">
                                        {{ $rol }}
                                    </span>
                                @endforeach
                            </div>

                            <div class="flex gap-3">
                                <a href="{{ route('users.edit', $user) }}" class="flex-1 flex justify-center items-center py-3 bg-gray-50 text-gray-500 rounded-xl border border-gray-100 font-bold text-sm">
                                    {{ __('Editar') }}
                                </a>
                                
                                @if(auth()->id() !== $user->id)
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" class="flex-1" onsubmit="return confirm('¿Eliminar?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="w-full flex justify-center items-center py-3 bg-red-50 text-red-500 rounded-xl border border-red-100 font-bold text-sm">
                                            {{ __('Borrar') }}
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="p-6 bg-white border-t border-gray-100">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const alertBox = document.getElementById("alert");
        if (alertBox) {
            setTimeout(() => {
                alertBox.style.transition = "opacity 0.5s ease";
                alertBox.style.opacity = "0";
                setTimeout(() => alertBox.remove(), 500);
            }, 4000); 
        }
    });
</script>
