@extends('layouts.app')
@section('content')
<div class="container">
    <div class="card col-10 offset-1">
        <div class="card-header">
            Customer Data
        </div>
        <div class="card-body">
            <h5 class="card-title">Customers</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="customers-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>State</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Feedback</th>
                            <th>Health Improvement</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr>
                                <td>{{ $customer->id }}</td>
                                <td>{{ $customer->state }}</td>
                                <td>{{ $customer->gender }}</td>
                                <td>{{ $customer->age }}</td>
                                <td>{{ $customer->feedback }}</td>
                                <td>{{ $customer->health_improvement }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex">
                    {!! $customers->links() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
