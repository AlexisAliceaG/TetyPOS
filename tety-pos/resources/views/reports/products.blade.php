<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight border-l-4 border-[#d13d7c] pl-4">
            {{ __('📦 Ranking de Productos Vendidos') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 p-6 sm:p-8 relative">
                
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#d13d7c] via-pink-400 to-[#d13d7c]"></div>

                <form method="GET" class="no-print mb-10 flex flex-wrap gap-6 items-end bg-pink-50/40 p-6 rounded-2xl border border-pink-100">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs font-black text-[#d13d7c] uppercase tracking-widest mb-2">Desde</label>
                        <input type="date" name="start_date" value="{{ $start_date }}" 
                            class="mt-1 block w-full border-pink-200 rounded-xl shadow-sm focus:ring-[#d13d7c] focus:border-[#d13d7c] font-bold text-gray-600 transition bg-white">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs font-black text-[#d13d7c] uppercase tracking-widest mb-2">Hasta</label>
                        <input type="date" name="end_date" value="{{ $end_date }}" 
                            class="mt-1 block w-full border-pink-200 rounded-xl shadow-sm focus:ring-[#d13d7c] focus:border-[#d13d7c] font-bold text-gray-600 transition bg-white">
                    </div>
                    <button type="submit" class="w-full sm:w-auto bg-[#d13d7c] hover:bg-[#b03368] text-white px-8 py-3 rounded-xl font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-pink-200 active:scale-95 flex items-center justify-center gap-2">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        Actualizar Reporte
                    </button>
                </form>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    <div class="bg-gradient-to-br from-[#d13d7c] to-[#b03368] rounded-3xl p-8 shadow-xl shadow-pink-200 relative overflow-hidden group">
                        <div class="absolute -right-4 -bottom-4 opacity-20 group-hover:scale-110 transition-transform text-white">
                            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path></svg>
                        </div>
                        <span class="text-pink-100 text-xs font-black uppercase tracking-[0.3em]">Unidades Vendidas</span>
                        <p class="text-5xl font-black text-white mt-2 tracking-tighter">
                            {{ number_format($totalItems) }} <span class="text-lg font-bold text-pink-200">PZAS</span>
                        </p>
                    </div>

                    <div class="bg-white border-4 border-[#d13d7c] rounded-3xl p-8 shadow-xl relative overflow-hidden group">
                        <div class="absolute -right-4 -bottom-4 opacity-10 group-hover:scale-110 transition-transform text-[#d13d7c]">
                            <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path><path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd"></path></svg>
                        </div>
                        <span class="text-[#d13d7c] text-xs font-black uppercase tracking-[0.3em]">Monto Total Generado</span>
                        <p class="text-5xl font-black text-gray-800 mt-2 tracking-tighter">
                            ${{ number_format($totalRevenue, 2) }}
                        </p>
                    </div>
                </div>

                <div class="bg-white border border-pink-100 rounded-3xl overflow-hidden shadow-sm">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-pink-50/50 border-b border-pink-100">
                                <th class="px-6 py-5 text-left text-[10px] font-black text-[#d13d7c] uppercase tracking-widest">Detalle del Producto</th>
                                <th class="px-6 py-5 text-center text-[10px] font-black text-[#d13d7c] uppercase tracking-widest">Volumen</th>
                                <th class="px-6 py-5 text-right text-[10px] font-black text-[#d13d7c] uppercase tracking-widest">Acumulado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-pink-50">
                            @forelse($productSales as $index => $item)
                            <tr class="hover:bg-pink-50/30 transition-colors group">
                                <td class="px-6 py-5">
                                    <div class="flex items-center">
                                        <div class="w-8 h-8 rounded-lg bg-pink-100 flex items-center justify-center mr-4 text-xs font-black text-[#d13d7c] group-hover:bg-[#d13d7c] group-hover:text-white transition-all">
                                            {{ $index + 1 }}
                                        </div>
                                        <div>
                                            <div class="text-sm font-black text-gray-800 uppercase tracking-tight">{{ $item->product->name }}</div>
                                            <div class="text-[10px] font-mono text-pink-400 tracking-tighter uppercase italic">Ref: {{ $item->product->sku }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-5 text-center">
                                    <span class="inline-flex items-center px-4 py-1.5 rounded-xl text-sm font-black bg-white border-2 border-pink-100 text-[#d13d7c] shadow-sm group-hover:border-[#d13d7c] transition-colors">
                                        {{ $item->total_quantity }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-base font-black text-gray-800">
                                        ${{ number_format($item->total_amount, 2) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="p-4 bg-pink-50 rounded-full mb-4">
                                            <svg class="w-12 h-12 text-pink-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                                        </div>
                                        <p class="text-[10px] font-black text-pink-300 uppercase tracking-[0.2em]">Sin registros comerciales</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-12 no-print text-center">
                    <button onclick="window.print()" class="group inline-flex items-center gap-3 bg-white border-2 border-[#d13d7c] text-[#d13d7c] px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-[0.2em] hover:bg-[#d13d7c] hover:text-white transition-all active:scale-95 shadow-lg shadow-pink-100">
                        <svg class="w-5 h-5 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Imprimir Reporte
                    </button>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print { display: none !important; }
            .shadow-2xl, .shadow-xl, .shadow-sm { box-shadow: none !important; }
            .bg-gray-50 { background-color: white !important; }
            .py-6, .py-12 { padding: 0 !important; }
            .rounded-3xl, .rounded-2xl { border-radius: 0 !important; }
            .border, .border-4, .border-2 { border: 1px solid #ffdeeb !important; }
            th { background-color: #fff0f6 !important; color: #d13d7c !important; -webkit-print-color-adjust: exact; }
            .bg-gradient-to-br { background: #d13d7c !important; color: white !important; -webkit-print-color-adjust: exact; }
            .text-[#d13d7c] { color: #d13d7c !important; -webkit-print-color-adjust: exact; }
        }
    </style>
</x-app-layout>