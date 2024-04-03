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
        Schema::create('product_sales', function (Blueprint $table) {
            $table->id();

            $table->integer("fk_user_id");
            $table->integer("fk_product_id");
            $table->decimal("price", 10, 2);
            $table->decimal("cost", 10, 2);
            $table->decimal("tax", 10, 2);
            $table->decimal("currency_price", 10, 2);
            $table->string("currency_code");
            $table->integer("quantity");

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_sales');
    }
};
