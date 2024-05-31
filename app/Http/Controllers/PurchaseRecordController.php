<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Customer;
use App\Models\Inventory;
use Illuminate\Http\Request;
use App\Models\PurchaseRecord;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PurchaseRecordExport;

class PurchaseRecordController extends Controller
{
  public function index()
  {
    $purchaseRecord = PurchaseRecord::all();
    return view('purchaseRecord.index', compact('purchaseRecord'));
  }

  public function create()
  {
    $inventory = Inventory::all(); // Select id and name for options
    $customer = Customer::all()->pluck('name', 'id');
    return view('purchaseRecord.create', compact('inventory', 'customer'));
  }

  public function store(Request $request)
  {
    $inventoryItem = Inventory::find($request->item_id);
    if ($inventoryItem->quantity >= $request->quantity) {
      $inventoryItem->quantity -= $request->quantity;
    } else {
      // Handle insufficient inventory scenario (throw exception, log error, etc.)
      return redirect()->back()->withErrors(['quantity' => 'Insufficient inventory for this item.']);
    }
    $inventoryItem->save();
    $input = $request->all();
    PurchaseRecord::create($input);
    session()->flash('success', 'Added a new purchase record!');
    return redirect('purchaseRecord');
  }

  public function destroy($id)
  {
    $purchaseRecord = PurchaseRecord::find($id);
    if ($purchaseRecord) {
      $inventoryItem = Inventory::find($purchaseRecord->item_id);
      $inventoryItem->quantity += $purchaseRecord->quantity;
      $inventoryItem->save();
    }
    PurchaseRecord::destroy($id);
    session()->flash('success', 'Deleted successfully!');
    return redirect('purchaseRecord');
  }

  public function edit($id)
  {
    $purchaseRecord = PurchaseRecord::find($id);
    $inventory = Inventory::all(); // Select id and name for options
    $customer = Customer::all()->pluck('name', 'id');
    return view('purchaseRecord.edit', compact('purchaseRecord', 'inventory', 'customer'));
  }

  public function update(Request $request, $id)
  {
    $purchaseRecord = PurchaseRecord::find($id);
    $purchaseRecordOriQuantity = $purchaseRecord->quantity;
    if ($request->item_id != $purchaseRecord->item_id) {
      $inventoryItem = Inventory::find($purchaseRecord->item_id);
      $inventoryItem->quantity += $purchaseRecordOriQuantity;
      $inventoryItem->save();
      $inventoryItem = Inventory::find($request->item_id);
      $inventoryItem->quantity -= $request->quantity;
      $inventoryItem->save();
    }
    $input = $request->all();
    $purchaseRecord = PurchaseRecord::find($id);
    $purchaseRecord->update($input);

    $inventoryItem = Inventory::find($purchaseRecord->item_id);
    $quantityChange = $purchaseRecord->quantity - $purchaseRecordOriQuantity;

    //the quantity decreased
    if ($quantityChange < 0) {
      $inventoryItem->quantity += abs($quantityChange);
    } else if ($quantityChange > 0) { //quantity increased
      if ($inventoryItem->quantity >= abs($quantityChange)) {
        $inventoryItem->quantity -= abs($quantityChange);
      } else {
        // Handle insufficient inventory scenario (throw exception, log error, etc.)
        return redirect()->back()->withErrors(['quantity' => 'Insufficient inventory for this item.']);
      }
    }

    $inventoryItem->save();

    session()->flash('success', 'Purchase Record updated!');
    return redirect('purchaseRecord');
  }

  public function show($id)
  {
    $purchaseRecord = PurchaseRecord::find($id);
    return view('purchaseRecord.show')->with('purchaseRecord', $purchaseRecord);
  }

  public function export()
  {
    $currentTime = Carbon::now('Asia/Shanghai')->format('Y_m_d_H_i_s'); // Generate a timestamp by following timezone UTC+8
    $fileName = "purchase_records_" . $currentTime . ".xlsx";
    return Excel::download(new PurchaseRecordExport, $fileName);
  }

  public function download($id)
  {
    $purchaseRecord = PurchaseRecord::find($id);
    $customer = Customer::find($purchaseRecord->customer_id);
    $pdf = Pdf::loadView('pdf', compact('purchaseRecord', 'customer'));

    return $pdf->download($purchaseRecord->id . '_invoice.pdf');
  }

  public function stream($id)
  {
    $purchaseRecord = PurchaseRecord::find($id);
    $customer = Customer::find($purchaseRecord->customer_id);
    $pdf = Pdf::loadView('pdf', compact('purchaseRecord', 'customer'));

    return $pdf->stream();
  }
}
