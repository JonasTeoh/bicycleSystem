<?php

namespace App\Http\Controllers;

use App\Exports\InventoryExport;
use App\Models\PurchaseRecord;
use Carbon\Carbon;
use App\Models\Inventory;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class InventoryController extends Controller
{
  public function index()
  {
    $inventory = Inventory::all();
    return view('inventory.index', compact('inventory'));
  }

  public function create()
  {
    return view('inventory.create');
  }

  public function store(Request $request)
  {
    $input = $request->all();
    Inventory::create($input);
    session()->flash('success', 'Added a new item!');
    return redirect('inventory');
  }

  public function destroy($id)
  {
    Inventory::destroy($id);
    session()->flash('success', 'Deleted successfully!');
    return redirect('inventory');
  }

  public function edit($id)
  {
    $inventory = Inventory::find($id);
    return view('inventory.edit', compact('inventory'))->with('inventory', $inventory);
  }

  public function update(Request $request, $id)
  {
    $input = $request->all();
    $inventory = Inventory::find($id);
    $inventory->update($input);
    session()->flash('success', 'Inventory updated!');
    return redirect('inventory');
  }

  public function show($id)
  {
    $inventory = Inventory::find($id);
    return view('inventory.show')->with('inventory', $inventory);
  }

  public function export()
  {
    $currentTime = Carbon::now('Asia/Shanghai')->format('Y_m_d_H_i_s'); // Generate a timestamp by following timezone UTC+8
    $fileName = "inventories_" . $currentTime . ".xlsx";
    return Excel::download(new InventoryExport, $fileName);
  }
}
