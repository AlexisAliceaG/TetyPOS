<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Punto de Venta</h2>
    </x-slot>

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
    <style>
        .ts-control {
            border-radius: 0.5rem !important;
            padding: 0.5rem !important;
            border-color: #d1d5db !important;
        }

        .ts-wrapper.focus .ts-control {
            border-color: #d13d7c !important;
            box-shadow: 0 0 0 1px #d13d7c !important;
        }

        .ts-dropdown .active {
            background-color: #d13d7c !important;
            color: white !important;
        }
    </style>

    <div id="notification-container" class="fixed top-5 right-5 z-50 flex flex-col gap-3 w-72 sm:w-96">
        @if(session('success'))
            <div
                class="notification-toast bg-green-600 text-white p-4 rounded-lg shadow-2xl flex justify-between items-center transform transition-all duration-500 ease-in-out">
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <span class="font-bold">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="ml-4 text-white hover:text-gray-200">&times;</button>
            </div>
        @endif
    </div>

    <div class="py-4 sm:py-6">
        <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
            <form action="{{ route('sales.store') }}" method="POST" id="sale-form">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                    <div class="lg:col-span-2 space-y-4">
                        <div class="bg-white p-4 shadow sm:rounded-lg border-t-4 border-[#d13d7c]">
                            <x-input-label value="Buscar Producto" class="mb-1 text-gray-700 font-bold text-lg" />
                            <div class="flex flex-col sm:flex-row gap-2">
                                <select id="product_selector" class="w-full"
                                    placeholder="Teclee nombre del producto...">
                                    <option value="">Seleccione un producto...</option>
                                    @foreach($products as $product)
                                        <option value="{{ $product->id }}" data-price="{{ $product->selling_price }}"
                                            data-stock="{{ $product->stock }}" data-name="{{ $product->name }}">
                                            {{ $product->name }} (${{ number_format($product->selling_price, 2) }})
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="bg-white shadow sm:rounded-lg overflow-hidden border border-gray-200">
                            <div
                                class="hidden sm:grid grid-cols-12 bg-[#d13d7c] text-white px-4 py-3 text-xs font-bold uppercase tracking-wider">
                                <div class="col-span-5">Producto</div>
                                <div class="col-span-3 text-center">Cant.</div>
                                <div class="col-span-2 text-right">Subtotal</div>
                                <div class="col-span-2"></div>
                            </div>

                            <div id="sale-items-container" class="divide-y divide-gray-200">
                                <div id="empty-cart-msg" class="p-8 text-center text-gray-400 italic">
                                    No hay productos en la venta
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="lg:col-span-1">
                        <div class="bg-white p-6 shadow-xl sm:rounded-lg border border-gray-100 lg:sticky lg:top-6">
                            <h3
                                class="text-xl font-bold mb-6 text-[#d13d7c] border-b border-gray-100 pb-2 uppercase tracking-widest">
                                Resumen</h3>

                            <div class="space-y-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500 font-bold uppercase text-xs">Total a Pagar:</span>
                                    <span class="text-4xl font-black text-[#d13d7c]">$<span
                                            id="total-display">0.00</span></span>
                                </div>
                                <input type="hidden" name="total" id="total-hidden" value="0">

                                <div>
                                    <x-input-label value="EFECTIVO RECIBIDO"
                                        class="text-gray-500 text-xs font-bold mb-1" />
                                    <div class="relative">
                                        <span class="absolute left-3 top-3 text-2xl font-bold text-gray-400">$</span>
                                        <input type="number" name="cash_received" id="cash_received" step="0.01"
                                            class="w-full bg-gray-50 border-gray-300 text-gray-800 text-3xl font-bold rounded-md pl-10 py-3 focus:ring-[#d13d7c] focus:border-[#d13d7c]"
                                            placeholder="0.00" required>
                                    </div>
                                </div>

                                <div
                                    class="flex justify-between items-center bg-gray-50 p-4 rounded-lg border border-gray-200">
                                    <span class="text-gray-500 font-bold uppercase text-xs">Su Cambio:</span>
                                    <span class="text-2xl font-black text-gray-700">$<span
                                            id="change-display">0.00</span></span>
                                    <input type="hidden" name="change_given" id="change-hidden" value="0">
                                </div>

                                <button type="submit"
                                    class="w-full py-6 justify-center bg-[#82b45e] hover:bg-[#719e51] text-white font-black text-xl rounded-lg shadow-lg transform active:scale-95 transition uppercase tracking-widest">
                                    FINALIZAR VENTA
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

    <script>
        let productSearch;

        document.addEventListener('DOMContentLoaded', function () {
            productSearch = new TomSelect("#product_selector", {
                create: false,
                maxOptions: 10,
                onItemAdd: function (value) {
                    const data = this.options[value]; addProductRow(data); this.clear(); 
                    this.close();
                 }
                });

            const toasts = document.querySelectorAll('.notification-toast');
            toasts.forEach(toast => {
                setTimeout(() => {
                    toast.style.opacity = '0';
                    setTimeout(() => toast.remove(), 500);
                }, 5000);
            });
        });

        function addProductRow(data) {
            if (!data || !data.value) return;

            const productId = data.value;
            const price = parseFloat(data.price) || 0;
            const stock = parseInt(data.stock) || 0;
            const name = data.name;

            const existingRow = document.getElementById(`row-${productId}`);
            if (existingRow) {
                const qtyInput = existingRow.querySelector('input[type="number"]');
                if (parseInt(qtyInput.value) < stock) {
                    qtyInput.value = parseInt(qtyInput.value) + 1;
                    updateRow(qtyInput, price);
                } else {
                    alert("Stock máximo alcanzado");
                }
                return;
            }

            const emptyMsg = document.getElementById('empty-cart-msg');
            if (emptyMsg) emptyMsg.remove();

            const container = document.getElementById('sale-items-container');
            const div = document.createElement('div');
            div.id = `row-${productId}`;
            div.className = "flex flex-col sm:grid sm:grid-cols-12 gap-4 px-4 py-4 sm:items-center hover:bg-gray-50 transition bg-white";
            div.innerHTML = `
                <div class="sm:col-span-5">
                    <p class="text-sm font-bold text-gray-800 uppercase">${name}</p>
                    <input type="hidden" name="items[${productId}][product_id]" value="${productId}">
                </div>
                
                <div class="sm:col-span-3 flex items-center justify-between sm:justify-center gap-2">
                    <input type="number" name="items[${productId}][quantity]" value="1" min="1" max="${stock}" 
                        oninput="updateRow(this, ${price})" 
                        class="w-20 text-center border-gray-300 rounded-md focus:ring-[#d13d7c] font-bold text-lg">
                </div>

                <div class="sm:col-span-2 text-right">
                    <span class="text-lg sm:text-sm font-black text-gray-900">$<span class="subtotal-span">${price.toFixed(2)}</span></span>
                </div>

                <div class="sm:col-span-2 text-right">
                    <button type="button" onclick="removeRow('${productId}')" 
                            class="text-red-500 hover:text-red-700 font-bold text-2xl transition">
                        &times;
                    </button>
                </div>
            `;
            container.prepend(div);
            calculateTotal();
        }

        function removeRow(id) {
            document.getElementById(`row-${id}`).remove();
            calculateTotal();
            checkEmpty();
        }

        function checkEmpty() {
            const container = document.getElementById('sale-items-container');
            if (container.children.length === 0) {
                container.innerHTML = '<div id="empty-cart-msg" class="p-8 text-center text-gray-400 italic">No hay productos en la venta</div>';
            }
        }

        function updateRow(input, price) {
            const qty = parseFloat(input.value) || 0;
            const subtotal = qty * price;
            input.closest('[id^="row-"]').querySelector('.subtotal-span').innerText = subtotal.toFixed(2);
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
            const displayValue = (change > 0 && total > 0) ? change.toFixed(2) : "0.00";
            document.getElementById('change-display').innerText = displayValue;
            document.getElementById('change-hidden').value = change > 0 ? change.toFixed(2) : 0;
        }

        document.getElementById('cash_received').addEventListener('input', calculateChange);
    </script>
</x-app-layout>