<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Sale;

class SalesTableSeeder extends Seeder
{
    public function run()
{
    $stocks = Stock::all();

    foreach ($stocks as $stock) {
        $this->seedSalesForStock($stock);
    }
}

private function seedSalesForStock($stock)
{
    $product = Product::find($stock->product_id);
    $quantityAvailable = $stock->quantity_sold;

    // Generate frequencies that sum up to the original stock quantity
    $frequencies = [];
    $remainingQuantity = $quantityAvailable;
    while ($remainingQuantity > 0) {
        $frequency = min(rand(10, 100), $remainingQuantity); // Generate a frequency that doesn't exceed the remaining quantity
        $frequencies[] = $frequency;
        $remainingQuantity -= $frequency;
    }

    shuffle($frequencies); // Shuffle the frequencies array
    $customers = Customer::inRandomOrder()->take(array_sum($frequencies))->get()->toArray(); // Convert to array
    shuffle($customers); // Shuffle the customers array

    $i = 0; // Index for frequencies array
    foreach ($frequencies as $frequency) {
        $customer = $customers[$i];
        $date = $stock->year . '-' . rand(1, 12) . '-' . rand(1, 28);

        Sale::create([
            'customer_id' => $customer['id'], // Access the 'id' property of the customer array
            'product_id' => $product->id,
            'quantity' => $frequency,
            'year' => $stock->year,
            'date' => $date,
            'total_amount' => $frequency * $product->price,
        ]);

        $i++;
    }

    // Check if the total quantity sold matches the stock quantity_sold
    $totalQuantitySold = Sale::where('product_id', $stock->product_id)
                             ->where('year', $stock->year)
                             ->sum('quantity');
    if ($stock->quantity_sold != $totalQuantitySold) {
        echo "Total quantity sold for product {$product->name} in {$stock->year} does not match the stock quantity sold.\n";
    }
}


}
