<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Car Wash Services</title>
    <link rel="stylesheet" href="{{ asset('css/service.css') }}">
</head>
<body>

    <header>
        <h1>Welcome to Your Car Wash Services</h1>
        @if($services->isEmpty())
        <p>No services available.</p>
            @else
                <ul>
                    @foreach($services as $service)
                        <li>{{ $service->name }} - {{ $service->description }} - Price: ${{ $service->price }} - Duration: {{ $service->duration }} minutes</li>
                    @endforeach
                </ul>
            @endif
    </header>

    <section id="services">
        <h2>Our Services</h2>
        <div class="service">
            <h3>Standard Cleaning</h3>
            <p>Basic cleaning service for your vehicle.</p>
        </div>
        <div class="service">
            <h3>Waxing</h3>
            <p>Provides extra protection and enhances shine.</p>
        </div>
        <!-- Add more services here -->
    </section>

    <section id="booking">
        <h2>Book Online</h2>
        <!-- Add a form for online booking -->
    </section>

    <section id="about">
        <h2>About Us</h2>
        <p>Your Car Wash Services has been providing top-notch cleaning services for many years...</p>
    </section>

    <section id="contact">
        <h2>Contact Us</h2>
        <p>For inquiries, please email us at <a href="mailto:info@yourcarwash.com">info@yourcarwash.com</a></p>
    </section>

    <footer>
        <p>&copy; 2023 Your Car Wash Services</p>
    </footer>

</body>
</html>
