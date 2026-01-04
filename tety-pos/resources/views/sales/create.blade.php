<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Punto de Venta</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-600 text-white rounded-lg shadow-lg font-bold">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-4 bg-red-600 text-white rounded-lg shadow font-bold">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('sales.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                    
                    <div class="lg:col-span-2 space-y-4">
                        <div class="bg-white p-4 shadow sm:rounded-lg border-t-4 border-indigo-500">
                            <x-input-label value="Buscar Producto por Nombre" />
                            <div class="flex gap-2 mt-1">
                                <select id="product_selector" class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
                                    <option value="">Seleccione un producto...</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" 
                                                data-price="{{ $product->selling_price }}" 
                                                data-stock="{{ $product->stock }}">
                                            {{ $product->name }} (SKU: {{ $product->sku }}) - ${{ number_format($product->selling_price, 2) }}
                                        </option>
                                    @endforeach
                                </select>
                                <button type="button" onclick="addProductRow()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-2 rounded-md font-black transition">
                                    + AÑADIR
                                </button>
                            </div>
                        </div>

                        <div class="bg-white shadow sm:rounded-lg overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-800 text-white">
                                    <tr>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase">Producto</th>
                                        <th class="px-4 py-3 text-center text-xs font-bold uppercase w-24">Cant.</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase">Precio Unit.</th>
                                        <th class="px-4 py-3 text-left text-xs font-bold uppercase">Subtotal</th>
                                        <th class="px-4 py-3 w-10"></th>
                                    </tr>
                                </thead>
                                <tbody id="sale-items-table" class="divide-y divide-gray-200 bg-white">
                                    </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-gray-900 p-6 shadow-xl sm:rounded-lg text-white sticky top-6">
                        <h3 class="text-lg font-bold mb-6 text-indigo-400 border-b border-gray-700 pb-2 uppercase tracking-widest">Cobro</h3>
                        
                        <div class="space-y-6">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-400 font-bold uppercase">Total a Pagar:</span>
                                <span class="text-4xl font-black text-white">$<span id="total-display">0.00</span></span>
                            </div>
                            <input type="hidden" name="total" id="total-hidden" value="0">

                            <div>
                                <x-input-label value="EFECTIVO RECIBIDO" class="text-gray-400 text-xs font-bold mb-1" />
                                <div class="relative">
                                    <span class="absolute left-3 top-2 text-2xl font-bold text-gray-500">$</span>
                                    <input type="number" name="cash_received" id="cash_received" step="0.01" 
                                           class="w-full bg-gray-800 border-gray-600 text-white text-3xl font-bold rounded-md pl-8 focus:ring-green-500 focus:border-green-500" 
                                           placeholder="0.00" required>
                                </div>
                            </div>

                            <div class="flex justify-between items-center bg-gray-800 p-3 rounded-lg border border-gray-700">
                                <span class="text-green-400 font-bold uppercase text-sm">Su Cambio:</span>
                                <span class="text-2xl font-black text-green-400">$<span id="change-display">0.00</span></span>
                                <input type="hidden" name="change_given" id="change-hidden" value="0">
                            </div>

                            <x-primary-button class="w-full py-5 justify-center bg-green-600 hover:bg-green-700 text-xl shadow-lg transform active:scale-95 transition">
                                FINALIZAR VENTA
                            </x-primary-button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        function addProductRow() {
            const select = document.getElementById('product_selector');
            const productId = select.value;
            const option = select.options[select.selectedIndex];
            
            if (!productId) return;

            // Obtenemos selling_price desde el atributo data
            const price = parseFloat(option.getAttribute('data-price')) || 0;
            const stock = parseInt(option.getAttribute('data-stock')) || 0;
            const name = option.text.split(' (SKU:')[0];

            if (document.getElementById(`row-${productId}`)) {
                alert("Este producto ya está en la lista.");
                return;
            }

            const tr = document.createElement('tr');
            tr.id = `row-${productId}`;
            tr.className = "hover:bg-gray-50 transition";
            tr.innerHTML = `
                <td class="px-4 py-4 text-sm font-bold text-gray-800">
                    ${name}
                    <input type="hidden" name="items[${productId}][product_id]" value="${productId}">
                </td>
                <td class="px-4 py-4 text-center">
                    <input type="number" name="items[${productId}][quantity]" value="1" min="1" max="${stock}" 
                        oninput="updateRow(this, ${price})" 
                        class="w-20 text-center border-gray-300 rounded-md focus:ring-indigo-500 font-bold">
                </td>
                <td class="px-4 py-4 text-sm text-gray-600 font-medium">$${price.toFixed(2)}</td>
                <td class="px-4 py-4 text-sm font-black text-gray-900">$<span class="subtotal-span">${price.toFixed(2)}</span></td>
                <td class="px-4 py-4 text-right">
                    <button type="button" onclick="this.closest('tr').remove(); calculateTotal();" 
                            class="text-red-500 hover:text-red-700 text-2xl transition">&times;</button>
                </td>
            `;
            document.getElementById('sale-items-table').appendChild(tr);
            calculateTotal();
            
            // Limpiar selector
            select.value = "";
        }

        function updateRow(input, price) {
            const qty = parseFloat(input.value) || 0;
            const subtotal = qty * price;
            input.closest('tr').querySelector('.subtotal-span').innerText = subtotal.toFixed(2);
            calculateTotal();
        }

        function calculateTotal() {
            let total = 0;
            document.querySelectorAll('.subtotal-span').forEach(span => {
                total += parseFloat(span.innerText) || 0;
            });
            document.getElementById('total-display').innerText = total.toFixed(2);
            document.getElementById('total-hidden').value = total.toFixed(2);
            calculateChange();
        }

        function calculateChange() {
            const total = parseFloat(document.getElementById('total-hidden').value) || 0;
            const cash = parseFloat(document.getElementById('cash_received').value) || 0;
            const change = cash - total;
            
            const displayValue = change > 0 ? change.toFixed(2) : "0.00";
            document.getElementById('change-display').innerText = displayValue;
            document.getElementById('change-hidden').value = change > 0 ? change.toFixed(2) : 0;
        }

        document.getElementById('cash_received').addEventListener('input', calculateChange);
    </script>
</x-app-link>