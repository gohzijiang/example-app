@extends('layouts.app')

@section('title', 'Page Title')

@section('content')


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
@if(session('successMessage'))
    <script>
        alert("{{ session('successMessage') }}");
    </script>
@endif

    <link rel="stylesheet" href="{{ asset('css/index.css') }}"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">  
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@500&family=Catamaran:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>

    <!-- 引入 Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

    <!-- 引入 Bootstrap Datepicker CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <!-- 引入 Bootstrap Datepicker JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>All Bookings</title>
    </head>
    <body>
        <h1>All Bookings</h1>

        <div class="container">
        <div class="row">
            <div class="col-md-3">
                <ul class="navbar-nav" style="margin-top: 8px;">
                    <form class="form-inline active-cyan-4" action="{{ route('search.userSearchBusinessByDates') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="datepicker">Select Date: </label>
                            <input type="text" class="form-control" id="datepicker"  name="UserSearchByDateTime" id="UserSearchByDateTime" autocomplete="off">
                        </div>
                        <button class="btn btn-primary ml-2" type="submit">Search</button>
                    </form>
                </ul>
            </div>
        </div>
        <div class="row">
                <table class="table">
                    <thead id="table-head">
                        <tr>
                            <th>ID</th>
                            <th>User Name</th>
                            <th>Car Size</th>
                            <th>Date Time</th>
                            <th>license plate number</th>
                            <th>phone_number </th>
                            <th>Email</th>
                            <th>Noted</th>
                            <th>Total price</th>
                        </tr>
                    </thead>

                    <tbody>
                    @if($bookings->isEmpty())
                        @if(isset($searchByDateTime))
                            <p>No bookings available for {{ $searchByDateTime->format('Y-m-d') }}.</p>
                        @elseif(isset($searchByUserName))
                            <p>No bookings available for {{ $searchByUserName }}.</p>
                        @else
                            <p>No bookings available for today.</p>
                        @endif
                    @else
                            @foreach($bookings as $booking)
                                <tr>
                                    <!-- 如果您有服务的信息，可以通过 $booking->service 来获取 -->
                                    <td>{{ $booking->id }}</td>
                                    <td>{{ optional($booking->user)->name }}</td>
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
<script>
    $(document).ready(function(){
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd', // 设置日期格式
            autoclose: true,
        });
    });
</script>
@endsection