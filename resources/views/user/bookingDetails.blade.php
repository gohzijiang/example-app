<!DOCTYPE html>
<link rel="stylesheet" href="{{ asset('css/bookingDetails.css') }}">
<html>
<head>
    <title>Booking Details</title>
</head>
<body>
    <h1>Booking Details</h1>
    
    <table>
        <tr>
            <th>Booking ID:</th>
            <td>{{ $booking->id }}</td>
        </tr>
        <tr>
            <th>Booking Date Time:</th>
            <td>{{ $booking->booking_datetime }}</td>
        </tr>
        
        <tr>
            <th>First Name:</th>
            <td>{{ $booking->first_name }}</td>
        </tr>
        <tr>
            <th>Last Name:</th>
            <td>{{ $booking->last_name }}</td>
        </tr>
        <tr>
            <th>Phone Number:</th>
            <td>{{ $booking->phone_number }}</td>
        </tr>
        <tr>
            <th>Address:</th>
            <td>{{ $booking->address }}</td>
        </tr>
        <tr>
            <th>Note:</th>
            <td>{{ $booking->note }}</td>
        </tr>
        <tr>
            <th>Total Price:</th>
            <td>{{ $booking->total_price }}</td>
        </tr>

        <tr>
            <td colspan="2">
                <button onclick="redirectToCheckout()">Proceed to Checkout</button>
            </td>
        </tr>            

    </table>
    <script>
        function redirectToCheckout() {
            window.location.href = "{{ route('checkout') }}";
        }
    </script>
</body>
</html>
