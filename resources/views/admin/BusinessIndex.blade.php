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
 
    <link rel="stylesheet" href="{{ asset('css/index.css') }}"/>
    <link rel="preconnect" href="https://fonts.gstatic.com">  
    <link href="https://fonts.googleapis.com/css2?family=Teko:wght@500&family=Catamaran:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Search Form</title>
        <title>All Bookings</title>
    </head>
    <body>
        <h1>Business Operation Time</h1>
       <div class="container">
    <div class="row">
        <div class="col-md-3">
           
            <ul class="navbar-nav" style="margin-top: 8px;">
                <form class="form-inline active-cyan-4" action="{{ route('search.BusinessByMonth') }}" method="post">
                    @csrf
                    <input class="form-control form-control-sm ml-3 w-75 rounded-pill " type="text" placeholder="1-12 Month" aria-label="Search" name="searchBusinessByMonth" id="searchByUserName">
                    <button class="btn btn-primary btn-sm" type="submit">Search</button>
                </form>
            </ul>
            
        </div>
        <div class="col-md-3">
            <ul class="navbar-nav" style="margin-top: 8px;">
                <form class="form-inline active-cyan-4" action="{{ route('search.BusinessByDates') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="datepicker">Select Date: </label>
                            <input type="text" class="form-control" id="datepicker"  name="searchByDate" id="Find Business Time By Date" autocomplete="off">
                        </div>
                        <button class="btn btn-primary ml-2" type="submit">Search</button>
                </form>
            </ul>
        </div>
        @if(session('error'))
            <script>
                alert("{{ session('error') }}");
            </script>
        @endif
        
    </div>
            <div class="row">
                <table class="table">
                    <thead id="table-head">
                        <tr>
                            <th>Dates</th>
                            <th>Open Time</th>
                            <th>Close Time</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($businessData as $business)
                        <tr>
                            <td>{{ $business->dates }}</td>
                            <td>{{ $business->open_time }}</td>
                            <td>{{ $business->close_time }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function(){
        $('#datepicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true
        });
    });
</script>
@endsection
