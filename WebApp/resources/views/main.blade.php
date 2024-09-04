<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Catering Management Service</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-x2dgOz46iP+9l0OiOtUVV+7swR1hvaen9oyz1mXxkbp3+kh9xUOU3PnCgAmG+nsV8hTpLj4ny4YnK36+dTjS4Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-image: url('https://img.huffingtonpost.com/asset/5cd3ac732100005800d3fe7b.jpeg?ops=1778_1000'); /* Food catering background image */
            background-size: cover;
            background-position: center;
            background-attachment: fixed; /* Fixed background */
            overflow-y: hidden; /* Hide vertical scrollbar */
        }
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            overflow-y: auto; /* Enable scrolling within container */
        }
        header {
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            padding: 20px 0;
            text-align: center;
            width: 100%;
        }
        .logo {
            font-size: 2rem;
            font-weight: bold;
        }
        nav {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 10px 0;
            text-align: center;
            width: 100%;
        }
        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 5px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        nav a:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }
        main {
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            width: 200%; /* Increased width */
            max-width: 1500px;
            margin-top: 50px; /* Reduced margin */
        }
        section {
            margin-bottom: 30px;
            text-align: center; /* Center-align content */
        }
        h2 {
            color: #333;
        }
        .section-title {
            font-size: 3.5rem;
            margin-bottom: 10px;
            text-align:center;
            position: relative;
        }
        .section-title::after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background-color: #333;
            margin-top: 5px;
            text-align:center;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }
        footer {
            background-color: rgba(0, 0, 0, 0.7);
            color: #fff;
            text-align: center;
            padding: 20px 0;
            width: 100%;
        }
        .footer-social-icons a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            transition: color 0.3s ease;
        }
        .footer-social-icons a:hover {
            color: #ddd;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-bottom: 20px;
        }
        .btn:hover {
            background-color: #45a049;
        }
        .login-register {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 10px;
        }
        .login-register button {
            margin: 0 10px;
            background-color: #FF0000;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .login-register button:hover {
            background-color: #CC0000;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Food Catering</div>
    </header>

    <nav>
        <a href="#">Home</a>
        <a href="#">About Us</a>
        <a href="#">Services</a>
        <a href="#">Contact Us</a>
    </nav>

    <div class="container">
        <main>
            <section>
                <h2 class="section-title">About Us</h2>
                <p>Welcome to our Food Catering Management Service. We provide high-quality catering solutions for all your events.</p>
            </section>

            <section>
                <h2 class="section-title">Services</h2>
                <p>Our services include:</p>
                <ul>
                    <p>Wedding Catering</p>
                    <p>Corporate Event Catering</p>
                    <p>Private Party Catering</p>
                    <!-- Add more services as needed -->
                </ul>
            </section>

            <section>
                <h2 class="section-title">Contact Us</h2>
                <p>If you have any inquiries or would like to book our services, please contact us at:</p>
                <p>Email: info@foodcatering.com</p>
                <p>Phone: 123-456-7890</p>
            </section>

            
            
            <div class="login-register">
                <button onclick="window.location.href='{{ route('login') }}'">Log in</button>
                <button onclick="window.location.href='{{ route('register') }}'">Register</button>
            </div>
        </main>
    </div>

    <footer>
        <div class="footer-social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
        </div>
        <p>&copy; 2024 Food Catering Management Service</p>
    </footer>

    <!-- Add your JavaScript files or link to external scripts here -->
</body>
</html>