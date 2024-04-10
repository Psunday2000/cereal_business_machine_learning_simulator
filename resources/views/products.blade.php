@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card col-10 offset-1">
        <div class="card-header">
            Products Data
        </div>
        <div class="card-body">
            <h5 class="card-title">Products</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="products-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->id }}</td>
                            <td>{{ $product->name }}</td>
                            <td>{{ $product->description }}</td>
                            <td><span>&#8358;</span> {{$product->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>    
            </div>
        </div>
    </div>
</div>
@endsection
