<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Sale;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
{   
    $productCount = Product::count();
    $customerCount = Customer::count();
    $stockCount = Stock::count();
    $saleCount = Sale::count();

    return view('home', [
        'productCount' => $productCount,
        'customerCount' => $customerCount,
        'stockCount' => $stockCount,
        'saleCount' => $saleCount,
    ]);
}
    public function graphs()
    {
        return view('graphs');
    }
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
        
        // Function to fetch and process data
    function fetchAndProcessData($quantityField)
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

        $chartDataQuantitySold = fetchAndProcessData('quantity_sold');

        // Usage for quantity_produced
        $chartDataQuantityProduced = fetchAndProcessData('quantity_produced');

        return view('charts', compact('productPrices', 'productNames', 'customerAges', 'customerStates', 'customerGender', 'customerFeedback', 'customerHealthImprovement', 'chartDataQuantitySold', 'chartDataQuantityProduced'));
    }
    public function analytics()
    {
        return view('analytics');
    }
}
