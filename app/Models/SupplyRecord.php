<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyRecord extends Model
{
    use HasFactory;
    protected $fillable = [
      'supplier_price',
      'supplied_date',
      'quantity',
      'item_id',
      'supplier_id'
    ];

    public $sortable = [
      'supplier_price',
      'supplied_date',
      'quantity',
      'item_id',
      'supplier_id'
    ];

    public function supplier()
  {
    return $this->belongsTo(Supplier::class, 'supplier_id');
  }

  public function inventory()
  {
    return $this->belongsTo(Inventory::class, 'item_id');
  }
}
