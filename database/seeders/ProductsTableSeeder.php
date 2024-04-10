<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $products = [
        ['name' => 'Rice', 'price' => 80000.00, 'quantity_produced' => 10000, 'quantity_sold' => 9500],
        ['name' => 'Maize', 'price' => 65000.00, 'quantity_produced' => 5000, 'quantity_sold' => 4700],
        ['name' => 'Wheat', 'price' => 70000.00, 'quantity_produced' => 8000, 'quantity_sold' => 7800],
        ['name' => 'Groundnut', 'price' => 60000.00, 'quantity_produced' => 3000, 'quantity_sold' => 2500],
    ];

    foreach ($products as $product) {
        $quantityProduced = $product['quantity_produced'];
        $quantitySold = $product['quantity_sold'];
        $quantityRemaining = $quantityProduced - $quantitySold;

        \App\Models\Product::create([
            'name' => $product['name'],
            'description' => '50kg bag of ' . $product['name'],
            'price' => $product['price'],
            'quantity_produced' => $quantityProduced,
            'quantity_sold' => $quantitySold,
            'quantity_remaining' => $quantityRemaining,
        ]);
    }
}

}
