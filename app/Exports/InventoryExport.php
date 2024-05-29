<?php

namespace App\Exports;

use App\Models\Inventory;
use Maatwebsite\Excel\Concerns\FromCollection;

class InventoryExport implements FromCollection
{
  /**
   * @return \Illuminate\Support\Collection
   */
  public function collection()
  {
    $headers = [
      'id' => 'ID',
      'name' => 'Name',
      'quantity' => 'Quantity',
      'age_category' => 'Age Category',
      'price' => 'Price',
      'created_at' => 'Created ',
      'updated_at' => 'Updated At'
    ];
    $data = Inventory::all();
    return collect([
      $headers,
      $data
    ]);
  }
}
