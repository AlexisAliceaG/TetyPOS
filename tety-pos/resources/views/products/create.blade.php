<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Nuevo Producto') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 shadow sm:rounded-lg">
                <form method="POST" action="{{ route('products.store') }}">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="name" value="Nombre" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="sku" value="SKU / Código" />
                            <x-text-input id="sku" name="sku" type="text" class="mt-1 block w-full" required />
                        </div>
                        <div>
                            <x-input-label for="category_id" value="Categoría" />
                            <select name="category_id" class="w-full border-gray-300 rounded-md shadow-sm" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="brand_id" value="Marca" />
                            <select name="brand_id" class="w-full border-gray-300 rounded-md shadow-sm">
                                <option value="">Sin marca</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-input-label for="cost_price" value="Precio Costo" />
                            <x-text-input name="cost_price" type="number" step="0.01" class="w-full" required />
                        </div>
                        <div>
                            <x-input-label for="selling_price" value="Precio Venta" />
                            <x-text-input name="selling_price" type="number" step="0.01" class="w-full" required />
                        </div>
                        <div>
                            <x-input-label for="stock" value="Stock Inicial" />
                            <x-text-input name="stock" type="number" class="w-full" required />
                        </div>
                        <div>
                            <x-input-label for="alert_quantity" value="Alerta Stock Bajo" />
                            <x-text-input name="alert_quantity" type="number" class="w-full" value="5" required />
                        </div>
                    </div>
                    <div class="mt-4">
                        <x-input-label for="description" value="Descripción (Opcional)" />
                        <textarea name="description" class="w-full border-gray-300 rounded-md shadow-sm"></textarea>
                    </div>
                    <div class="mt-6 flex justify-end">
                        <x-primary-button>Guardar Producto</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>