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
    Schema::table('purchase_records', function (Blueprint $table) {
      $table->foreignId('customer_id')
        ->constrained('customers')
        ->onDelete('cascade')
        ->onUpdate('cascade');
      $table->foreignId('item_id')->constrained('inventories')->onDelete('cascade')->onUpdate('cascade');
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::table('purchase_records', function (Blueprint $table) {
      $table->dropForeign('purchase_record_customer_id_foreign');
      $table->dropForeign('purchase_record_item_id_foreign');
    });
  }
};
