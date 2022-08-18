<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SalesExport;
use App\Models\Bill;
use App\Models\Sale;
use App\Models\Inventory;

class ReportController extends Controller
{
    public function index(){
        $reports = Bill::all();
        return view('report.index', ['reports' => $reports]);
    }

    public function details(Request $request){
        $report = Bill::find($request->id);
        $sales = Sale::where('sale_id', $report->bill_id)->get();

        return view('report.detail', ['sales' => $sales, 
                                      'total_price' => $report->total_price,
                                      'bill_id' => $request->id]);
    }
    public function exportDetails(Request $request){
        $report = Bill::find($request->id);
        $sales = Sale::where('sale_id', $report->bill_id)->get();
        
        for ($i=0; $i < count($sales); $i++) {
            # code...
            $sale = $sales[$i];
            $inventory = Inventory::find($sale->inventory_id);
    
            $sales[$i] = [
                "No" => $i + 1,
                "Inventory" => $inventory->name,
                "Unit Price" => $inventory->price,
                "Quantity" => $sale->quantity,
                "Price" => $sale->price
            ];
        }
        $export = new SalesExport([$sales]);

        return Excel::download($export, 'sales_' . date("Y-m-d") . '.xlsx');
    }
}
