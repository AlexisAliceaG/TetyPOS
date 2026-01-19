<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight border-l-4 border-[#d13d7c] pl-4">
            {{ __('Editar Marca') }}: <span class="text-[#d13d7c] uppercase">{{ $brand->name }}</span>
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-2xl sm:rounded-3xl border border-gray-100 relative">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-gray-200 via-[#d13d7c] to-gray-200"></div>

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
                    <form method="POST" action="{{ route('brands.update', $brand) }}">
                        @csrf
                        @method('PUT')

                        <div class="flex flex-col items-center mb-10">
                            <div class="h-20 w-20 rounded-2xl bg-pink-100 text-[#d13d7c] flex items-center justify-center text-4xl font-black shadow-inner border border-pink-200 uppercase mb-4">
                                {{ substr($brand->name, 0, 1) }}
                            </div>
                            <p class="text-xs font-black text-gray-400 uppercase tracking-widest">Identificador de Marca</p>
                        </div>

                        <div class="mb-8">
                            <x-input-label for="name" :value="__('Nombre de la Marca')" class="font-black text-gray-700 uppercase text-xs tracking-widest mb-2" />
                            
                            <x-text-input id="name" name="name" type="text" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm text-sm sm:text-base font-bold transition uppercase" 
                                :value="old('name', $brand->name)" 
                                required 
                                autofocus />
                            
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            
                            <div class="mt-6 p-4 bg-gray-50 rounded-2xl border border-gray-100 flex items-center gap-3">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-xs text-gray-500 italic">
                                    Los cambios se reflejarán inmediatamente en todos los productos asociados a esta marca.
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-col-reverse sm:flex-row items-center justify-end mt-10 gap-4 border-t border-gray-100 pt-8">
                            <a href="{{ route('brands.index') }}" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-white border border-gray-300 rounded-xl font-bold text-xs text-gray-500 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                                {{ __('Cancelar') }}
                            </a>
                            
                            <button type="submit" 
                                class="w-full sm:w-auto inline-flex justify-center items-center px-10 py-3 bg-[#d13d7c] border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-widest hover:bg-[#b03368] active:scale-95 transition-all shadow-lg shadow-pink-100">
                                {{ __('Actualizar Marca') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <p class="mt-6 text-center text-gray-400 text-[10px] uppercase font-bold tracking-tighter">
                Registrado el {{ $brand->created_at->format('d/m/Y') }}
            </p>
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
