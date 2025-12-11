<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // Basic product info
            $table->string('name');
            $table->string('slug')->unique()->nullable(); // optional, useful for friendly URLs
            $table->text('description')->nullable();

            // Image must be a string URL (you asked specifically for string URLs)
            $table->string('image')->nullable();

            // Category as simple string (you were using $product['category'] in blade)
            $table->string('category')->default('Uncategorized');

            // Features stored as JSON (blade expects an array $product['features'])
            $table->json('features')->nullable();

            // Pricing
            $table->decimal('price', 10, 2)->default(0.00);

            // Optional inventory / status fields
            $table->integer('stock')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Indexes for searching/filtering
            $table->index('category');
            $table->index('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
