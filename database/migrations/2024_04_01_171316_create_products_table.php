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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer("fk_user_id");

            $table->string("title")->max(100);
            $table->longText("image")->nullable(true);
            $table->decimal("cost", 10,  2);
            $table->decimal("price", 10,  2);
            $table->decimal("tax", 10,  2);
            $table->text("description")->nullable(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
