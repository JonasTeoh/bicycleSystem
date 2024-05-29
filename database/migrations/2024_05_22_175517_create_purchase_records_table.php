<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('purchase_records', function (Blueprint $table) {
      $table->id();
      $table->date('purchase_date');
      // $table->foreignId('customer_id');
      $table->integer('quantity');
      // $table->foreignId('item_id');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('purchase_records');
  }
};
