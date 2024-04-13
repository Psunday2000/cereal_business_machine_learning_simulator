@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">Charts</div>
        <div class="card-body">
            <div class="row justify-content-center row-cols-1 row-cols-md-2 g-4">
                <div class="col">
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas id="productPricesChart" class="embed-responsive-item"></canvas>
                    </div>
                </div>
                <div class="col">
                    <div class="embed-responsive embed-responsive-16by9">
                        <canvas id="customerAgeDistro" class="embed-responsive-item"></canvas>
                    </div>
                </div>
                <div class="col">
                        <div class="embed-responsive embed-responsive-16by9">
                            <canvas id="customerStateChart" class="embed-responsive-item"></canvas>
                        </div>
                </div>                                                        
                <div class="col">
                        <div class="embed-responsive embed-responsive-16by9">
                            <canvas id="customerGenderChart" class="embed-responsive-item"></canvas>
                        </div>
                </div>                             
                <div class="col">
                        <div class="embed-responsive embed-responsive-16by9">
                            <canvas id="customerFeedbackChart" class="embed-responsive-item"></canvas>
                        </div>
                </div>                             
                <div class="col">
                        <div class="embed-responsive embed-responsive-16by9">
                            <canvas id="customerHealthChart" class="embed-responsive-item"></canvas>
                        </div>
                </div>                             
                <div class="col">
                        <div class="embed-responsive embed-responsive-16by9">
                            <canvas id="stockYearLineChart" class="embed-responsive-item"></canvas>
                        </div>
                </div>                             
                <div class="col">
                        <div class="embed-responsive embed-responsive-16by9">
                            <canvas id="stockSalesBarChart" class="embed-responsive-item"></canvas>
                        </div>
                </div>                             
            </div>
        </div>
    </div>
</div>
<script>
    const productPrices = @json($productPrices);
    const productNames = @json($productNames);
    const customerAges = @json($customerAges);
    const customerStates = @json($customerStates);
    const customerGender = @json($customerGender);
    const customerFeedback = @json($customerFeedback);
    const customerHealthImprovement = @json($customerHealthImprovement);
    const chartDataQuantitySold = @json($chartDataQuantitySold);
    const chartDataQuantityProduced = @json($chartDataQuantityProduced);
</script>
@endsection
