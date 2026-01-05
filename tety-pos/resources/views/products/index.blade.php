<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
            <h2 class="font-bold text-2xl text-gray-800 leading-tight border-l-4 border-[#d13d7c] pl-4">
                {{ __('Inventario de Productos') }}
            </h2>
            <a href="{{ route('products.create') }}" class="w-full sm:w-auto text-center inline-flex justify-center items-center px-6 py-3 bg-[#d13d7c] border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-widest hover:bg-[#b03368] transform active:scale-95 transition-all shadow-lg">
                + Nuevo Producto
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
                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider">Producto</th>
                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider">Categoría / Marca</th>
                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider">Precio Venta</th>
                                <th class="px-6 py-4 text-left text-xs font-black uppercase tracking-wider">Stock Actual</th>
                                <th class="px-6 py-4 text-center text-xs font-black uppercase tracking-wider">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($products as $product)
                            <tr class="hover:bg-pink-50 transition-colors">
                                <td class="px-6 py-5 whitespace-nowrap">
                                    <div class="text-sm font-black text-gray-800 uppercase">{{ $product->name }}</div>
                                </td>
                                <td class="px-6 py-5">
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-[10px] font-bold uppercase">{{ $product->category->name }}</span>
                                    <div class="text-xs text-gray-400 mt-1 italic">{{ $product->brand->name ?? 'Sin marca' }}</div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="text-lg font-black text-[#d13d7c]">
                                        ${{ number_format($product->selling_price, 2) }}
                                    </div>
                                </td>
                                <td class="px-6 py-5">
                                    <div class="flex items-center">
                                        <div class="w-full bg-gray-200 rounded-full h-2 mr-3 max-w-[100px]">
                                            <div class="h-2 rounded-full {{ $product->stock <= $product->alert_quantity ? 'bg-red-500' : 'bg-[#82b45e]' }}" 
                                                 style="width: {{ min(($product->stock / ($product->alert_quantity > 0 ? $product->alert_quantity * 2 : 100)) * 100, 100) }}%"></div>
                                        </div>
                                        <span class="px-3 py-1 rounded-lg text-xs font-black {{ $product->stock <= $product->alert_quantity ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                            {{ $product->stock }} UDS.
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <div class="flex justify-center items-center gap-4">
                                        <a href="{{ route('products.edit', $product) }}" class="text-gray-400 hover:text-[#d13d7c] transition">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                        </a>
                                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('¿Está seguro de eliminar este producto?')">
                                            @csrf @method('DELETE')
                                            <button class="text-gray-400 hover:text-red-600 transition">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="block sm:hidden divide-y divide-gray-100">
                    @foreach($products as $product)
                    <div class="p-6 bg-white">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-black text-gray-800 uppercase leading-tight">{{ $product->name }}</h3>
                                <p class="text-xs font-bold text-[#d13d7c] mt-1">{{ $product->category->name }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-[10px] font-black {{ $product->stock <= $product->alert_quantity ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700' }}">
                                {{ $product->stock }} UDS.
                            </span>
                        </div>
                        
                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-[10px] text-gray-400 uppercase font-bold tracking-widest">Precio Venta</p>
                                <p class="text-2xl font-black text-gray-900">${{ number_format($product->selling_price, 2) }}</p>
                            </div>
                            <div class="flex gap-3">
                                <a href="{{ route('products.edit', $product) }}" class="p-3 bg-gray-100 rounded-xl text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('¿Eliminar?')">
                                    @csrf @method('DELETE')
                                    <button class="p-3 bg-red-50 rounded-xl text-red-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="p-6 bg-white border-t border-gray-100">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>