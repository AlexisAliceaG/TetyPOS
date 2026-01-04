<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">📊 Reporte de Ventas</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                
                <form method="GET" class="mb-8 grid grid-cols-1 md:grid-cols-3 gap-4 items-end bg-gray-50 p-4 rounded-xl border border-gray-200">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Desde</label>
                        <input type="date" name="start_date" value="{{ $start_date }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Hasta</label>
                        <input type="date" name="end_date" value="{{ $end_date }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    </div>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2.5 rounded-md font-bold transition">
                        🔍 FILTRAR RESULTADOS
                    </button>
                </form>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
                    <div class="bg-blue-50 border-b-4 border-blue-500 p-4 rounded shadow-sm">
                        <p class="text-xs font-bold text-blue-600 uppercase">Ventas</p>
                        <p class="text-2xl font-black text-blue-900">{{ $summary['count'] }}</p>
                    </div>
                    <div class="bg-green-50 border-b-4 border-green-500 p-4 rounded shadow-sm">
                        <p class="text-xs font-bold text-green-600 uppercase">Ingreso Total</p>
                        <p class="text-2xl font-black text-green-900">${{ number_format($summary['total_revenue'], 2) }}</p>
                    </div>
                    <div class="bg-gray-50 border-b-4 border-gray-500 p-4 rounded shadow-sm">
                        <p class="text-xs font-bold text-gray-600 uppercase">Efectivo Recibido</p>
                        <p class="text-2xl font-black text-gray-900">${{ number_format($summary['total_cash'], 2) }}</p>
                    </div>
                    <div class="bg-red-50 border-b-4 border-red-500 p-4 rounded shadow-sm">
                        <p class="text-xs font-bold text-red-600 uppercase">Cambio Entregado</p>
                        <p class="text-2xl font-black text-red-900">${{ number_format($summary['total_change'], 2) }}</p>
                    </div>
                </div>

                <div class="overflow-hidden border border-gray-200 rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-800">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Folio</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Hora</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Recibido</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Cambio</th>
                                <th class="px-6 py-3 text-right text-xs font-medium text-gray-300 uppercase tracking-wider">Total</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($sales as $sale)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-indigo-600">#{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $sale->created_at->format('H:i:s') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${{ number_format($sale->cash_received, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${{ number_format($sale->change_given, 2) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-black text-gray-900">${{ number_format($sale->total, 2) }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-10 text-center text-gray-500 italic">No se encontraron ventas en este periodo.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6 text-right no-print">
                    <button onclick="window.print()" class="bg-gray-700 text-white px-6 py-2 rounded-lg font-bold hover:bg-gray-800 transition">
                        🖨️ IMPRIMIR REPORTE
                    </button>
                </div>

            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print, form, nav, header { display: none !important; }
            .py-12 { padding-top: 0 !important; padding-bottom: 0 !important; }
            .shadow-sm { shadow: none !important; border: none !important; }
        }
    </style>
</x-app-layout>