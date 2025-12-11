<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'category',
        'features',
        'price',
        'stock',
        'is_active',
    ];

    protected $casts = [
        'features' => 'array',   // Automatically convert JSON → array and array → JSON
        'is_active' => 'boolean',
        'price' => 'decimal:2',
    ];

    // Optional: Auto-generate slug on create
    protected static function booted()
    {
        static::creating(function ($product) {
            if (empty($product->slug)) {
                $product->slug = \Str::slug($product->name) . '-' . uniqid();
            }
        });
    }
}
