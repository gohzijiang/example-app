
@extends('layouts.app')

@section('content')
<h2>Create a New Service</h2>

<form method="POST" action="{{ route('services.store') }}">
    @csrf

    <label for="name">Service Name:</label>
    <input type="text" name="name" required>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea>

    <label for="price">Price:</label>
    <input type="number" name="price" step="0.01" required>

    <label for="duration">Duration (minutes):</label>
    <input type="number" name="duration" required>


    <button type="submit">Create Service</button>
</form>


@endsection
