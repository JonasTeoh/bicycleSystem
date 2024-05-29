<?php

namespace App\Http\Controllers;

use App\Exports\SupplierExport;
use Carbon\Carbon;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SupplierController extends Controller
{
  public function index()
  {
    $supplier = Supplier::all();
    return view('supplier.index', compact('supplier'));
  }

  public function create()
  {
    return view('supplier.create');
  }

  public function store(Request $request)
  {
    $input = $request->all();
    Supplier::create($input);
    session()->flash('success', 'Added a new supplier!');
    return redirect('supplier');
  }

  public function destroy($id)
  {
    Supplier::destroy($id);
    session()->flash('success', 'Deleted successfully!');
    return redirect('supplier');
  }

  public function edit($id)
  {
    $supplier = Supplier::find($id);
    return view('supplier.edit', compact('supplier'))->with('supplier', $supplier);
  }

  public function update(Request $request, $id)
  {
    $input = $request->all();
    $supplier = Supplier::find($id);
    $supplier->update($input);
    session()->flash('success', 'Supplier updated!');
    return redirect('supplier');
  }

  public function show($id)
  {
    $supplier = Supplier::find($id);
    return view('supplier.show')->with('supplier', $supplier);
  }

  public function export()
  {
    $currentTime = Carbon::now('Asia/Shanghai')->format('Y_m_d_H_i_s'); // Generate a timestamp by following timezone UTC+8
    $fileName = "suppliers_" . $currentTime . ".xlsx";
    return Excel::download(new SupplierExport, $fileName);
  }
}
