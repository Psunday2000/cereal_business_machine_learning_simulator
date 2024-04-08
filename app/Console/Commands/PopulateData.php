<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\DataPopulated;
use Carbon\Carbon;

class PopulateData extends Command
{
    protected $signature = 'populate:data';
    
    protected $description = 'Populate models with data using PHP Faker';

    public function handle()
    {
        $date = Carbon::now()->toDateString();

        $models = ['Customer', 'Product', 'Sale'];

        foreach ($models as $model) {
            if (!DataPopulated::where('model_name', $model)->where('date', $date)->exists()) {
                $this->populateModel($model);
                DataPopulated::create([
                    'model_name' => $model,
                    'date' => $date,
                ]);
            }
        }

        $this->info('Data populated successfully.');
    }

    private function populateModel($model)
    {
        $faker = \Faker\Factory::create();

        switch ($model) {
            case 'Customer':
                for ($i = 0; $i < 10; $i++) {
                    \App\Models\Customer::create([
                        'state' => $faker->state,
                        'gender' => $faker->randomElement(['Male', 'Female']),
                        'age' => $faker->numberBetween(18, 65),
                        'feedback' => $faker->sentence,
                        'health_improvement' => $faker->sentence,
                    ]);
                }
                break;
            case 'Product':
                for ($i = 0; $i < 5; $i++) {
                    \App\Models\Product::create([
                        'name' => $faker->word,
                        'description' => $faker->sentence,
                        'price' => $faker->randomFloat(2, 1, 100),
                    ]);
                }
                break;
            case 'Sale':
                for ($i = 0; $i < 20; $i++) {
                    $customer = \App\Models\Customer::inRandomOrder()->first();
                    $sale = \App\Models\Sale::create([
                        'customer_id' => $customer->id,
                        'date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                        'total_amount' => $faker->randomFloat(2, 10, 1000),
                    ]);

                    $products = \App\Models\Product::inRandomOrder()->limit(rand(1, 3))->get();
                    $sale->products()->attach($products);
                }
                break;
        }
    }
}
