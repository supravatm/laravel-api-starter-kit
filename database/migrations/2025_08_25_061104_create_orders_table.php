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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->integer('available_city_id');
            $table->string('invoice_id');
            $table->foreignId('product_id')->onDelete('cascade');
            $table->unsignedInteger('quantity');
            $table->decimal('mrp', 8, 2)->default(0.00);
            $table->decimal('price', 8, 2)->default(0.00);
            $table->string('type');
            $table->integer('subscription_plan_id');
            $table->string('subscription_type');
            $table->date('subscription_start');
            $table->date('subscription_end');
            $table->integer('subscription_interval');
            $table->integer('delivery_remaining');
            $table->integer('delivery_total');
            $table->enum('status',['active', 'delivered', 'cancelled', 'processing'])->index();
            $table->string('delivery_mode');
            $table->string('delivery_bell');
            $table->string('delivery_instruction');
            $table->timestamps();
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
