@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card col-10 offset-1">
        <div class="card-header">
            Stock Data
        </div>
        <div class="card-body">
            <h5 class="card-title">Stock</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="stocks-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Year</th>
                            <th>Product Name</th>
                            <th>Quantity Produced</th>
                            <th>Quantity Sold</th>
                            <th>Leftover Stock</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($stocks as $stock)
                            @php
                                $product = \App\Models\Product::find($stock->product_id);
                            @endphp
                            <tr>
                                <td>{{ $stock->id }}</td>
                                <td>{{ $stock->year }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $stock->quantity_produced }}</td>
                                <td>{{ $stock->quantity_sold }}</td>
                                <td>{{ $stock->leftover_stock }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-start">
                    {!! $stocks->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
