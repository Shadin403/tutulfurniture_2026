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
            $table->decimal('subtotal', 16, 2);
            $table->decimal('discount', 16, 2)->default(0);
            $table->decimal('tex', 16, 2)->default(0);
            $table->decimal('total', 16, 2);
            $table->string('name');
            $table->string('phone');
            $table->string('division');
            $table->string('district');
            $table->string('upazila');
            $table->string('locality');
            $table->text('address');
            $table->string('postal_code');
            $table->string('country')->default('Bangladesh');
            $table->string('landmark')->nullable();
            $table->enum('type', ['home', 'office', 'other'])->default('home');
            $table->enum('status', ['ordered', 'shipped', 'delivered', 'canceled', 'returned'])->default('ordered');
            $table->boolean('is_shipping_different')->default(false);
            $table->date('delivered_date')->nullable();
            $table->date('canceled_date')->nullable();
            $table->bigInteger('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
