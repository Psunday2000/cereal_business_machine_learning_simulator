<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
}
