<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight border-l-4 border-[#d13d7c] pl-4">
                {{ __('Categorías de Productos') }}
            </h2>
            <a href="{{ route('categories.create') }}" class="w-full sm:w-auto text-center inline-flex justify-center items-center px-6 py-3 bg-[#d13d7c] border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-widest hover:bg-[#b03368] transform active:scale-95 transition-all shadow-lg">
                + Nueva Categoría
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg font-bold flex items-center" role="alert">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                
                <div class="hidden sm:block">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-[#d13d7c] text-white">
                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider">Nombre de Categoría</th>
                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider">Slug (Identificador)</th>
                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider">Fecha Registro</th>
                                <th class="px-6 py-4 text-center text-xs font-black uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($categories as $category)
                                <tr class="hover:bg-pink-50 transition-colors">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="text-sm font-black text-gray-800 uppercase tracking-tight">{{ $category->name }}</div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span class="px-3 py-1 inline-flex text-[10px] leading-5 font-black rounded-full bg-gray-100 text-[#d13d7c] border border-gray-200 uppercase">
                                            /{{ $category->slug }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap text-sm text-gray-500 font-medium italic">
                                        {{ $category->created_at->format('d/m/Y') }}
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <div class="flex justify-center items-center gap-4">
                                            <a href="{{ route('categories.edit', $category) }}" class="p-2 text-gray-400 hover:text-[#d13d7c] transition hover:bg-white hover:shadow-sm rounded-lg">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </a>
                                            <form action="{{ route('categories.destroy', $category) }}" method="POST" onsubmit="return confirm('¿Eliminar esta categoría? Se desvincularán los productos asociados.');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition hover:bg-white hover:shadow-sm rounded-lg">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-10 text-center text-gray-400 italic">
                                            <div class="flex flex-col items-center">
                                                <svg class="w-12 h-12 mb-2 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                                                No hay categorías registradas aún.
                                            </div>
                                        </td>
                                    </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="block sm:hidden divide-y divide-gray-100">
                    @forelse ($categories as $category)
                        <div class="p-6 bg-white">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-black text-gray-800 uppercase leading-tight">{{ $category->name }}</h3>
                                    <p class="text-[10px] font-bold text-[#d13d7c] mt-1 tracking-widest italic">/{{ $category->slug }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-[9px] text-gray-400 font-bold uppercase">Registrado</p>
                                    <p class="text-xs text-gray-600 font-bold">{{ $category->created_at->format('d/m/Y') }}</p>
                                </div>
                            </div>

                            <div class="flex gap-3 mt-4">
                                <a href="{{ route('categories.edit', $category) }}" class="flex-1 flex justify-center items-center py-3 bg-gray-50 text-gray-500 rounded-xl border border-gray-100 font-bold text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    Editar
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="flex-1" onsubmit="return confirm('¿Eliminar?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full flex justify-center items-center py-3 bg-red-50 text-red-500 rounded-xl border border-red-100 font-bold text-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Borrar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-gray-400 italic">No hay categorías registradas.</div>
                    @endforelse
                </div>

                @if($categories->hasPages())
                    <div class="p-6 bg-white border-t border-gray-100">
                        {{ $categories->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>