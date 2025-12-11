<?php

namespace App\Models;

class Category
{
    public static function getAllCategories()
    {
        $products = \App\Models\Product5::getAllProducts();
        
        return [
            [
                'name' => 'Electronics',
                'image' => 'https://images.unsplash.com/photo-1498049794561-7780e7231661?w=400&h=300&fit=crop',
                'count' => count(array_filter($products, function($product) {
                    return $product['category'] === 'Electronics';
                })),
                'description' => 'Latest gadgets, smartphones, laptops, and home electronics'
            ],
            [
                'name' => 'Fashion',
                'image' => 'https://images.unsplash.com/photo-1445205170230-053b83016050?w=400&h=300&fit=crop',
                'count' => count(array_filter($products, function($product) {
                    return $product['category'] === 'Fashion';
                })),
                'description' => 'Trendy clothing, shoes, accessories and luxury items'
            ],
            [
                'name' => 'Home & Kitchen',
                'image' => 'https://images.unsplash.com/photo-1556228453-efd6c1ff04f6?w=400&h=300&fit=crop',
                'count' => count(array_filter($products, function($product) {
                    return $product['category'] === 'Home & Kitchen';
                })),
                'description' => 'Appliances, cookware, and home improvement essentials'
            ],
            [
                'name' => 'Sports',
                'image' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=400&h=300&fit=crop',
                'count' => count(array_filter($products, function($product) {
                    return $product['category'] === 'Sports';
                })),
                'description' => 'Fitness equipment, sports gear and outdoor activities'
            ],
            [
                'name' => 'Beauty',
                'image' => 'https://images.unsplash.com/photo-1596462502278-27bfdc403348?w=400&h=300&fit=crop',
                'count' => count(array_filter($products, function($product) {
                    return $product['category'] === 'Beauty';
                })),
                'description' => 'Skincare, makeup, haircare and personal grooming'
            ],
            [
                'name' => 'Toys',
                'image' => 'https://images.unsplash.com/photo-1596461404969-9ae70f2830c1?w=400&h=300&fit=crop',
                'count' => count(array_filter($products, function($product) {
                    return $product['category'] === 'Toys';
                })),
                'description' => 'Educational toys, games and fun for all ages'
            ]
        ];
    }

    public static function getCategoryNames()
    {
        return ['All Categories', 'Electronics', 'Fashion', 'Home & Kitchen', 'Sports', 'Beauty', 'Toys'];
    }

    public static function getCategoryByName($name)
    {
        $categories = self::getAllCategories();
        foreach ($categories as $category) {
            if ($category['name'] === $name) {
                return $category;
            }
        }
        return null;
    }
}