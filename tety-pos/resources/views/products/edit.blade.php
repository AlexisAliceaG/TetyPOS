<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar: {{ $product->name }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if ($errors->any())
                <div class="mb-6 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
                    <p class="font-bold">Por favor corrige los siguientes errores:</p>
                    <ul class="mt-2 list-disc list-inside text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form method="POST" action="{{ route('products.update', $product) }}">
                    @csrf @method('PUT')
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <x-input-label for="name" value="Nombre" />
                            <x-text-input id="name" name="name" type="text" class="w-full mt-1" :value="old('name', $product->name)" required />
                        </div>

                        <div>
                            <x-input-label for="sku" value="SKU" />
                            <x-text-input id="sku" name="sku" type="text" class="w-full mt-1" :value="old('sku', $product->sku)" required />
                        </div>

                        <div>
                            <x-input-label value="Categoría" />
                            <select name="category_id" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Marca" />
                            <select name="brand_id" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                                <option value="">Sin marca</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <x-input-label value="Precio de Costo" />
                            <x-text-input name="cost_price" type="number" step="0.01" class="w-full mt-1" :value="old('cost_price', $product->cost_price)" required />
                        </div>

                        <div>
                            <x-input-label value="Precio de Venta" />
                            <x-text-input name="selling_price" type="number" step="0.01" class="w-full mt-1" :value="old('selling_price', $product->selling_price)" required />
                        </div>

                        <div>
                            <x-input-label value="Stock Actual" />
                            <x-text-input name="stock" type="number" class="w-full mt-1" :value="old('stock', $product->stock)" required />
                        </div>

                        <div>
                            <x-input-label value="Alerta Stock Bajo" />
                            <x-text-input name="alert_quantity" type="number" class="w-full mt-1" :value="old('alert_quantity', $product->alert_quantity)" required />
                        </div>
                    </div>

                    <div class="mt-6">
                        <x-input-label value="Descripción" />
                        <textarea name="description" rows="3" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="mt-6 flex justify-end gap-4 border-t pt-6">
                        <a href="{{ route('products.index') }}" class="inline-flex items-center px-4 py-2 text-sm text-gray-600 underline hover:text-gray-900">
                            Cancelar
                        </a>
                        <x-primary-button>
                            Actualizar Producto
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>