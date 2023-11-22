<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Form</title>
</head>

<body>
    <h2>Test Form</h2>

    <form method="POST" action="{{route('test.tryStore')}}">
        @csrf

        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" required>

        <label for="age">Age:</label>
        <input type="number" name="age" id="age" required>

        <button type="submit">Submit</button>
    </form>
</body>

</html>
