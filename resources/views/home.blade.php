@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="container px-4 py-5" id="custom-cards">
                <div class="card col-10 offset-1">
                    <div class="card-header">
                        Home
                    </div>
                    <div class="card-body">
                      <h5 class="card-title">Cereal Business Data Presentation</h5>
                      <p class="card-text">This project simulates the use of  data analysis for predictions in a cereal business.</p>
                      <a href="/home" class="btn btn-primary">Happy Viewing!</a>        
                        <div class="row row-cols-1 row-cols-md-2 g-4 py-5">
                            {{-- Products Card Start --}}
                            <div class="col">
                                <a href="/products" class="text-decoration-none">
                                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 border-white shadow-lg" style="background-image: url('{{ asset('images/products.jpeg') }}'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
                                        <div class="d-flex flex-column h-100 p-3 pb-2 text-shadow-1">
                                            <h3 class="pt-3 mt-3 mb-2 display-6 lh-1 fw-bold">Products</h3>
                                            <ul class="d-flex list-unstyled mt-auto">
                                                <li class="me-auto">
                                                    <i class="fas fa-cubes fa-2x"></i>
                                                </li>
                                                <li class="d-flex align-items-center me-3">
                                                    <strong class="products-count count" data-target="{{ $productCount }}">0</strong>
                                                </li>        
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            {{-- Products Card Stop --}}
                            
                            {{-- Customers Card Start --}}
                            <div class="col">
                                <a href="/customers" class="text-decoration-none">
                                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 border-white shadow-lg" style="background-image: url('{{ asset('images/customers.jpg') }}'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
                                        <div class="d-flex flex-column h-100 p-3 pb-2 text-shadow-1">
                                            <h3 class="pt-3 mt-3 mb-2 display-6 lh-1 fw-bold">Customers</h3>
                                            <ul class="d-flex list-unstyled mt-auto">
                                                <li class="me-auto">
                                                    <i class="fas fa-users fa-2x"></i>
                                                </li>
                                                <li class="d-flex align-items-center me-3">
                                                    <strong class="customers-count count" data-target="{{ $customerCount }}">0</strong>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            {{-- Customers Card Stop --}}
                            
                            {{-- Stocks Card Start --}}
                            <div class="col">
                                <a href="/stocks" class="text-decoration-none text-secondary">
                                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 border-white shadow-lg" style="background-image: url('{{ asset('images/stock.jpg') }}'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
                                        <div class="d-flex flex-column h-100 p-3 pb-2 text-shadow-1">
                                            <h3 class="pt-3 mt-3 mb-2 display-6 lh-1 fw-bold">Stocks</h3>
                                            <ul class="d-flex list-unstyled mt-auto">
                                                <li class="me-auto">
                                                    <i class="fas fa-boxes fa-2x"></i>
                                                </li>
                                                <li class="d-flex align-items-center me-3">
                                                    <strong class="stocks-count count" data-target="{{ $stockCount }}">0</strong>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            {{-- Stocks Card Stop --}}
                            
                            {{-- Sales Card Start --}}
                            <div class="col">
                                <a href="/sales" class="text-decoration-none text-dark">
                                    <div class="card card-cover h-100 overflow-hidden text-bg-dark rounded-4 border-white shadow-lg" style="background-image: url('{{ asset('images/sales.jpg') }}'); background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
                                        <div class="d-flex flex-column h-100 p-3 pb-2 text-shadow-1">
                                            <h3 class="pt-3 mt-3 mb-2 display-6 lh-1 fw-bold">Sales</h3>
                                            <ul class="d-flex list-unstyled mt-auto">
                                                <li class="me-auto">
                                                    <i class="fas fa-chart-line fa-2x"></i>
                                                </li>
                                                <li class="d-flex align-items-center me-3">
                                                    <strong class="sales-count count" data-target="{{ $saleCount }}">0</strong>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            {{-- Sales Card Stop --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const counts = document.querySelectorAll('.count');

        counts.forEach(countElement => {
            const target = parseInt(countElement.dataset.target);
            const duration = 1000; 
            countUp(countElement, target, duration);
        });
    });

    function countUp(element, target, duration) {
        let start = 0;
        const increment = target / duration;
        const interval = setInterval(() => {
            start += increment;
            element.textContent = Math.round(start);
            if (start >= target) {
                element.textContent = target;
                clearInterval(interval);
            }
        }, 1);
    }
</script>
@endsection
