<!DOCTYPE html>
<html>
<head>
    <title>Sales Data</title>
</head>
<body>
    <h1>Sales Data</h1>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer ID</th>
                <th>Date</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sales as $sale)
                <tr>
                    <td>{{ $sale->id }}</td>
                    <td>{{ $sale->customer_id }}</td>
                    <td>{{ $sale->date }}</td>
                    <td>{{ $sale->total_amount }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
