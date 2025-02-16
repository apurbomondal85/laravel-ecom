<?php

use App\Library\Enum;
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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('product_id');
            $table->integer('quantity');
            $table->float('product_price', 15, 2)->default(0);
            $table->float('sale_price', 15, 2)->default(0);
            $table->enum('discount_type', array_keys(Enum::getDiscountType()))->nullable()->comment('percentage, flat');
            $table->float('discount', 15, 2)->default(0);
            $table->float('shipping_cost', 15, 2)->default(0);
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
