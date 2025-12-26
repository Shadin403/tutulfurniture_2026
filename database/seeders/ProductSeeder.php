<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductproductDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class ProductSeeder extends Seeder
{
    public function run()
    {
        $now = Carbon::now();

        // Product 1 - Sofa
        $product1 = Product::create([

            'name' => 'Premium Leather Sofa',
            'slug' => 'premium-leather-sofa',
            'SKU' => 'FUR-001',
            'stock_status' => 'instock',
            'quantity' => 10,
            'featured' => 1,
            'views' => 150,
            'is_active' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $product1->productDetail()->create([
            'material' => 'Full Grain Leather',
            'weight' => '120',
            'color' => 'Chestnut Brown',
            'description' => 'Handcrafted premium leather sofa with solid wood frame',
            'regular_price' => 2499.99,
            'discount_price' => 1999.99,

            'extra_info' => 'Includes 3 throw pillows',
            'warranty' => '5 Years',
            'indoor_outdoor' => 'Indoor',
            'meta_title' => 'Luxury Leather Sofa',
            'meta_description' => 'Premium quality leather sofa for your living room',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Product 2 - Dining Table
        $product2 = Product::create([

            'name' => 'Oak Dining Table',
            'slug' => 'oak-dining-table',
            'SKU' => 'FUR-002',
            'stock_status' => 'instock',
            'quantity' => 8,
            'featured' => 0,
            'views' => 95,
            'is_active' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $product2->productDetail()->create([
            'material' => 'Solid Oak',
            'weight' => '85',
            'color' => 'Natural Wood',
            'description' => '6-seater dining table with sturdy construction',
            'regular_price' => 899.99,
            'discount_price' => 799.99,

            'extra_info' => 'Matching chairs available',
            'warranty' => '2 Years',
            'indoor_outdoor' => 'Indoor',
            'meta_title' => 'Oak Dining Table',
            'meta_description' => 'Rustic dining table for family meals',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Product 3 - Office Chair
        $product3 = Product::create([

            'name' => 'Ergonomic Office Chair',
            'slug' => 'ergonomic-office-chair',
            'SKU' => 'FUR-003',
            'stock_status' => 'instock',
            'quantity' => 15,
            'featured' => 1,
            'views' => 200,
            'is_active' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $product3->productDetail()->create([
            'material' => 'Mesh Fabric',
            'weight' => '32',
            'color' => 'Black',
            'description' => 'Adjustable office chair with lumbar support',
            'regular_price' => 299.99,
            'discount_price' => 249.99,

            'extra_info' => '360-degree swivel',
            'warranty' => '3 Years',
            'indoor_outdoor' => 'Indoor',
            'meta_title' => 'Office Chair',
            'meta_description' => 'Comfortable chair for workspace',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Product 4 - Bookshelf
        $product4 = Product::create([

            'name' => 'Industrial Bookshelf',
            'slug' => 'industrial-bookshelf',
            'SKU' => 'FUR-004',
            'stock_status' => 'instock',
            'quantity' => 12,
            'featured' => 0,
            'views' => 80,
            'is_active' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $product4->productDetail()->create([
            'material' => 'Metal & Wood',
            'weight' => '65',
            'color' => 'Black/Brown',
            'description' => '5-shelf industrial style bookcase',
            'regular_price' => 399.99,
            'discount_price' => 349.99,

            'extra_info' => 'Assembly required',
            'warranty' => '1 Year',
            'indoor_outdoor' => 'Indoor',
            'meta_title' => 'Industrial Bookshelf',
            'meta_description' => 'Stylish storage for books and decor',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        // Product 5 - Coffee Table
        $product5 = Product::create([

            'name' => 'Glass Coffee Table',
            'slug' => 'glass-coffee-table',
            'SKU' => 'FUR-005',
            'stock_status' => 'instock',
            'quantity' => 7,
            'featured' => 1,
            'views' => 110,
            'is_active' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $product5->productDetail()->create([
            'material' => 'Glass & Metal',
            'weight' => '28',
            'color' => 'Clear/Chrome',
            'description' => 'Modern coffee table with chrome frame',
            'regular_price' => 349.99,
            'discount_price' => 299.99,

            'extra_info' => 'Wipe clean with glass cleaner',
            'warranty' => '1 Year',
            'indoor_outdoor' => 'Indoor',
            'meta_title' => 'Glass Coffee Table',
            'meta_description' => 'Elegant table for living room',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
