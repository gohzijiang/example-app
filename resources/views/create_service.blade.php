<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Service</title>
    <link rel="stylesheet" href="{{ asset('css/create-service.css') }}">
</head>
<body>
    <h2>Create Service</h2>

    <form action="{{ route('services.store') }}" method="post">
        <label for="name">Service Name:</label>
        <input type="text" name="name" required><br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea><br>

        <label for="price">Price:</label>
        <input type="text" name="price" required><br>

        <label for="duration">Duration (in minutes):</label>
        <input type="text" name="duration" required><br>

        <button type="submit">Create Service</button>
    </form>
</body>
</html>
