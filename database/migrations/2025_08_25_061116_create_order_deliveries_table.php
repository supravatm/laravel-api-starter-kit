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
        Schema::create('order_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->onDelete('cascade');
            $table->unsignedInteger('user_id');
            $table->date('date');
            $table->string('slot', 50)->nullable();
            $table->string('status',50)->nullable();
            $table->integer('bottle_collected');
            $table->string('reason',50)->nullable();
            $table->unsignedInteger('quantity');
            $table->string('mode', 50)->nullable();
            $table->string('bell', 50)->nullable();
            $table->string('instruction', 100)->nullable();
            $table->unsignedInteger('product_id')->nullable();
            $table->unsignedInteger('price_id')->nullable();
            $table->unsignedInteger('invoice_id')->nullable();
            $table->unsignedInteger('address_id')->nullable();
            $table->unsignedInteger('delivery_route_id')->nullable();
            $table->unsignedInteger('available_city_id')->nullable();
            $table->unsignedInteger('carrier_id')->nullable();
            $table->dateTime('collected_at')->nullable();
            $table->dateTime('action_at')->nullable();
            $table->string('comment', 200)->nullable();
            $table->string('cancel_reason', 200)->nullable();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('cancelled_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_deliveries');
    }
};
