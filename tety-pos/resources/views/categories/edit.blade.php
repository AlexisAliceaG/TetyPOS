<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight border-l-4 border-[#d13d7c] pl-4">
            {{ __('Editar Categoría') }}: <span class="text-[#d13d7c] uppercase">{{ $category->name }}</span>
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 relative">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-yellow-400 via-[#d13d7c] to-pink-600"></div>

                <div class="p-8 text-gray-900">
                    <form method="POST" action="{{ route('categories.update', $category) }}">
                        @csrf
                        @method('PUT') 

                        <div class="mb-8">
                            <x-input-label for="name" :value="__('Nombre de la Categoría')" class="font-black text-gray-700 uppercase text-xs tracking-widest mb-2" />
                            
                            <x-text-input id="name" name="name" type="text" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm text-sm sm:text-base font-bold transition" 
                                :value="old('name', $category->name)" 
                                required 
                                autofocus />
                            
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            
                            <div class="mt-6 p-4 bg-pink-50 rounded-2xl border border-pink-100 flex items-start">
                                <svg class="w-5 h-5 text-[#d13d7c] mr-3 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-xs sm:text-sm text-gray-600 leading-relaxed">
                                    <span class="font-black text-[#d13d7c] uppercase italic">Información:</span> 
                                    Al modificar el nombre, el identificador único (Slug) se actualizará para mantener la coherencia en la base de datos: 
                                    <code class="block mt-2 bg-white text-[#d13d7c] px-3 py-1 rounded-lg font-mono border border-pink-200 w-fit">
                                        /{{ $category->slug }}
                                    </code>
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row items-center justify-end mt-10 gap-4 border-t border-gray-100 pt-6">
                            <a href="{{ route('categories.index') }}" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-white border border-gray-300 rounded-xl font-bold text-xs text-gray-500 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                                {{ __('Cancelar') }}
                            </a>
                            
                            <button type="submit" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-10 py-3 bg-[#d13d7c] border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-widest hover:bg-[#b03368] active:scale-95 transition-all shadow-lg shadow-pink-100">
                                {{ __('Actualizar Categoría') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <p class="mt-6 text-center text-gray-400 text-xs uppercase tracking-tighter">
                Última actualización: {{ $category->updated_at->diffForHumans() }}
            </p>
        </div>
    </div>
</x-app-layout>