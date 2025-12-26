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
        Schema::create('product_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('material')->nullable(); // ব্যবহৃত ম্যাটেরিয়াল (যেমনঃ কাঠ, মেটাল)
            $table->json('dimensions')->nullable(); // সাইজের বিবরণ (যেমনঃ দৈর্ঘ্য, প্রস্থ, উচ্চতা)
            $table->decimal('weight', 8, 2)->nullable(); // ওজন (kg বা lbs)
            $table->json('size')->nullable(); // সাইজ
            $table->string('color')->nullable(); // রঙ
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->decimal('regular_price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->time('discount_time')->nullable();
            $table->text('extra_info')->nullable();
            $table->string('warranty')->nullable(); // Warranty Information
            $table->boolean('assembly_required')->default(false); // Assembly Required
            $table->enum('indoor_outdoor', ['indoor', 'outdoor', 'both'])->nullable(); // Indoor/Outdoor
            $table->string('meta_title')->nullable(); // SEO Title
            $table->text('meta_description')->nullable(); // SEO Description
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_details');
    }
};
