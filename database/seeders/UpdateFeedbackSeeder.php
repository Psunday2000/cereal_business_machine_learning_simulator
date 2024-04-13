<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;

class UpdateFeedbackSeeder extends Seeder
{
    public function run()
    {
        $states = [
            'Abia', 'Adamawa', 'Akwa Ibom', 'Anambra', 'Bauchi', 'Bayelsa', 'Benue', 'Borno', 'Cross River', 'Delta',
            'Ebonyi', 'Edo', 'Ekiti', 'Enugu', 'Gombe', 'Imo', 'Jigawa', 'Kaduna', 'Kano', 'Katsina', 'Kebbi', 'Kogi',
            'Kwara', 'Lagos', 'Nasarawa', 'Niger', 'Ogun', 'Ondo', 'Osun', 'Oyo', 'Plateau', 'Rivers', 'Sokoto', 'Taraba',
            'Yobe', 'Zamfara'
        ];
        
        $totalCustomers = 39800;
        $maxCustomersPerState = 15000;
        $totalStates = count($states);
        
        // Generate random frequencies for each state
        $frequencies = [];
        $remainingCustomers = $totalCustomers;
        while ($remainingCustomers > 0) {
            $customersToAdd = min(rand(10, $maxCustomersPerState), $remainingCustomers);
            $frequencies[] = $customersToAdd;
            $remainingCustomers -= $customersToAdd;
        }
        
        // Ensure that $frequencies has enough elements to match the number of states
        while (count($frequencies) < $totalStates) {
            $frequencies[] = 0;
        }
        
        // Assign customers to states based on frequencies
        $stateCustomers = [];
        shuffle($states); // Randomize the order of states
        foreach ($states as $index => $state) {
            $stateCustomers[$state] = $frequencies[$index];
        }
        
        // Update customers with the corresponding states
        $customers = Customer::all();
        foreach ($stateCustomers as $state => $customersCount) {
            $customersToUpdate = $customers->splice(0, $customersCount);
            foreach ($customersToUpdate as $customer) {
                $customer->state = $state;
                $customer->save();
            }
        }
           
    }
}
