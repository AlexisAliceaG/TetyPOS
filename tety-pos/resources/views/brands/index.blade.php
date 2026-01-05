<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight border-l-4 border-[#d13d7c] pl-4">
                {{ __('Listado de Marcas') }}
            </h2>
            <a href="{{ route('brands.create') }}" class="w-full sm:w-auto text-center inline-flex justify-center items-center px-6 py-3 bg-[#d13d7c] border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-widest hover:bg-[#b03368] transform active:scale-95 transition-all shadow-lg">
                + Nueva Marca
            </a>
        </div>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-6 bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg font-bold flex items-center animate-fade-in" role="alert">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-500 text-white px-6 py-4 rounded-xl shadow-lg font-bold flex items-center animate-fade-in" role="alert">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                
                <div class="hidden sm:block">
                    <table class="min-w-full table-auto">
                        <thead>
                            <tr class="bg-[#d13d7c] text-white">
                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider">Nombre de Marca</th>
                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider">Total Productos</th>
                                <th class="px-6 py-4 text-center text-xs font-black uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($brands as $brand)
                                <tr class="hover:bg-pink-50 transition-colors">
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="h-8 w-8 rounded-lg bg-pink-100 text-[#d13d7c] flex items-center justify-center font-black mr-3 uppercase">
                                                {{ substr($brand->name, 0, 1) }}
                                            </div>
                                            <span class="text-sm font-black text-gray-800 uppercase tracking-tight">{{ $brand->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-5 whitespace-nowrap">
                                        <span class="px-3 py-1 bg-gray-100 text-gray-600 rounded-lg text-xs font-bold border border-gray-200">
                                            <i class="fas fa-box mr-1"></i> {{ $brand->products_count }} productos
                                        </span>
                                    </td>
                                    <td class="px-6 py-5 text-center">
                                        <div class="flex justify-center items-center gap-4">
                                            <a href="{{ route('brands.edit', $brand) }}" class="p-2 text-gray-400 hover:text-[#d13d7c] transition hover:bg-white hover:shadow-sm rounded-lg">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                            </a>
                                            <form action="{{ route('brands.destroy', $brand) }}" method="POST" onsubmit="return confirm('¿Eliminar esta marca?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="p-2 text-gray-400 hover:text-red-600 transition hover:bg-white hover:shadow-sm rounded-lg">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-10 text-center text-gray-400 italic">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 mb-2 opacity-20" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" /></svg>
                                            No hay marcas registradas.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="block sm:hidden divide-y divide-gray-100">
                    @forelse ($brands as $brand)
                        <div class="p-6 bg-white active:bg-pink-50 transition">
                            <div class="flex justify-between items-center mb-4">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-xl bg-pink-100 text-[#d13d7c] flex items-center justify-center font-black mr-3 uppercase">
                                        {{ substr($brand->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <h3 class="text-base font-black text-gray-800 uppercase leading-tight">{{ $brand->name }}</h3>
                                        <p class="text-[10px] font-bold text-gray-400 uppercase tracking-widest mt-1">{{ $brand->products_count }} productos asociados</p>
                                    </div>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <a href="{{ route('brands.edit', $brand) }}" class="flex-1 flex justify-center items-center py-3 bg-gray-50 text-gray-500 rounded-xl border border-gray-100 font-bold text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                    Editar
                                </a>
                                <form action="{{ route('brands.destroy', $brand) }}" method="POST" class="flex-1" onsubmit="return confirm('¿Eliminar?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="w-full flex justify-center items-center py-3 bg-red-50 text-red-500 rounded-xl border border-red-100 font-bold text-sm">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        Borrar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-12 text-center text-gray-400 italic">No hay marcas registradas.</div>
                    @endforelse
                </div>

                <div class="p-6 bg-white border-t border-gray-100">
                    {{ $brands->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>