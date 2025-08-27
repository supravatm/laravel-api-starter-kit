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
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('carrier_id')->nullable();
            $table->unsignedInteger('evening_carrier_id')->nullable();
            $table->unsignedInteger('delivery_route_id')->nullable();
            $table->unsignedInteger('available_city_id')->nullable();
            $table->boolean('is_default')->default(false);
            $table->string('status');
            $table->string('name');
            $table->string('phone');
            $table->string('apartment_name')->nullable();
            $table->string('flat_no')->nullable();
            $table->string('landmark')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->text('formatted_address');
            $table->string('postal_code');
            $table->string('street_address')->nullable();
            $table->string('route')->nullable();
            $table->string('country')->nullable();
            $table->string('administrative_area_level_1')->nullable();
            $table->string('administrative_area_level_2')->nullable();
            $table->string('administrative_area_level_3')->nullable();
            $table->string('administrative_area_level_4')->nullable();
            $table->string('locality')->nullable();
            $table->string('sublocality')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('plus_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addresses');
    }
};
