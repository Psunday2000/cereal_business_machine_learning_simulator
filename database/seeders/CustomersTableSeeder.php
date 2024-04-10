<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
{
    $startYear = 2020;
    $endYear = 2024;

    for ($year = $startYear; $year <= $endYear; $year++) {
        $amplitude = ($year % 2 == 0) ? 5000 : 2500; // Amplitude of the sinusoidal curve
        $frequency = 0.25; // Frequency of the sinusoidal curve
        $baseCustomers = ($year == $endYear) ? 9800 : $amplitude * 2; // Base number of customers

        $customers = $baseCustomers + round($amplitude * sin(2 * M_PI * $frequency * ($year - $startYear)), 0);

        for ($i = 0; $i < $customers; $i++) {
            $gender = rand(0, 1) ? 'Male' : 'Female'; // Random gender
            $state = $this->getRandomState(); // Random state
            $age = rand(18, 90); // Random age

            $feedback = $this->getRandomFeedback(); // Random feedback
            $healthImprovement = ($feedback == 'Positive') ? 'Improved health condition' : (($feedback == 'Neutral') ? 'Rather not say' : 'Reduced health condition');

            // Generate random date within the year
            $month = str_pad(rand(1, 12), 2, '0', STR_PAD_LEFT); // Random month
            $day = str_pad(rand(1, 28), 2, '0', STR_PAD_LEFT); // Random day (assuming 28 days in each month)

            $createdAt = $year . '-' . $month . '-' . $day;

            \App\Models\Customer::create([
                'state' => $state,
                'gender' => $gender,
                'age' => $age,
                'feedback' => $feedback,
                'health_improvement' => $healthImprovement,
                'created_at' => $createdAt,
            ]);
        }
    }
}

private function getRandomState()
{
    $states = [
        'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 'Cross River', 'Delta', 'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Gombe', 'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi', 'Kwara', 'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba', 'Yobe', 'Zamfara',
    ];

    return $states[array_rand($states)];
}

private function getRandomFeedback()
{
    $feedbacks = ['Positive', 'Neutral', 'Negative'];
    return $feedbacks[array_rand($feedbacks)];
} 
}
