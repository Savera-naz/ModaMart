<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define all product data.
        $productsData = [
            // Electronics Category
            [
                'name' => 'Smart TV 55" 4K UHD',
                'price' => 699.99,
                'image' => 'https://images.unsplash.com/photo-1593359677879-a4bb92f829d1?w=500&h=500&fit=crop',
                'description' => 'Crystal UHD 4K Smart TV with HDR and Smart Hub. Perfect for movie nights and gaming.',
                'category' => 'Electronics',
                // This array maps to the JSON 'features' column in your migration.
                'features' => ['55" Display', '4K Resolution', 'Smart TV', 'HDR', 'Voice Control'],
                'stock' => 35,
                'is_active' => true,
            ],
            [
                'name' => 'iPhone 15 Pro Max',
                'price' => 1199.99,
                'image' => 'https://images.unsplash.com/photo-1592750475338-74b7b21085ab?w=500&h=500&fit=crop',
                'description' => 'Latest iPhone with A17 Pro chip and titanium design. Professional-grade camera system.',
                'category' => 'Electronics',
                'features' => ['6.7" Display', 'A17 Pro Chip', '48MP Camera', '5G', 'Titanium Design'],
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'MacBook Pro 16"',
                'price' => 2399.99,
                'image' => 'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=500&h=500&fit=crop',
                'description' => 'Powerful laptop for professionals and creatives. Perfect for video editing and development.',
                'category' => 'Electronics',
                'features' => ['M3 Pro Chip', '16" Display', '18GB RAM', '1TB SSD', 'Liquid Retina XDR'],
                'stock' => 20,
                'is_active' => true,
            ],
            [
                'name' => 'Sony WH-1000XM5 Headphones',
                'price' => 349.99,
                'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=500&h=500&fit=crop',
                'description' => 'Industry-leading noise canceling headphones with exceptional sound quality.',
                'category' => 'Electronics',
                'features' => ['Noise Canceling', '30hr Battery', 'Touch Control', 'Hi-Fi Sound', 'Quick Charge'],
                'stock' => 80,
                'is_active' => true,
            ],

            // Fashion Category
            [
                'name' => 'Nike Air Jordan 1',
                'price' => 149.99,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500&h=500&fit=crop',
                'description' => 'Classic basketball shoes with modern comfort technology and iconic design.',
                'category' => 'Fashion',
                'features' => ['Leather Upper', 'Air Cushion', 'Classic Design', 'Multiple Colors', 'Comfort Fit'],
                'stock' => 120,
                'is_active' => true,
            ],
            [
                'name' => 'Levi\'s 501 Original Jeans',
                'price' => 89.99,
                'image' => 'https://images.unsplash.com/photo-1542272604-787c3835535d?w=500&h=500&fit=crop',
                'description' => 'Original fit jeans from the iconic Levi\'s brand. Timeless style and durability.',
                'category' => 'Fashion',
                'features' => ['100% Cotton', 'Original Fit', 'Button Fly', 'Classic Style', 'Durable'],
                'stock' => 90,
                'is_active' => true,
            ],
            [
                'name' => 'Leather Jacket',
                'price' => 199.99,
                'image' => 'https://images.unsplash.com/photo-1551028719-00167b16eac5?w=500&h=500&fit=crop',
                'description' => 'Genuine leather jacket for men with modern cut and classic styling.',
                'category' => 'Fashion',
                'features' => ['Genuine Leather', 'Multiple Pockets', 'Classic Design', 'All Seasons', 'Comfortable'],
                'stock' => 45,
                'is_active' => true,
            ],
            [
                'name' => 'Rolex Watch',
                'price' => 8999.99,
                'image' => 'https://images.unsplash.com/photo-1523170335258-f5ed11844a49?w=500&h=500&fit=crop',
                'description' => 'Luxury automatic watch with premium craftsmanship and timeless design.',
                'category' => 'Fashion',
                'features' => ['Automatic Movement', 'Water Resistant', 'Ceramic Bezel', 'Swiss Made', 'Luxury'],
                'stock' => 10,
                'is_active' => true,
            ],

            // Home & Kitchen Category
            [
                'name' => 'Dyson Vacuum Cleaner',
                'price' => 699.99,
                'image' => 'https://i5.walmartimages.com/asr/78d12801-b8d6-4616-9377-bf7aae3d89d8.a14cc2163530a936503b24df85d66e1b.jpeg',
                'description' => 'Cordless vacuum with powerful suction for complete home cleaning.',
                'category' => 'Home & Kitchen',
                'features' => ['Laser Detection', '60min Runtime', 'HEPA Filter', 'Cordless', 'Smart Display'],
                'stock' => 60,
                'is_active' => true,
            ],
            [
                'name' => 'KitchenAid Stand Mixer',
                'price' => 429.99,
                'image' => 'https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=500&h=500&fit=crop',
                'description' => 'Professional stand mixer for perfect baking results every time.',
                'category' => 'Home & Kitchen',
                'features' => ['5-Quart Bowl', '10 Speeds', 'Tilt-Head', 'Multiple Attachments', 'Durable'],
                'stock' => 70,
                'is_active' => true,
            ],
            [
                'name' => 'Instant Pot Pressure Cooker',
                'price' => 129.99,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS5FHxOEljnn3E6NcIJHp4gr_BCZuyv5_1iBA&s',
                'description' => 'Multi-functional pressure cooker for quick and easy meals.',
                'category' => 'Home & Kitchen',
                'features' => ['8-in-1 Function', 'Smart Programs', 'Stainless Steel', 'Easy Clean', 'Fast Cooking'],
                'stock' => 150,
                'is_active' => true,
            ],
            [
                'name' => 'Coffee Maker',
                'price' => 89.99,
                'image' => 'https://images.unsplash.com/photo-1495474472287-4d71bcdd2085?w=500&h=500&fit=crop',
                'description' => 'Programmable coffee maker with thermal carafe for perfect coffee every time.',
                'category' => 'Home & Kitchen',
                'features' => ['Programmable', 'Thermal Carafe', '24hr Brew', 'Auto Shut-off', 'Easy Clean'],
                'stock' => 110,
                'is_active' => true,
            ],
            [
                'name' => 'Air Fryer',
                'price' => 99.99,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTRcOT4fn6-1YTiURQVbyeJyaebvA2-K6Xl1A&s',
                'description' => 'Digital air fryer for healthy, crispy food with little to no oil.',
                'category' => 'Home & Kitchen',
                'features' => ['Digital Controls', '4-Quart Capacity', '6 Presets', 'Non-Stick', 'Rapid Air'],
                'stock' => 95,
                'is_active' => true,
            ],

            // Sports Category
            [
                'name' => 'Premium Yoga Mat',
                'price' => 39.99,
                'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=500&h=500&fit=crop',
                'description' => 'Non-slip yoga mat for all types of yoga practice with excellent cushioning.',
                'category' => 'Sports',
                'features' => ['Non-Slip Surface', '6mm Thickness', 'Eco-Friendly', 'Carry Strap', 'Durable'],
                'stock' => 200,
                'is_active' => true,
            ],
            [
                'name' => 'Tennis Racket',
                'price' => 189.99,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQygoIhtl9THd80uIjutfhDaxVDCGoZ2oIGRQ&s',
                'description' => 'Professional tennis racket for all levels with optimal balance.',
                'category' => 'Sports',
                'features' => ['Carbon Fiber', 'Optimal Balance', 'Shock Absorption', 'Professional Grade', 'Lightweight'],
                'stock' => 40,
                'is_active' => true,
            ],
            [
                'name' => 'Football',
                'price' => 49.99,
                'image' => 'https://upload.wikimedia.org/wikipedia/commons/1/1d/Football_Pallo_valmiina-cropped.jpg',
                'description' => 'Official match football for professional games and training.',
                'category' => 'Sports',
                'features' => ['FIFA Pro Certified', 'Thermal Bonding', 'Perfect Roundness', 'All Weather', 'Durable'],
                'stock' => 180,
                'is_active' => true,
            ],
            [
                'name' => 'Basketball',
                'price' => 34.99,
                'image' => 'https://images.unsplash.com/photo-1546519638-68e109498ffc?w=500&h=500&fit=crop',
                'description' => 'Official size basketball with perfect grip for indoor and outdoor play.',
                'category' => 'Sports',
                'features' => ['Official Size', 'Perfect Grip', 'Indoor/Outdoor', 'Durable', 'NBA Approved'],
                'stock' => 160,
                'is_active' => true,
            ],
            [
                'name' => 'Running Shoes',
                'price' => 119.99,
                'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=500&h=500&fit=crop',
                'description' => 'Lightweight running shoes with cushioning technology for maximum comfort.',
                'category' => 'Sports',
                'features' => ['Lightweight', 'Cushioning', 'Breathable', 'Shock Absorption', 'Durable'],
                'stock' => 100,
                'is_active' => true,
            ],

            // Beauty Category
            [
                'name' => 'Hair Dryer',
                'price' => 429.99,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTdMSwhb2lF_F_hJaQtJdPa1gIlVAAeCSTulQ&s',
                'description' => 'Professional hair dryer with intelligent heat control and fast drying.',
                'category' => 'Beauty',
                'features' => ['Intelligent Heat Control', 'Fast Drying', '4 Attachments', 'Quiet', 'Lightweight'],
                'stock' => 30,
                'is_active' => true,
            ],
            [
                'name' => 'Luxury Moisturizer',
                'price' => 185.00,
                'image' => 'https://images.preview.ph/preview/resize/images/2023/10/02/luxury-moisturizers-nm.webp',
                'description' => 'Luxury moisturizing cream with premium ingredients for all skin types.',
                'category' => 'Beauty',
                'features' => ['24hr Hydration', 'Luxury Formula', 'All Skin Types', 'Anti-Aging', 'SPF Protection'],
                'stock' => 75,
                'is_active' => true,
            ],
            [
                'name' => 'Makeup Brush Set',
                'price' => 59.99,
                'image' => 'https://images.unsplash.com/photo-1580870069867-74c57ee1bb07?w=500&h=500&fit=crop',
                'description' => 'Professional makeup brush set with synthetic bristles for flawless application.',
                'category' => 'Beauty',
                'features' => ['12 Brushes', 'Synthetic Bristles', 'Professional Quality', 'Travel Case', 'Easy Clean'],
                'stock' => 130,
                'is_active' => true,
            ],
            [
                'name' => 'Perfume Collection',
                'price' => 89.99,
                'image' => 'https://images.unsplash.com/photo-1541643600914-78b084683601?w=500&h=500&fit=crop',
                'description' => 'Elegant perfume collection with long-lasting fragrances for everyday wear.',
                'category' => 'Beauty',
                'features' => ['Long-lasting', 'Elegant Bottle', 'Multiple Scents', 'Day & Night', 'Luxury Packaging'],
                'stock' => 90,
                'is_active' => true,
            ],

            // Toys Category
            [
                'name' => 'LEGO Millennium Falcon',
                'price' => 159.99,
                'image' => 'https://images.unsplash.com/photo-1587654780291-39c9404d746b?w=500&h=500&fit=crop',
                'description' => 'Iconic Star Wars spaceship building set with detailed minifigures.',
                'category' => 'Toys',
                'features' => ['1353 Pieces', 'Display Stand', 'Minifigures', 'Ages 16+', 'Collectible'],
                'stock' => 50,
                'is_active' => true,
            ],
            [
                'name' => 'Barbie Dreamhouse',
                'price' => 199.99,
                'image' => 'https://images.unsplash.com/photo-1596461404969-9ae70f2830c1?w=500&h=500&fit=crop',
                'description' => '3-story dreamhouse with elevator and pool for endless imaginative play.',
                'category' => 'Toys',
                'features' => ['3 Stories', 'Working Elevator', 'Pool', '70+ Accessories', 'Light & Sound'],
                'stock' => 65,
                'is_active' => true,
            ],
            [
                'name' => 'Remote Control Car',
                'price' => 49.99,
                'image' => 'https://images.unsplash.com/photo-1581235720704-06d3acfcb36f?w=500&h=500&fit=crop',
                'description' => 'High-speed remote control car with realistic features and long-range control.',
                'category' => 'Toys',
                'features' => ['2.4GHz Remote', 'High Speed', 'Rechargeable', 'Off-road', 'LED Lights'],
                'stock' => 140,
                'is_active' => true,
            ],
            [
                'name' => 'Educational Robot',
                'price' => 79.99,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_Whfzz-TxnckbXEbAgrzyAtYEdnfeBfZ5QQ&s',
                'description' => 'Interactive educational robot that teaches coding and programming basics.',
                'category' => 'Toys',
                'features' => ['Coding Lessons', 'Voice Control', 'App Control', 'STEM Learning', 'Interactive'],
                'stock' => 85,
                'is_active' => true,
            ],
        ];

        // Loop through data and create/update products in the database.
        foreach ($productsData as $data) {
            // Add the slug based on the product name.
            $data['slug'] = Str::slug($data['name']);

            // Create or update the product using 'name' as the unique key.
            Product::updateOrCreate(
                ['name' => $data['name']], 
                $data
            );
        }
    }
}