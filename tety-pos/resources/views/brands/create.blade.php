<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight border-l-4 border-[#d13d7c] pl-4">
            {{ __('Crear Nueva Marca') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 relative">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#d13d7c] to-[#f472b6]"></div>

                <div class="p-8 text-gray-900">
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
                    <form method="POST" action="{{ route('brands.store') }}">
                        @csrf

                        <div class="flex flex-col items-center mb-10">
                            <div class="h-24 w-24 rounded-3xl bg-pink-50 text-[#d13d7c] flex items-center justify-center shadow-inner border-2 border-dashed border-pink-200 mb-4 group">
                                <svg class="w-10 h-10 opacity-40 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                            </div>
                            <h3 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em]">Nueva Identidad de Marca</h3>
                        </div>

                        <div class="mb-8">
                            <x-input-label for="name" :value="__('Nombre de la Marca')" class="font-black text-gray-700 uppercase text-xs tracking-widest mb-2" />
                            
                            <x-text-input id="name" name="name" type="text" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm text-sm sm:text-base font-bold transition placeholder:text-gray-300 uppercase" 
                                :value="old('name')" 
                                required 
                                autofocus 
                                placeholder="Ej. Nike, Samsung, Stabilo..." />
                            
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            
                            <div class="mt-6 flex items-start gap-3 p-4 bg-blue-50 rounded-2xl border border-blue-100">
                                <svg class="w-5 h-5 text-blue-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-xs text-blue-700 leading-relaxed">
                                    Utiliza nombres claros y oficiales. Las marcas ayudan a tus clientes a filtrar productos y a ti a generar reportes de inventario más precisos.
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row items-center justify-end mt-10 gap-4 border-t border-gray-50 pt-8">
                            <a href="{{ route('brands.index') }}" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-white border border-gray-300 rounded-xl font-bold text-xs text-gray-500 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                                {{ __('Cancelar') }}
                            </a>
                            
                            <button type="submit" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-10 py-3 bg-[#d13d7c] border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-widest hover:bg-[#b03368] active:scale-95 transition-all shadow-lg shadow-pink-100">
                                {{ __('Guardar Marca') }}
                            </button>
                        </div>
                    </form>
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
