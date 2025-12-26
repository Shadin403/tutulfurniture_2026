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
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('SKU')->unique();
            $table->enum('stock_status', ['instock', 'outofstock'])->default('instock');
            $table->unsignedSmallInteger('quantity')->default(10);
            $table->string('image')->nullable(); // Main image
            $table->json('gallery_images')->nullable(); // Multiple images
            $table->boolean('featured')->default(false);
            $table->json('tags')->nullable();
            $table->unsignedInteger('views')->default(0); // Product Views
            $table->boolean('is_active')->default(true); // Active / Inactive
            $table->foreignId('category_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('brand_id')->constrained('brands')->cascadeOnDelete();
            // $table->foreignId('sub_category_id')->constrained('sub_categories')->cascadeOnDelete();
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
