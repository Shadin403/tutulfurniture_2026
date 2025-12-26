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
            $table->string('name'); // প্রাপকের নাম
            $table->string('phone'); // মোবাইল নাম্বার
            $table->string('division'); // বিভাগ
            $table->string('district'); // জেলা
            $table->string('upazila'); // উপজেলা
            $table->string('locality')->nullable(); // এলাকা বা ইউনিয়ন
            $table->text('address'); // বিস্তারিত ঠিকানা
            $table->string('postal_code'); // পোস্ট কোড
            $table->string('country')->default('Bangladesh'); // ডিফল্ট বাংলাদেশ সেট করা
            $table->string('landmark')->nullable(); // কাছাকাছি কোনো গুরুত্বপূর্ণ স্থানের নাম
            $table->enum('type', ['home', 'office', 'other'])->default('home'); // ঠিকানার ধরন
            $table->boolean('is_default')->default(false); // ডিফল্ট ঠিকানা কিনা
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete(); // ইউজারের সাথে সম্পর্ক
            $table->timestamps();
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
