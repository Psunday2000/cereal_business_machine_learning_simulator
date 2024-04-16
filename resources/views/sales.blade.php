@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card col-10 offset-1">
        <div class="card-header">
            Sales Data
        </div>
        <div class="card-body">
            <h5 class="card-title">Sales</h5>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a class="text-decoration-none text-dark" href="/home">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Sales</li>
                </ol>
            </nav>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="sales-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>State</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($sales as $sale)
                            @php
                                $customer = \App\Models\Customer::find($sale->customer_id);
                                $product = \App\Models\Product::find($sale->product_id);
                            @endphp
                            <tr>
                                <td>{{ $sale->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $sale->quantity }}</td>
                                <td>{{ \Illuminate\Support\Carbon::parse($sale->date)->format('Y-m-d') }}</td>
                                <td>{{ $sale->total_amount }}</td>
                                <td>{{ $customer->state }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex">
                    {!! $sales->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
