<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">📦 Productos Vendidos (Ranking)</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="GET" class="mb-8 flex flex-wrap gap-4 items-end bg-blue-50 p-4 rounded-xl no-print">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs font-bold text-blue-700 uppercase">Desde</label>
                        <input type="date" name="start_date" value="{{ $start_date }}" class="mt-1 block w-full border-blue-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs font-bold text-blue-700 uppercase">Hasta</label>
                        <input type="date" name="end_date" value="{{ $end_date }}" class="mt-1 block w-full border-blue-200 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-bold transition shadow-lg">
                        ACTUALIZAR REPORTE
                    </button>
                </form>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div class="bg-gray-900 text-white p-6 rounded-2xl shadow-xl">
                        <span class="text-gray-400 text-sm font-bold uppercase">Total Artículos Vendidos</span>
                        <p class="text-4xl font-black text-blue-400">{{ number_format($totalItems) }} <small class="text-lg text-white">pzas</small></p>
                    </div>
                    <div class="bg-gray-900 text-white p-6 rounded-2xl shadow-xl">
                        <span class="text-gray-400 text-sm font-bold uppercase">Monto Total en Productos</span>
                        <p class="text-4xl font-black text-green-400">${{ number_format($totalRevenue, 2) }}</p>
                    </div>
                </div>

                <div class="overflow-hidden border border-gray-200 rounded-xl">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Producto</th>
                                <th class="px-6 py-4 text-center text-xs font-bold text-gray-500 uppercase tracking-wider">Cantidad Vendida</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Total Generado</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($productSales as $item)
                            <tr class="hover:bg-blue-50 transition">
                                <td class="px-6 py-4">
                                    <div class="text-sm font-bold text-gray-900">{{ $item->product->name }}</div>
                                    <div class="text-xs text-gray-500">SKU: {{ $item->product->sku }}</div>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-black bg-blue-100 text-blue-800">
                                        {{ $item->total_quantity }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right text-sm font-bold text-gray-900">
                                    ${{ number_format($item->total_amount, 2) }}
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-gray-400 italic">No hubo movimiento de productos en estas fechas.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 no-print text-center">
                    <button onclick="window.print()" class="border-2 border-gray-800 text-gray-800 px-8 py-2 rounded-lg font-bold hover:bg-gray-800 hover:text-white transition">
                        🖨️ IMPRIMIR LISTADO
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .py-12 { padding: 0; }
        }
    </style>
</x-app-layout>