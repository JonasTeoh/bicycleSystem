<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\SupplyRecordController;
use App\Http\Controllers\PurchaseRecordController;
use App\Http\Middleware\EnsureUserIsAuthenticated;
use App\Http\Controllers\RoleAndPermissionController;

Route::get('/', function () {
  if (auth()->check()) {
    return redirect('/home');
  }
  return view('welcome');
});

Route::get('/login', function () {
  if (auth()->check()) {
    return redirect('/home');
  }
  return view('auth/login');
});

Route::get('/register', function () {
  if (auth()->check()) {
    return redirect('/home');
  }
  return view('auth/register');
})->name('register');

Route::middleware('auth')->group(function () {
  Route::get('/home', function () {
    return view('home');
  })->name('home');
  Route::resource('/customer', CustomerController::class)->middleware('permission:customer-list');
  Route::resource('/inventory', InventoryController::class)->middleware('permission:inventory-list');
  Route::resource('/purchaseRecord', PurchaseRecordController::class)->middleware('permission:purchaseRecord-list');
  Route::resource('/supplier', SupplierController::class)->middleware('permission:supplier-list');
  Route::resource('/supplyRecord', SupplyRecordController::class)->middleware('permission:supplyRecord-list');
  Route::resource('/roleAndPermission', RoleAndPermissionController::class)->middleware('permission:role-list');
  Route::resource('/user', UserController::class)->middleware('permission:user-list');

  Route::get('/profile', [UserController::class, 'profile']);
  Route::put('/profile/{id}', [UserController::class, 'updateProfile']);
  Route::get('customers/export/', [CustomerController::class, 'export']);
  Route::get('inventories/export/', [InventoryController::class, 'export']);
  Route::get('purchaseRecords/export/', [PurchaseRecordController::class, 'export']);
  Route::get('suppliers/export/', [SupplierController::class, 'export']);
  Route::get('supplyRecords/export/', [SupplyRecordController::class, 'export']);

  Route::get('purchaseRecords/pdfDownload/{id}', [PurchaseRecordController::class, 'download']);
  Route::get('purchaseRecords/pdfStream/{id}', [PurchaseRecordController::class, 'stream']);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login'])->name('login');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');
;
