<?php

namespace App\Http\Controllers;

use App\Exports\SupplyRecordExport;
use Carbon\Carbon;
use App\Models\Supplier;
use App\Models\Inventory;
use App\Models\SupplyRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

class SupplyRecordController extends Controller
{
  public function index()
  {
    $supplyRecord = SupplyRecord::all();
    return view('supplyRecord.index', compact('supplyRecord'));
  }
  public function create()
  {
    $inventory = Inventory::all()->pluck('name', 'id'); // Select id and name for options
    $supplier = Supplier::all()->pluck('name', 'id');
    return view('supplyRecord.create', compact('inventory', 'supplier'));
  }

  public function store(Request $request)
  {
    $input = $request->all();
    SupplyRecord::create($input);
    $inventoryItem = Inventory::find($request->item_id);
    $inventoryItem->quantity += $request->quantity;
    $inventoryItem->save();
    session()->flash('success', 'Added a new supply record!');
    return redirect('supplyRecord');
  }

  public function destroy($id)
  {
    $supplyRecord = SupplyRecord::find($id);
    if ($supplyRecord) {
      $inventoryItem = Inventory::find($supplyRecord->item_id);
      $inventoryItem->quantity -= $supplyRecord->quantity;
      $inventoryItem->save();
    }

    SupplyRecord::destroy($id);
    session()->flash('success', 'Deleted successfully!');
    return redirect('supplyRecord');
  }

  public function edit($id)
  {
    $supplyRecord = SupplyRecord::find($id);
    $inventory = Inventory::all()->pluck('name', 'id'); // Select id and name for options
    $supplier = Supplier::all()->pluck('name', 'id');
    return view('supplyRecord.edit', compact('supplyRecord', 'inventory', 'supplier'));
  }

  public function update(Request $request, $id)
  {
    $supplyRecord = SupplyRecord::find($id);
    $supplyRecordOriQuantity = $supplyRecord->quantity;
    if ($request->item_id != $supplyRecord->item_id) {
      $inventoryItem = Inventory::find($supplyRecord->item_id);
      $inventoryItem->quantity -= $supplyRecordOriQuantity;
      $inventoryItem->save();
      $inventoryItem = Inventory::find($request->item_id);
      $inventoryItem->quantity += $request->quantity;
      $inventoryItem->save();
    }
    $input = $request->all();
    $supplyRecord->update($input);
    // Log::info('Original Quantity: ' . $supplyRecordOriQuantity);

    $inventoryItem = Inventory::find($supplyRecord->item_id);
    $quantityChange =  $supplyRecord->quantity - $supplyRecordOriQuantity; // Calculate quantity change
    Log::info('Change in quantity:'.$quantityChange);

    if ($quantityChange > 0) {
      $inventoryItem->quantity += $quantityChange;
    } else if ($quantityChange < 0) {
      if ($inventoryItem->quantity >= abs($quantityChange)) {
        $inventoryItem->quantity -= abs($quantityChange);
        Log::info(abs($quantityChange) .'and'. $inventoryItem->quantity);
      } else {
        // Handle insufficient inventory scenario (throw exception, log error, etc.)
        return redirect()->back()->withErrors(['quantity' => 'Insufficient inventory for this item.']);
      }
    }
    Log::info('Final Quantity: ' . $inventoryItem->quantity);
    $inventoryItem->save();

    session()->flash('success', 'Supply Record updated!');
    return redirect('supplyRecord');
  }

  public function show($id)
  {
    $supplyRecord = SupplyRecord::find($id);
    return view('supplyRecord.show')->with('supplyRecord', $supplyRecord);
  }

  public function export()
  {
    $currentTime = Carbon::now('Asia/Shanghai')->format('Y_m_d_H_i_s'); // Generate a timestamp by following timezone UTC+8
    $fileName = "supply_records_" . $currentTime . ".xlsx";
    return Excel::download(new SupplyRecordExport, $fileName);
  }
}
