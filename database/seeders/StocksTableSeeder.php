<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Stock;

class StocksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $products = Product::all();

        for ($year = 2020; $year <= 2024; $year++) {
            foreach ($products as $product) {
                $lastYear = $year - 1;
                $lastYearStock = Stock::where('year', $lastYear)
                                        ->where('product_id', $product->id)
                                        ->first();

                // Define quantities based on product name
                $quantityProduced = $this->getQuantityProduced($product->name);
                $quantitySold = rand(50000, $quantityProduced); // Random quantity sold (up to the quantity produced)
                $quantityRemaining = $quantityProduced - $quantitySold; // Quantity remaining in stock

                // If there is leftover stock from the previous year, add it to the quantity produced
                if ($lastYearStock) {
                    $quantityProduced += $lastYearStock->leftover_stock;
                }

                Stock::create([
                    'year' => $year,
                    'product_id' => $product->id,
                    'quantity_produced' => $quantityProduced,
                    'quantity_sold' => $quantitySold,
                    'leftover_stock' => $quantityRemaining,
                ]);
            }
        }
    }

    private function getQuantityProduced($productName)
    {
        switch ($productName) {
            case 'Rice':
                return 100000;
            case 'Maize':
                return 70000;
            case 'Wheat':
                return 80000;
            case 'Groundnut':
                return 60000;
            default:
                return 0;
        }
    }
}