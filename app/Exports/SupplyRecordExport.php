<?php

namespace App\Exports;

use App\Models\SupplyRecord;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupplyRecordExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      $headers = [
        'id' => 'ID',
        'supplied_date' => 'Supplied Date',
        'item_id' => 'Item ID',
        'item_name' => 'Item Name',
        'quantity' => 'Quantity',
        'supplier_unit_price' => 'Supplier Unit Price (RM)',
        'supplier_total_price' => 'Supplier Total Price (RM)',
        'supplier_id' => 'Supplier ID',
        'supplier_name' => 'Supplier Name',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At'
      ];
      $data = supplyRecord::all();
      return collect([
        $headers, // Add the header row first
        $data->map(function ($data) use ($headers) {
          $totalPrice = $data->quantity * $data->supplier_price; // Calculate total price

          return [
            'id' => $data->id,
            'supplied_date' => $data->supplied_date,
            'item_id' => $data->item_id,
            'item_name' => $data->inventory->name,
            'quantity' => $data->quantity,
            'unit_price' => $data->supplier_price,
            'total_price' => $totalPrice,
            'supplier_id' => $data->supplier_id,
            'supplier_name' => $data->supplier->name,
            'created_at' => $data->created_at,
            'updated_at' => $data->updated_at
          ];
        })->toArray(), // Convert the mapped collection to an array
      ]);
    }
}
