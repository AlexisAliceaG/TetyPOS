<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Muestra la lista de productos con paginación y búsqueda.
     */
    public function index()
    {
        $products = Product::with(['category', 'brand'])
            ->latest()
            ->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Muestra el formulario para crear un nuevo producto.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.create', compact('categories', 'brands'));
    }

    /**
     * Guarda el producto en la base de datos.
     */
    public function store(Request $request)
    {
        $request->validate([ 'name' => 'required|string|max:255', 
                            'sku' => 'nullable|string|unique:products,sku', 
                            'category_id' => 'required|exists:categories,id', 
                            'brand_id' => 'nullable|exists:brands,id', 
                            'cost_price' => 'required|numeric|min:0', 
                            'selling_price' => 'required|numeric|min:0', 
                            'stock' => 'required|integer|min:0', '
                            alert_quantity' => 'integer|min:0', ]);
        try {
            Product::create($request->all());

            return redirect()->route('products.index')
                ->with('success', 'Producto creado exitosamente ✅');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', '❌ No se pudo guardar el producto. Intenta nuevamente.');
        }
    }


    /**
     * Muestra un producto específico (opcional para un POS, pero útil).
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Muestra el formulario para editar un producto existente.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'           => 'required|string|max:255',
            'sku'            => 'required|string|unique:products,sku,' . $product->id,
            'category_id'    => 'required|exists:categories,id',
            'brand_id'       => 'nullable|exists:brands,id',
            'cost_price'     => 'required|numeric|min:0',
            'selling_price'  => 'required|numeric|min:0',
            'stock'          => 'required|integer|min:0',
            'alert_quantity' => 'required|integer|min:0',
            'description'    => 'nullable|string',
        ]);

        $product->update($validated);
        return redirect()->route('products.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    /**
     * Elimina el producto de la base de datos.
     */
    public function destroy(Product $product)
    {
        // Podrías verificar si el producto tiene ventas asociadas antes de borrar
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Producto eliminado.');
    }
}