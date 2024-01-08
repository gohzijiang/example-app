<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
    <link rel="stylesheet" href="path/to/styles.css">
    <!-- Add Slick Carousel Theme CSS -->   
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css"/>
    
    <!-- Add jQuery (required by Slick Carousel) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Add Slick Carousel JS -->
   
    <title>Car Washing Services</title>
</head>
<body>
<header>
    <nav>
        <a href="#">Home</a>
        <a href="#">Bookings</a>
        <a href="#">Service</a>
        <a href="#">About Us</a>
        <a href="#">Contact</a>
    </nav>
    <div class="auth-links">
            @if (Route::has('login'))              
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            @endif
        </div>
    </header>
    </nav>
        <div class="slider-container">
            <!-- Slides -->
                <div class="slide"><img src="/image/picture_2.PNG" alt="Slide 1"></div>
                <div class="slide"><img src="/image/picture_3.PNG" alt="Slide 2"></div>
                <div class="slide"><img src="/image/picture_4.PNG" alt="Slide 3"></div>
                <!-- Add more slides as needed -->

                <!-- Navigation Arrows -->
                <div class="slider-prev">&lt;</div>
                <div class="slider-next">&gt;</div>
        </div>
<footer class="footer">
        <div class="footer-content">
            <br>
            <h3>Car Washing Service</h3>
            <p>Car washing service in Malaysia</p>
            <p>Email: goh09282000@gmail.com</p>
            <ul class="socials">
                <li><a href="https://www.facebook.com/%E7%BB%BF%E6%B2%B3%E4%B9%A6%E7%B1%8D-100969648996154" target="_blank"><i class="fab fa-facebook"></i></a></li>
                <li><a href="https://twitter.com/GreenRi05699013" target="_blank"><i class="fab fa-twitter"></i></a></li>
                <li><a href="https://mail.google.com/mail/u/0/?tab=rm&ogbl#inbox?compose=GTvVlcSBpgPgNjKQmkbpCGCqVLGSLgppxchZlPpNfkMWKxgQbZFlRXTdmZwlmSZQNHmjLqVxRSmZC" target="_blank"><i class="fas fa-envelope"></i></a></li>
                <li><a href="https://www.youtube.com/watch?v=kul-g_30HuU&t=10s" target="_blank"><i class="fab fa-youtube"></i></a></li>
            </ul>
        </div>
        <div class="footer-bottom">
            &copy; Developed by Zi Jiang
        </div>
</footer>
</body>
</html>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
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

        header {
            background-color: #007BFF;
            padding: 10px 20px;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h1 {
            color: #fff;
            margin: 0;
            font-size: 24px;
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
            margin-left: auto; /* 将 auth-links 推到右侧 */
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
}

    </style>
