<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="{{ asset('css/booking.css') }}">
</head>
<body>
    <div class="container">
        <h1>Booking Details</h1>

        <form method="POST" action="{{ route('bookings.store') }}">
            @csrf

            <div class="form-group">
                <label for="service_id">Service</label>
                <select id="service_id" type="text" class="form-control @error('service_id') is-invalid @enderror" name="service_id" value="{{ old('service_id') }}" required autocomplete="service_id" autofocus>
                    <option value="">-- Select Service --</option>
                    @foreach($services as $service)
                        <option value="{{ $service->id }}">{{ $service->name }}</option>
                    @endforeach
                </select>
                @error('service_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="booking_datetime">Booking Date and Time</label>
                <input id="booking_datetime" type="datetime-local" class="form-control @error('booking_datetime') is-invalid @enderror" name="booking_datetime" value="{{ old('booking_datetime') }}" required autocomplete="booking_datetime" autofocus>
                @error('booking_datetime')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="first_name">First Name</label>
                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="last_name">Last Name</label>
                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name" autofocus>
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="phone_number">Phone Number</label>
                <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number" autofocus>
                @error('phone_number')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Book</button>
        </form>
    </div>
</body>
</html>