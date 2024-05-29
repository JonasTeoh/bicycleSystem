<?php

namespace App\Exports;

use App\Models\Supplier;
use Maatwebsite\Excel\Concerns\FromCollection;

class SupplierExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
      $headers = [
        'id' => 'ID',
        'name' => 'Name',
        'contact_number' => 'Contact Number',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At'
      ];
      $data = Supplier::all();
      return collect([
        $headers,
        $data
      ]);
    }
}
