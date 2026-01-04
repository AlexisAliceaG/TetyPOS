<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Models\Product;
use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function create()
    {
        // Usamos selling_price que es el nombre real en tu tabla
        $products = Product::where('stock', '>', 0)->orderBy('name', 'asc')->get();
        return view('sales.create', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'total' => 'required|numeric',
            'cash_received' => 'required|numeric|min:0',
            'items' => 'required|array',
        ]);

        if ($request->cash_received < $request->total) {
            return back()->with('error', 'El efectivo recibido es insuficiente.');
        }

        DB::beginTransaction();
        try {
            $sale = Sale::create([
                'user_id' => auth()->id(),
                'total' => $request->total,
                'cash_received' => $request->cash_received,
                'change_given' => $request->change_given,
                'payment_method' => 'cash',
            ]);

            foreach ($request->items as $item) {
                $product = Product::findOrFail($item['product_id']);
                
                SaleItem::create([
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->selling_price, // Cambio a selling_price
                    'subtotal' => $item['quantity'] * $product->selling_price,
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            DB::commit();
            return redirect()->route('sales.create')->with('success', 'Venta exitosa. Cambio: $' . number_format($request->change_given, 2));

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error en la venta: ' . $e->getMessage());
        }
    }
}