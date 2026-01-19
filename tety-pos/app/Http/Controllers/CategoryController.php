<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Muestra el listado de categorías.
     */
    public function index()
    {
        // Usamos withCount para obtener el número de productos sin cargar todos los datos
        $categories = Category::withCount('products')->latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Muestra el formulario de creación.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Guarda una nueva categoría.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
        ]);

        try {
            Category::create($validated);

            return redirect()->route('categories.index')
                ->with('success', 'Categoría creada exitosamente ✅');
        } catch (\Exception $e) {
            return back()->withInput()->with('error', '❌ No se pudo crear la categoría. Intenta nuevamente.');
        }
    }


    /**
     * Muestra el formulario de edición.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Actualiza la categoría existente.
     */
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            // Validamos que el nombre sea único, pero ignoramos el ID actual
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Elimina la categoría.
     */
    public function destroy(Category $category)
    {
        // Seguridad: Verificar si tiene productos antes de borrar
        if ($category->products()->count() > 0) {
            return back()->with('error', 'No se puede eliminar: Esta categoría tiene productos asociados.');
        }

        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Categoría eliminada.');
    }
}