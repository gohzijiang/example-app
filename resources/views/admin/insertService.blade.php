@extends('layouts.app')
@section('content')

<link rel="stylesheet" href="{{ asset('css/create-service.css') }}"/>

<body>
<h2 style="text-align: center;">Generate a New Car Model</h2>

    <div class="container">
        <div style="text-align:center"> 
            <form class="suboform" method="post" action="{{ route('services.store') }}" enctype="multipart/form-data"> 
            @csrf              
                <p>
                    <label for="name" class="label">Name:</label>
                    <br>
                    <input type="text" name="name" required>
                </p>

                

                <p>
                <label for="description">Description:</label>
                     <br>
                <textarea name="description" required></textarea>
                </p>
                

                <p>
                <label for="price">Price:</label>
                     <br>
                <input type="number" name="price" step="0.01" required>
                </p>
                
                <p>
                <label for="duration">Duration (minutes):</label>
                <br>    
                <input type="number" name="duration" required>
                </p>
                <button type="submit" style="background-color: blue; color:white; width: 150px;">Create Service</button>

                <br>
                <br>
            </form>
        </div>
    </div>
</body>   


@endsection



