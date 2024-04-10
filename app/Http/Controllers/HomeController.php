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
        $productPrices = Product::pluck('price')->toArray();
        $productNames = Product::pluck('name')->toArray();
        $customerAges = Customer::pluck('age')->toArray();
        $customerStates = Customer::pluck('state')->toArray();
        // $customerGender = Customer::pluck('gender')->toArray();
        // $customerFeedback = Customer::pluck('feedback')->toArray();
        // $customerHealthImprovement = Customer::pluck('health_improvement')->toArray();

        return view('charts', compact('productPrices', 'productNames', 'customerAges', 'customerStates'));
        // return view('charts', compact('productPrices', 'productNames', 'customerAges', 'customerState', 'customerGender', 'customerFeedback', 'customerHealthImprovement'));
    }
    public function analytics()
    {
        return view('analytics');
    }
}
