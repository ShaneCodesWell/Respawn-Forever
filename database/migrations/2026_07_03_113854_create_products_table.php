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
            $table->text('description')->nullable();
            $table->enum('category', ['digital', 'merch']);
            $table->decimal('price', 8, 2);
            $table->string('badge')->nullable();          // "Bestseller", "New", or null
            $table->string('image')->nullable();           // storage path, product thumbnail
            $table->string('digital_file')->nullable();    // storage path, only used when category = digital
            $table->boolean('is_active')->default(true);   // toggle visibility without deleting
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
