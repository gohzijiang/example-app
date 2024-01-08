@extends('layouts.app1')
@section('content')
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Car Wash Services</title>
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
</head>
<body>
<h1>Service</h1>
    <div class="container">
        <div class="row">
            <table class="table table-hover table-striped">
                <thead>
                    <tr class="thead-dark">
                    <th>Service ID</th>
                        <th>Service</th>
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
                            <td><a href="#" class="btn btn-danger" onclick="return confirm('Sure Want Delete?')">Delete</a></td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
@endsection