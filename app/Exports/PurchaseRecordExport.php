<?php

namespace App\Exports;

use App\Models\PurchaseRecord;
use Maatwebsite\Excel\Concerns\FromCollection;

class PurchaseRecordExport implements FromCollection
{
  /**
   * @return \Illuminate\Support\Collection
   */
  public function collection()
  {
    $headers = [
      'id' => 'ID',
      'purchase_date' => 'Purchase Date',
      'item_id' => 'Item ID',
      'item_name' => 'Item Name',
      'quantity' => 'Quantity',
      'unit_price' => 'Unit Price (RM)',
      'total_price' => 'Total Price (RM)',
      'customer_id' => 'Customer ID',
      'customer_name' => 'Customer Name',
      'created_at' => 'Created At',
      'updated_at' => 'Updated At'
    ];
    $data = PurchaseRecord::all();
    return collect([
      $headers, // Add the header row first
      $data->map(function ($data) use ($headers) {
        $totalPrice = $data->quantity * $data->inventory->price; // Calculate total price

        return [
          'id' => $data->id,
          'purchase_date' => $data->purchase_date,
          'item_id' => $data->item_id,
          'item_name' => $data->inventory->name,
          'quantity' => $data->quantity,
          'unit_price' => $data->inventory->price,
          'total_price' => $totalPrice,
          'customer_id' => $data->customer_id,
          'customer_name' => $data->customer->name,
          'created_at' => $data->created_at,
          'updated_at' => $data->updated_at
        ];
      })->toArray(), // Convert the mapped collection to an array
    ]);
  }
}
