<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
      Schema::table('purchase_records', function (Blueprint $table) {
        $table->decimal('sold_price', 10, 2)->nullable();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('purchase_records', function (Blueprint $table) {
        $table->dropColumn('sold_price');
    });
}
};
