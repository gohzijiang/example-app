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
               
            </div>
        </div>
        <div class="row">
                <table class="table">
                    <thead id="table-head">
                        <tr>
                            <th>Model ID</th>
                            <th>Car Model</th>
                            <th>Description:</th>
                            <th>Price:</th>
                            <th>Duration (minutes):</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                  
                    @foreach($services as $service)
                    <tr>
                        <td>{{$service->id}}</td>
                        <td>{{$service->name}}</td>
                        <td>{{$service->description}}</td>
                        <td>{{$service->price}}</td>
                        <td>{{$service->duration}}</td>
                        <td>
                            <form action="{{ route('services.destroy', $service->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Sure Want Delete?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                                               
                    </tbody>
                </table>
            </div>
        </div>
    </body>
</html> 

                   

@endsection
