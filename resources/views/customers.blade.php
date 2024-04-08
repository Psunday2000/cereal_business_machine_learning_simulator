<!DOCTYPE html>
<html>
<head>
    <title>Product Data</title>
</head>
<body>
    <h1>Product Data</h1>
    <table border="1">
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
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->state }}</td>
                    <td>{{ $product->gender }}</td>
                    <td>{{ $product->age }}</td>
                    <td>{{ $product->feedback }}</td>
                    <td>{{ $product->health_improvement }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
