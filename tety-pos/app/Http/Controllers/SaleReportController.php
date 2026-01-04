<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SaleReportController extends Controller
{
    public function index(Request $request)
    {
        // Filtros de fecha (por defecto hoy)
        $start_date = $request->get('start_date', Carbon::today()->format('Y-m-d'));
        $end_date = $request->get('end_date', Carbon::today()->format('Y-m-d'));

        // Consulta basada en tus migraciones
        $sales = Sale::with(['user', 'items.product'])
            ->whereBetween('created_at', [
                $start_date . ' 00:00:00', 
                $end_date . ' 23:59:59'
            ])
            ->latest()
            ->get();

        // Totales calculados de los campos de tu tabla 'sales'
        $summary = [
            'count' => $sales->count(),
            'total_revenue' => $sales->sum('total'),
            'total_cash' => $sales->sum('cash_received'),
            'total_change' => $sales->sum('change_given'),
        ];

        return view('reports.sales', compact('sales', 'summary', 'start_date', 'end_date'));
    }
}