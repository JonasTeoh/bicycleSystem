<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseRecord extends Model
{
    use HasFactory;

    protected $fillable = [
      'purchase_date',
      'customer_id',
      'item_id',
      'quantity'
    ];

    public $sortable = [
      'purchase_date',
      'customer_id',
      'item_id',
      'quantity'
    ];

    public function customer()
  {
    return $this->belongsTo(Customer::class, 'customer_id');
  }

  public function inventory()
  {
    return $this->belongsTo(Inventory::class, 'item_id');
  }
}
