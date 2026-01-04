<?php

namespace App\Http\Controllers;

use App\Models\SaleItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductReportController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->get('start_date', Carbon::today()->format('Y-m-d'));
        $end_date = $request->get('end_date', Carbon::today()->format('Y-m-d'));

        // Consulta agrupada por producto usando tus campos de 'sale_items'
        $productSales = SaleItem::select(
                'product_id',
                DB::raw('SUM(quantity) as total_quantity'),
                DB::raw('SUM(subtotal) as total_amount')
            )
            ->with('product') // Relación con la tabla products
            ->whereBetween('created_at', [
                $start_date . ' 00:00:00', 
                $end_date . ' 23:59:59'
            ])
            ->groupBy('product_id')
            ->orderBy('total_quantity', 'desc') // Los más vendidos primero
            ->get();

        $totalItems = $productSales->sum('total_quantity');
        $totalRevenue = $productSales->sum('total_amount');

        return view('reports.products', compact('productSales', 'totalItems', 'totalRevenue', 'start_date', 'end_date'));
    }
}