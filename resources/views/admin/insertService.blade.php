@extends('layouts.app1')
@section('content')

<link rel="stylesheet" href="{{ asset('css/create-service.css') }}"/>

<body>
<h2 style="text-align: center;">Create a New Service</h2>

    <div class="container">
        <div style="text-align:center"> 
            <form class="suboform" method="post" action="{{ route('services.store') }}" enctype="multipart/form-data"> 
            @csrf              
                <p>
                    <label for="name" class="label">Service Name:</label>
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
                <button type="submit">Create Service</button>
                <br>
                <br>
            </form>
        </div>
    </div>
</body>   

<footer class="footer">
      <div class="footer-content">
      <br>
          <h3>Car Washing Services</h3>
          <p>Car washing service in malaysia</p>
          <p>Email  :goh09282000@gmail.com</p>
          <ul class="socials">
              <li>   <a href="https://www.facebook.com/%E7%BB%BF%E6%B2%B3%E4%B9%A6%E7%B1%8D-100969648996154"><i  class="fa fa-facebook"></i></a></li>
              <li>   <a href="https://twitter.com/GreenRi05699013"><i  class="fa fa-twitter"></i></a></li>
              <li>   <a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox?compose=GTvVlcSBpgPgNjKQmkbpCGCqVLGSLgppxchZlPpNfkMWKxgQbZFlRXTdmZwlmSZQNHmjLqVxRSmZC"><i  class="fa fa-google-plus" ></i></a></li>
              <li>   <a href="https://www.youtube.com/watch?v=kul-g_30HuU&t=10s"><i  class="fa fa-youtube"></i></a></li>
             
        </ul>
        
       
      </div>
      <div class="footer-bottom">
            &copy;Develop by  Zi Jiang
      </div>
</footer>   
@endsection



