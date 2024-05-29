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
        Schema::create('supply_records', function (Blueprint $table) {
            $table->id();
            $table->date('supplied_date');
            // $table->foreignId('item_id');
            $table->integer('quantity');
            $table->decimal('supplier_price', 10, 2);
            // $table->foreignId('supplier_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('supply_records');
    }
};
