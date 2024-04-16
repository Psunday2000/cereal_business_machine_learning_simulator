<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Sale;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChartController extends Controller
{
    public function charts()
    {
        // Fetch Product Columns
        $productPrices = Product::pluck('price')->toArray();
        $productNames = Product::pluck('name')->toArray();

        // Fetch Customer Columns
        $customerAges = Customer::pluck('age')->toArray();
        $customerStates = Customer::pluck('state')->toArray();
        $customerGender = Customer::pluck('gender')->toArray();
        $customerFeedback = Customer::pluck('feedback')->toArray();
        $customerHealthImprovement = Customer::pluck('health_improvement')->toArray();

        // Generate chart data for quantity_sold
        $chartDataQuantitySold = $this->fetchAndProcessData('quantity_sold');

        // Generate chart data for quantity_produced
        $chartDataQuantityProduced = $this->fetchAndProcessData('quantity_produced');

        $topStates = Customer::select('state')
            ->groupBy('state')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(5)
            ->pluck('state')
            ->toArray();

        $salesDataByState = [];

        foreach ($topStates as $state) {
            $totalSales = Sale::join('customers', 'sales.customer_id', '=', 'customers.id')
                ->where('customers.state', $state)
                ->sum('total_amount');

            $salesDataByState[$state] = $totalSales;
        }

        $ageGroupSales = [
            '0-20' => 0,
            '21-40' => 0,
            '41-60' => 0,
            '61-80' => 0,
            '81+' => 0,
        ];
        
        $ageRanges = [
            '0-20' => [0, 20],
            '21-40' => [21, 40],
            '41-60' => [41, 60],
            '61-80' => [61, 80],
            '81+' => [81, null],
        ];
        
        $customerSalesCounts = Sale::join('customers', 'sales.customer_id', '=', 'customers.id')
            ->select('customers.age', DB::raw('COUNT(sales.id) as sales_count'))
            ->groupBy('customers.age')
            ->get()
            ->keyBy('age')
            ->toArray();
        
        foreach ($ageRanges as $rangeKey => $range) {
            [$minAge, $maxAge] = $range;
            foreach ($customerSalesCounts as $customerAge => $salesCount) {
                if (($maxAge === null && $customerAge >= $minAge) || ($customerAge >= $minAge && $customerAge <= $maxAge)) {
                    $ageGroupSales[$rangeKey] += $salesCount['sales_count'];
                }
            }
        }
        
        // Pass all the data to the view
        return view('charts', compact('productPrices', 'productNames', 'customerAges', 'customerStates', 'customerGender', 'customerFeedback', 'customerHealthImprovement', 'chartDataQuantitySold', 'chartDataQuantityProduced', 'salesDataByState', 'ageGroupSales'));
    }


    public function analytics()
    {
        return view('analytics');
    }

    private function fetchAndProcessData($quantityField)
    {
        // Fetch the data
        $data = Stock::join('products', 'stocks.product_id', '=', 'products.id')
            ->select('products.name as product_name', 'stocks.year', "stocks.$quantityField")
            ->orderBy('stocks.year')
            ->get();

        // Group the data by year
        $groupedData = [];
        foreach ($data as $item) {
            $year = $item->year;
            $productName = $item->product_name;
            $quantity = $item->$quantityField;

            if (!isset($groupedData[$year])) {
                $groupedData[$year] = [];
            }

            $groupedData[$year][$productName] = $quantity;
        }

        // Prepare the chart data
        $chartData = [
            'labels' => array_keys($groupedData),
            'datasets' => [],
        ];

        foreach ($groupedData[key($groupedData)] as $productName => $_) {
            $dataset = [
                'label' => $productName,
                'data' => [],
            ];

            foreach ($groupedData as $yearData) {
                $dataset['data'][] = isset($yearData[$productName]) ? $yearData[$productName] : 0;
            }

            $chartData['datasets'][] = $dataset;
        }

        return $chartData;
    }

}
