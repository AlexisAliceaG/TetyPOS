<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight border-l-4 border-[#d13d7c] pl-4">
            {{ __('Crear Nueva Categoría') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 relative">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#d13d7c] to-[#f472b6]"></div>

                <div class="p-8 text-gray-900">
                    <form method="POST" action="{{ route('categories.store') }}">
                        @csrf

                        <div class="mb-8">
                            <x-input-label for="name" :value="__('Nombre de la Categoría')" class="font-black text-gray-700 uppercase text-xs tracking-widest mb-2" />
                            
                            <x-text-input id="name" name="name" type="text" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm text-sm sm:text-base font-bold transition placeholder:text-gray-300" 
                                :value="old('name')" 
                                required 
                                autofocus 
                                placeholder="Ej. Cuadernos, Bolígrafos, Papel..." />
                            
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            
                            <div class="mt-6 p-4 bg-gray-50 rounded-2xl border border-dashed border-gray-200 flex items-center gap-3">
                                <div class="bg-white p-2 rounded-lg shadow-sm">
                                    <svg class="w-5 h-5 text-[#d13d7c]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                    </svg>
                                </div>
                                <p class="text-xs sm:text-sm text-gray-500 leading-relaxed italic">
                                    El sistema generará automáticamente una <span class="text-[#d13d7c] font-bold">URL amigable (slug)</span> basada en este nombre para mejorar la organización.
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row items-center justify-end mt-10 gap-4 border-t border-gray-50 pt-8">
                            <a href="{{ route('categories.index') }}" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-white border border-gray-300 rounded-xl font-bold text-xs text-gray-500 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                                {{ __('Cancelar') }}
                            </a>
                            
                            <button type="submit" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-10 py-3 bg-[#d13d7c] border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-widest hover:bg-[#b03368] active:scale-95 transition-all shadow-lg shadow-pink-100">
                                {{ __('Guardar Categoría') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="mt-8 flex justify-center opacity-30">
                <div class="flex items-center gap-2 grayscale">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-6 w-auto object-contain">
                    <span class="text-xs font-black uppercase tracking-tighter">Gestión de Inventario</span>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>