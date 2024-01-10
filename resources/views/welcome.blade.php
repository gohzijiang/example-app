@extends('layouts.app')

@section('title', 'Page Title')

@section('content')
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
    <div class="center-button">



    <div class="service-info">
    @if(auth()->check() && (auth()->user()->is_admin == 1 || auth()->user()->role == 'admin'))
    <div class="admin-info">
        <p>Welcome, Admin!</p>
        <p>As an administrator of our Car Washing Service, you have access to powerful tools to manage and enhance the car wash experience for both users and the business.</p>

        <p>Your Admin Features Include:</p>

        <ul>
            <li>Booking Operating Time System: Easily adjust the operating hours of the car wash to suit your business needs.</li>
            <li>Operating Time List: View and manage the business's operating hours to keep everything organized.</li>
            <li>View User Bookings: Stay informed about user bookings and manage them efficiently.</li>
            <li>Create New Car Models: Introduce new car models to expand the services offered by the car wash.</li>
            <li>View Car Models: Access information about existing car models to ensure a diverse range of services.</li>
        </ul>
    </div>
@else

        <p>Welcome to our Car Washing Service!</p>
        <p>At our car wash, we take pride in offering top-notch services to keep your vehicle looking<br>
         its best. Our standard car washing package includes a comprehensive set of services designed <br> 
         to enhance the cleanliness and appeal of your vehicle.
        </p>
        <p>Our Standard Car Washing Services:</p>
        <p style="font-weight: bold;">Exterior Wash:</p>


        Thorough cleaning of exterior surfaces using high-pressure water and quality car wash detergent.<br>
        Tire and Wheel Cleaning:<br>

        Attention to detail with specialized cleaning for tires and wheels.<br>
        <p style="font-weight: bold;">Drying:</p>

        Effective drying techniques to ensure a spotless finish.<br>
        Interior Cleaning (Optional):<br>

        Interior wipedown, vacuuming, and optional seat and carpet cleaning.<br>
        <p style="font-weight: bold;"> Window Cleaning:</p>
       

        Crystal-clear windows, both inside and out.<br>
        <p style="font-weight: bold;"> Vehicle Care Products (Optional):</p>

        Optional application of protective coatings for the exterior.<br>
        <p style="font-weight: bold;"> Fragrance (Optional):</p>
        <br>

        Choose from our optional interior fragrances for a refreshing experience.</p>
        @if(auth()->check())
    <a href="{{ route('bookings.create') }}" class="start-booking-button">Start Booking</a>
@else
    <a href="{{ route('login') }}" class="start-booking-button">Start Booking</a>
@endif

    </div>
    @endif
</div>

</body>


</html>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha384-GLhlTQ8i1U+8XzrwKtpb/d+ld7NlFf/b00n" crossorigin="anonymous">

<script>
    $(document).ready(function(){
        $('.slider-container').slick({
            dots: false,
            infinite: true,
            speed: 500,
            fade: true,
            cssEase: 'linear',
            prevArrow: $('.slider-prev'),
            nextArrow: $('.slider-next'),
            // Add more settings as needed
        });
    });
</script>
<style>
    .slider-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh; /* 让轮播容器充满整个视口高度 */
}

.slide {
    width: 100%; /* 确保每个轮播项占据整个容器宽度 */
}
.slider-prev,
.slider-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 24px;
    color: #fff;
    cursor: pointer;
}

.slider-prev {
    left: 10px;
    
}       body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-image: linear-gradient(rgba(241, 241, 241, 0.6), rgba(156, 154, 154, 0.6)), url("/image/background.PNG");
            background-position: center;
            background-size: cover;
            background-position: absolute;
            background-color: #323842;
            height: 100vh;
            color: #fff;
        }

       
        nav {
            display: flex;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            margin: 0 15px;
            font-size: 18px;
        }

        .auth-links {
            display: flex;
            margin-left: auto; 
        }

        .auth-links a {
            margin: 0 15px;
            font-size: 18px;
            color: #fff;
            text-decoration: none;
        }

        section {
            padding: 20px;
        }

        h2 {
            color: #007BFF;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer {
    background-color: #333333; /* 设置 footer 的背景色为黑色 */
    color: white; /* 设置文本颜色为白色 */
    text-align: center; /* 居中对齐 */
    padding: 10px; /* 设置内边距为10px，可以根据需要调整 */
    margin-top: auto; /* 你之前设定的 margin-top */
}

.footer-content {
    max-width: 800px; /* 设置最大宽度，以确保内容在大屏幕上不会过宽 */
    margin: auto; /* 居中显示 */
}

.footer-bottom {
    margin-top: 10px; /* 设置底部文本的上边距为10px，可以根据需要调整 */
}

.socials {
    list-style: none;
    padding: 0;
    display: flex;
    justify-content: center;
}

.socials li {
    margin: 0 10px;
} body {
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            position: relative;
        }

        .center-button {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .start-booking-button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .footer {
          
            padding: 20px;
            text-align: center;
            margin-top: auto;
        }
        .service-info {
            background-color: beige; /* 设置米色背景 */
            padding: 20px; /* 可选的内边距，使内容离边框有一些间距 */
            border-radius: 10px; /* 可选的圆角边框 */
            text-align: left;
            display: inline-block;
            color: black;
        }
    
        .footer-bottom {
            margin-top: 20px;
        }

    </style>
    
    @endsection
   