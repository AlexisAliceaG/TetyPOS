<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 leading-tight border-l-4 border-[#d13d7c] pl-4">
            {{ __('Nuevo Producto') }}
        </h2>
    </x-slot>

    <div class="py-6 sm:py-12 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white p-8 shadow-2xl sm:rounded-3xl border border-gray-100 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-[#d13d7c] to-[#b03368]"></div>

                <form method="POST" action="{{ route('products.store') }}">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">
                        
                        <div class="md:col-span-2 border-b border-gray-100 pb-2 mb-2">
                            <h3 class="text-[#d13d7c] font-black uppercase text-xs tracking-widest">Información General</h3>
                        </div>

                        <div>
                            <x-input-label for="name" value="Nombre del Producto" class="font-bold text-gray-700" />
                            <x-text-input id="name" name="name" type="text" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm text-sm sm:text-base transition" 
                                placeholder="Ej: Laptop Pro 14" required />
                        </div>

                        <div>
                            <x-input-label for="sku" value="SKU / Código Único" class="font-bold text-gray-700" />
                            <x-text-input id="sku" name="sku" type="text" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm text-sm sm:text-base transition uppercase" 
                                placeholder="COD-001" required />
                        </div>

                        <div>
                            <x-input-label for="category_id" value="Categoría" class="font-bold text-gray-700" />
                            <select name="category_id" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm text-sm sm:text-base transition" required>
                                <option value="" disabled selected>Selecciona una categoría</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label for="brand_id" value="Marca" class="font-bold text-gray-700" />
                            <select name="brand_id" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm text-sm sm:text-base transition">
                                <option value="">Sin marca</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2 border-b border-gray-100 pb-2 mt-4 mb-2">
                            <h3 class="text-[#d13d7c] font-black uppercase text-xs tracking-widest">Precios y Existencias</h3>
                        </div>

                        <div class="relative">
                            <x-input-label for="cost_price" value="Precio Costo" class="font-bold text-gray-700" />
                            <div class="relative mt-1">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold">$</span>
                                <x-text-input name="cost_price" type="number" step="0.01" 
                                    class="block w-full pl-8 border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm" required />
                            </div>
                        </div>

                        <div class="relative">
                            <x-input-label for="selling_price" value="Precio Venta" class="font-bold text-gray-700" />
                            <div class="relative mt-1">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[#d13d7c] font-bold">$</span>
                                <x-text-input name="selling_price" type="number" step="0.01" 
                                    class="block w-full pl-8 border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm font-bold text-lg text-gray-800" required />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="stock" value="Stock Inicial" class="font-bold text-gray-700" />
                            <x-text-input name="stock" type="number" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm" required />
                        </div>

                        <div>
                            <x-input-label for="alert_quantity" value="Alerta Stock Bajo" class="font-bold text-gray-700" />
                            <x-text-input name="alert_quantity" type="number" 
                                class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm" value="5" required />
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-input-label for="description" value="Descripción (Opcional)" class="font-bold text-gray-700" />
                        <textarea name="description" rows="3" 
                            class="mt-1 block w-full border-gray-200 focus:border-[#d13d7c] focus:ring-[#d13d7c] rounded-xl shadow-sm text-sm sm:text-base transition" 
                            placeholder="Detalles adicionales del producto..."></textarea>
                    </div>

                    <div class="mt-10 flex flex-col-reverse sm:flex-row justify-end gap-4">
                        <a href="{{ route('products.index') }}" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-6 py-3 bg-white border border-gray-300 rounded-xl font-bold text-xs text-gray-500 uppercase tracking-widest shadow-sm hover:bg-gray-50 transition ease-in-out duration-150">
                            {{ __('Cancelar') }}
                        </a>
                        <button type="submit" 
                            class="w-full sm:w-auto inline-flex justify-center items-center px-10 py-3 bg-[#d13d7c] border border-transparent rounded-xl font-black text-xs text-white uppercase tracking-widest hover:bg-[#b03368] active:scale-95 transition-all shadow-lg shadow-pink-200">
                            {{ __('Guardar Producto') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>