<!-- resources/views/admin/CarWashingBusiness.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Car Washing Business Setup</title>
</head>
<body>

<h2>Car Washing Business Setup</h2>

<form method="post" action="{{ route('saveBusiness') }}">
    @csrf

    <label for="industrial_lines">Industrial Lines:</label>
    <input type="number" name="industrial_lines" min="1" max="4" required>

    <label for="open_time">Open Time:</label>
    <select name="open_time" required>
        @for ($hour = 9; $hour <= 18; $hour++)
            <option value="{{ $hour }}:00">{{ $hour }}:00</option>
        @endfor
    </select>

    <label for="close_time">Close Time:</label>
    <select name="close_time" required>
        @for ($hour = 11; $hour <= 20; $hour++)
            <option value="{{ $hour }}:00">{{ $hour }}:00</option>
        @endfor
    </select>

    <button type="submit">Save</button>
</form>

</body>
</html>
