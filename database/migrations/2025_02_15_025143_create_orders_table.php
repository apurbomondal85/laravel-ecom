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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('transaction_id')->nullable();
            $table->string('invoice_id')->unique();
            $table->unsignedBigInteger('customer_id');
            $table->integer('quantity');
            $table->float('sub_total_amount', 15, 2)->default(0);
            $table->float('total_amount', 15, 2)->default(0);
            $table->float('discount_amount', 15, 2)->default(0);
            $table->float('shipping_cost', 15, 2)->default(0);
            $table->enum('order_status', array_keys(Enum::getOrderStatusType()))->default(Enum::ORDER_STATUS_TYPE_PENDING)->comment('Pending, Canceled, Processing, Shipped, Delivered, Not Received, Returned, Incomplete');
            $table->enum('payment_status', array_keys(Enum::getPaymentStatusType()))->default(Enum::ORDER_PAYMENT_STATUS_UNPAID)->comment('Unpaid, Partial, Paid, Refunded');
            $table->enum('payment_type', array_keys(Enum::getOrderPaymentType()))->default(Enum::ORDER_PAYMENT_TYPE_COD)->comment('cod, digital');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
