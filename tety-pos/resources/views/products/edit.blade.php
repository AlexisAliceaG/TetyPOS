<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight border-l-4 border-[#d13d7c] pl-4">
            {{ __('Editar Producto') }}: <span class="text-[#d13d7c] uppercase">{{ $product->name }}</span>
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            @if ($errors->any()) <div id="alert" class="fixed top-5 right-5 bg-red-100 text-red-700 px-6 py-4 rounded-xl shadow-lg font-bold z-50"> <div class="flex items-center mb-2"> <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/> </svg> <p class="uppercase text-sm tracking-wide">⚠️ Atención: Revisa los campos</p> </div> <ul class="list-disc list-inside text-sm font-normal"> @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach </ul> </div> @endif

            <div class="bg-white p-8 shadow-2xl sm:rounded-3xl border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-yellow-400 via-[#d13d7c] to-pink-600"></div>

                <form method="POST" action="{{ route('products.update', $product) }}">
                    @csrf 
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        
                        <div class="md:col-span-2 border-b border-gray-100 pb-2 mb-2 flex justify-between">
                            <h3 class="text-[#d13d7c] font-black uppercase text-xs tracking-widest">Identificación del Producto</h3>
                            <span class="text-[10px] bg-gray-100 text-gray-400 px-2 py-1 rounded font-bold">ID: #{{ $product->id }}</span>
                        </div>

                        <div>
                            <x-input-label for="name" value="Nombre del Producto" class="font-bold text-gray-700" />
                            <x-text-input id="name" name="name" type="text" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm text-sm sm:text-base transition" 
                                :value="old('name', $product->name)" required />
                        </div>

                        <div>
                            <x-input-label for="sku" value="SKU / Código Único" class="font-bold text-gray-700" />
                            <x-text-input id="sku" name="sku" type="text" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm text-sm sm:text-base transition uppercase bg-gray-100 text-gray-600" 
                                :value="old('sku', $product->sku)" readonly />
                        </div>

                        <div>
                            <x-input-label value="Categoría" class="font-bold text-gray-700" />
                            <select name="category_id" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm text-sm sm:text-base transition" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Marca" class="font-bold text-gray-700" />
                            <select name="brand_id" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm text-sm sm:text-base transition">
                                <option value="">Sin marca</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2 border-b border-gray-100 pb-2 mt-4 mb-2">
                            <h3 class="text-[#d13d7c] font-black uppercase text-xs tracking-widest">Precios y Stock</h3>
                        </div>

                        <div class="relative">
                            <x-input-label value="Precio de Costo" class="font-bold text-gray-700" />
                            <div class="relative mt-1">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">$</span>
                                <x-text-input name="cost_price" type="number" step="0.01" 
                                    class="block w-full pl-8 border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm" 
                                    :value="old('cost_price', $product->cost_price)" required />
                            </div>
                        </div>

                        <div class="relative">
                            <x-input-label value="Precio de Venta" class="font-bold text-gray-700" />
                            <div class="relative mt-1">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#d13d7c] font-bold">$</span>
                                <x-text-input name="selling_price" type="number" step="0.01" 
                                    class="block w-full pl-8 border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm font-black text-lg text-gray-800" 
                                    :value="old('selling_price', $product->selling_price)" required />
                            </div>
                        </div>

                        <div>
                            <x-input-label value="Stock Actual" class="font-bold text-gray-700" />
                            <x-text-input name="stock" type="number" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm" 
                                :value="old('stock', $product->stock)" required />
                        </div>

                        <div>
                            <x-input-label value="Alerta Stock Bajo" class="font-bold text-gray-700" />
                            <x-text-input name="alert_quantity" type="number" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm" 
                                :value="old('alert_quantity', $product->alert_quantity)" required />
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-input-label value="Descripción" class="font-bold text-gray-700" />
                        <textarea name="description" rows="3" 
                            class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm text-sm sm:text-base transition">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="mt-10 flex flex-col-reverse sm:flex-row justify-end gap-4 pt-6 border-t border-gray-100">
                        <a href="{{ route('products.index') }}" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-white border border-gray-300 rounded-xl font-bold text-xs text-gray-500 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition">
                            {{ __('Cancelar') }}
                        </a>
                        <button type="submit" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-10 py-3 bg-[#d13d7c] border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-widest hover:bg-[#b03368] active:scale-95 transition-all shadow-lg shadow-pink-200">
                            {{ __('Actualizar Producto') }}
                        </button>
                    </div>
                </form>
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
            }, 5000);
        }
    });
</script>
