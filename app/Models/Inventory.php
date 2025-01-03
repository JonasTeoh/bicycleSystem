<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
  use HasFactory;
  protected $fillable = [
    'name',
    'quantity',
    'age_category',
    'price',
    'photo'
  ];

  public $sortable = [
    'name',
    'quantity',
    'age_category',
    'price',
    'photo'
  ];
}
