<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Inventory;
use App\Models\SupplyRecord;
use Illuminate\Http\Request;
use App\Models\PurchaseRecord;
use Spatie\Permission\Models\Role;
use IcehouseVentures\LaravelChartjs\Facades\Chartjs;

class ChartController extends Controller
{
  public function showChart()
  {

    $roles = Role::all();
    $roleCounts = collect($roles)->map(function ($role) {
      return [
        "count" => $role->users->count(),
        "role" => $role->name
      ];
    });

    $data = $roleCounts->pluck("count")->toArray();
    $labels = $roleCounts->pluck("role")->toArray();

    $userChart = Chartjs::build()
      ->name("RoleCountsChart")
      ->type("bar")
      ->size(["width" => 400, "height" => 200])
      ->labels($labels)
      ->datasets([
        [
          "label" => "User Counts",
          "backgroundColor" => "rgba(38, 185, 154, 0.31)",
          "borderColor" => "rgba(38, 185, 154, 0.7)",
          "data" => $data
        ]
      ])
      ->options([
        'plugins' => [
          'title' => [
            'display' => true,
            'text' => 'User Counts by Role'
          ]
        ]
      ]);

    $purchaseRecords = PurchaseRecord::all();
    $dates = $purchaseRecords->map(function ($record) {
      return \Carbon\Carbon::parse($record->purchase_date)->format("Y-m-d");
    })->toArray();
    $purchaseCounts = $purchaseRecords->map(function ($record) {
      return $record->quantity;
    })->toArray();
    $purchaseChart = Chartjs::build()
      ->name("PurchaseCountsChart")
      ->type("line")
      ->size(["width" => 400, "height" => 200])
      ->labels($dates)
      ->datasets([
        [
          "label" => "Purchase Counts",
          "backgroundColor" => "rgba(38, 185, 154, 0.31)",
          "borderColor" => "rgba(38, 185, 154, 0.7)",
          "fill" => false,
          "data" => $purchaseCounts
        ]
      ])
      ->options([
        'plugins' => [
          'title' => [
            'display' => true,
            'text' => 'Purchase Counts by Date'
          ]
        ]
      ]);

    $inventories = Inventory::all();
    $itemNames = $inventories->pluck('name')->toArray();
    $stockCounts = $inventories->pluck('quantity')->toArray();
    $itemChart = Chartjs::build()
      ->name("StockCountChart")
      ->type("doughnut")
      ->size(["width" => 400, "height" => 200])
      ->labels($itemNames)
      ->datasets([
        [
          "label" => "Stock Counts",
          "backgroundColor" => ["#f44336", "#2196f3", "#ffeb3b", "#4caf50", "#ff9800"],
          "data" => $stockCounts
        ]
      ])
      ->options([
        'plugins' => [
          'title' => [
            'display' => true,
            'text' => 'Stock Counts by Item'
          ],
          'legend' => [
            'position' => 'right'
          ]
        ]
      ]);

    $supplyRecords = SupplyRecord::all();
    $dates = $supplyRecords->map(function ($record) {
      return \Carbon\Carbon::parse($record->supplied_date)->format("Y-m-d");
    })->toArray();
    $supplyCounts = $supplyRecords->map(function ($record) {
      return $record->quantity;
    })->toArray();
    $supplyChart = Chartjs::build()
      ->name("SupplyCountsChart")
      ->type("line")
      ->size(["width" => 400, "height" => 200])
      ->labels($dates)
      ->datasets([
        [
          "label" => "Supply Counts",
          "backgroundColor" => "rgba(54, 162, 235, 0.31)",
          "borderColor" => "rgba(54, 162, 235, 0.7)",
          "fill" => false,
          "data" => $supplyCounts
        ]
      ])
      ->options([
        'plugins' => [
          'title' => [
            'display' => true,
            'text' => 'Supply Counts by Date'
          ]
        ]
      ]);


    return view("home", compact("userChart", "purchaseChart", "itemChart", "supplyChart"));

  }
}
