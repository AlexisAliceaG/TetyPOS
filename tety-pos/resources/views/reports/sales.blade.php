<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight border-l-4 border-[#d13d7c] pl-4">
            {{ __('📊 Reporte de Ventas') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 p-6 sm:p-8 relative">
                
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#d13d7c] via-pink-400 to-[#d13d7c]"></div>

                <form method="GET" class="no-print mb-10 grid grid-cols-1 md:grid-cols-3 gap-6 items-end bg-pink-50/40 p-6 rounded-2xl border border-pink-100">
                    <div>
                        <label class="block text-xs font-black text-[#d13d7c] uppercase tracking-widest mb-2">Fecha Inicial</label>
                        <input type="date" name="start_date" value="{{ $start_date }}" 
                            class="block w-full border-pink-200 rounded-xl shadow-sm focus:ring-[#d13d7c] focus:border-[#d13d7c] font-bold text-gray-600 transition">
                    </div>
                    <div>
                        <label class="block text-xs font-black text-[#d13d7c] uppercase tracking-widest mb-2">Fecha Final</label>
                        <input type="date" name="end_date" value="{{ $end_date }}" 
                            class="block w-full border-pink-200 rounded-xl shadow-sm focus:ring-[#d13d7c] focus:border-[#d13d7c] font-bold text-gray-600 transition">
                    </div>
                    <button type="submit" class="w-full bg-[#d13d7c] hover:bg-[#b03368] text-white px-6 py-3 rounded-xl font-black text-xs uppercase tracking-widest transition-all shadow-lg shadow-pink-200 active:scale-95 flex justify-center items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        Filtrar Resultados
                    </button>
                </form>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                    <div class="bg-white border-2 border-pink-100 p-6 rounded-3xl shadow-sm flex flex-col items-center text-center group hover:border-[#d13d7c] transition-all">
                        <div class="bg-blue-50 text-blue-500 p-3 rounded-2xl mb-3 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                        </div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Total Ventas</p>
                        <p class="text-3xl font-black text-gray-800 tracking-tighter">{{ $summary['count'] }}</p>
                    </div>

                    <div class="bg-[#d13d7c] p-6 rounded-3xl shadow-xl shadow-pink-200 flex flex-col items-center text-center relative overflow-hidden group">
                        <div class="bg-white/20 text-white p-3 rounded-2xl mb-3 z-10">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                        <p class="text-[10px] font-black text-pink-100 uppercase tracking-widest z-10">Ingreso Neto</p>
                        <p class="text-3xl font-black text-white tracking-tighter z-10">${{ number_format($summary['total_revenue'], 2) }}</p>
                        <div class="absolute -right-2 -bottom-2 text-white/10 group-hover:scale-125 transition-transform">
                            <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z"></path></svg>
                        </div>
                    </div>

                    <div class="bg-white border-2 border-pink-100 p-6 rounded-3xl shadow-sm flex flex-col items-center text-center group hover:border-[#d13d7c] transition-all">
                        <div class="bg-emerald-50 text-emerald-500 p-3 rounded-2xl mb-3 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Efectivo</p>
                        <p class="text-3xl font-black text-gray-800 tracking-tighter">${{ number_format($summary['total_cash'], 2) }}</p>
                    </div>

                    <div class="bg-white border-2 border-pink-100 p-6 rounded-3xl shadow-sm flex flex-col items-center text-center group hover:border-[#d13d7c] transition-all">
                        <div class="bg-orange-50 text-orange-500 p-3 rounded-2xl mb-3 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Cambio</p>
                        <p class="text-3xl font-black text-gray-800 tracking-tighter">${{ number_format($summary['total_change'], 2) }}</p>
                    </div>
                </div>

                <div class="bg-white border border-pink-100 rounded-3xl overflow-hidden shadow-sm">
                    <table class="min-w-full">
                        <thead>
                            <tr class="bg-pink-50/50">
                                <th class="px-6 py-4 text-left text-[10px] font-black text-[#d13d7c] uppercase tracking-widest border-b border-pink-100">Folio</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-[#d13d7c] uppercase tracking-widest italic border-b border-pink-100">Horario</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-[#d13d7c] uppercase tracking-widest border-b border-pink-100">Recibido</th>
                                <th class="px-6 py-4 text-left text-[10px] font-black text-[#d13d7c] uppercase tracking-widest border-b border-pink-100">Cambio</th>
                                <th class="px-6 py-4 text-right text-[10px] font-black text-[#d13d7c] uppercase tracking-widest border-b border-pink-100">Total Cobrado</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-pink-50 uppercase">
                            @forelse($sales as $sale)
                            <tr class="hover:bg-pink-50/30 transition-colors group">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-black text-[#d13d7c]">
                                    #{{ str_pad($sale->id, 5, '0', STR_PAD_LEFT) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-xs text-gray-400 font-bold italic">
                                    {{ $sale->created_at->format('H:i:s A') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-bold">
                                    ${{ number_format($sale->cash_received, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600 font-bold">
                                    ${{ number_format($sale->change_given, 2) }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right">
                                    <span class="bg-white text-gray-800 px-3 py-1 rounded-lg font-black text-sm border-2 border-pink-100 shadow-sm group-hover:border-[#d13d7c] transition-all">
                                        ${{ number_format($sale->total, 2) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="p-4 bg-pink-50 rounded-full mb-4">
                                            <svg class="w-12 h-12 text-pink-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                        </div>
                                        <p class="text-pink-300 font-black text-xs uppercase tracking-widest italic">No se encontraron registros de ventas</p>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-12 text-right no-print">
                    <button onclick="window.print()" class="group inline-flex items-center gap-3 bg-white border-2 border-[#d13d7c] text-[#d13d7c] px-10 py-4 rounded-2xl font-black text-xs uppercase tracking-widest hover:bg-[#d13d7c] hover:text-white transition-all shadow-lg shadow-pink-100 active:scale-95">
                        <svg class="w-5 h-5 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                        Imprimir Reporte Físico
                    </button>
                </div>

            </div>
        </div>
    </div>

    <style>
        @media print {
            .no-print, form, nav, header { display: none !important; }
            .py-6, .py-12 { padding-top: 0 !important; padding-bottom: 0 !important; }
            .bg-gray-50 { background-color: white !important; }
            .shadow-2xl, .shadow-xl, .shadow-md, .shadow-sm { box-shadow: none !important; }
            .rounded-3xl { border-radius: 0 !important; }
            table { border-collapse: collapse !important; width: 100% !important; }
            th { background-color: #fff0f6 !important; color: #d13d7c !important; -webkit-print-color-adjust: exact; }
            .bg-[#d13d7c] { background-color: #d13d7c !important; color: white !important; -webkit-print-color-adjust: exact; }
            .border, .border-2 { border: 1px solid #ffdeeb !important; }
            body { font-size: 10pt !important; }
        }
    </style>
</x-app-layout>