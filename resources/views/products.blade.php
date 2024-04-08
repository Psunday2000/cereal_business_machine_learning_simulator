<!DOCTYPE html>
<html>
<head>
    <title>Customer Data</title>
</head>
<body>
    <h1>Customer Data</h1>
    <table border="1">
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
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->health_improvement }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
