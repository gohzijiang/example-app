<!-- resources/views/user/index.blade.php -->
<!DOCTYPE html>
<html lang="en">

@guest
    @if (Route::has('login'))
        <script>
            window.location.href='{{ route('login') }}'
        </script>
    @endif
@else
    @if (Auth::user()->is_admin == 0)
        @if(Session::has('success'))           
            <div class="alert alert-success" role="alert">
                {{ Session::get('success')}}
            </div>       
        @endif 
    @endif
@endif
 
    <link rel="stylesheet" href="{{ asset('css/index.css') }}"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">  
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@500&family=Catamaran:wght@500&display=swap" rel="stylesheet">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>All Bookings</title>
    </head>
    <body>
        <h1>All Bookings</h1>

        <div class="container">
            <div class="row">
                <table class="table">
                    <thead id="table-head">
                        <tr>
                            <th>ID</th>
                            <th>User ID</th>
                            <th>Service</th>
                            <th>Date Time</th>
                            <th>Last Name</th>
                            <th>phone_number </th>
                            <th>Email</th>
                            <th>Noted</th>
                            <th>Total price</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @if($bookings->isEmpty())
                            <p>No bookings available.</p>
                        @else
                            @foreach($bookings as $booking)
                                <tr>
                                    <!-- 如果您有服务的信息，可以通过 $booking->service 来获取 -->
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ $booking->user_id }}</td>
                                    <td>{{ optional($booking->service)->name }}</td>
                                    <td>{{ $booking->booking_datetime  }}</td>
                                    <td>{{ $booking->Name }}</td>
                                    <td>{{ $booking->phone_number }}</td>
                                    <td>{{ $booking->Email }}</td>
                                    <td>{{ $booking->note }}</td>
                                    <td>{{ $booking->total_price }}</td>
                                </tr>
                            @endforeach
                        @endif

                       
          
           
         
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>

