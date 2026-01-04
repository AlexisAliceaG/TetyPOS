<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Muestra el listado de marcas con el conteo de productos.
     */
    public function index()
    {
        // withCount('products') genera automáticamente un campo brands_count
        $brands = Brand::withCount('products')->latest()->paginate(10);
        return view('brands.index', compact('brands'));
    }

    /**
     * Muestra el formulario para crear una marca.
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Guarda la marca en la base de datos.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:brands,name',
        ]);

        Brand::create($validated);

        return redirect()->route('brands.index')
            ->with('success', 'Marca creada exitosamente.');
    }

    /**
     * Opcional: Muestra detalles de una marca (o redirige al index).
     */
    public function show(Brand $brand)
    {
        return view('brands.show', compact('brand'));
    }

    /**
     * Muestra el formulario para editar la marca.
     */
    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    /**
     * Actualiza la marca en la base de datos.
     */
    public function update(Request $request, Brand $brand)
    {
        $validated = $request->validate([
            // Validamos el nombre pero ignoramos el ID actual para evitar error de duplicado
            'name' => 'required|string|max:255|unique:brands,name,' . $brand->id,
        ]);

        $brand->update($validated);

        return redirect()->route('brands.index')
            ->with('success', 'Marca actualizada correctamente.');
    }

    /**
     * Elimina la marca de la base de datos.
     */
    public function destroy(Brand $brand)
    {
        // Verificamos si la marca tiene productos asociados antes de borrar
        if ($brand->products()->count() > 0) {
            return back()->with('error', 'No se puede eliminar la marca porque tiene productos vinculados.');
        }

        $brand->delete();

        return redirect()->route('brands.index')
            ->with('success', 'Marca eliminada con éxito.');
    }
}