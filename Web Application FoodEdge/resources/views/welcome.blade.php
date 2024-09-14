<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Food Edge Management System</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'figtree', sans-serif;
            background-image: url('{{ asset('images/food.jpeg') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            color: #fff;
        }
        .overlay {
            background: rgba(0, 0, 0, 0.5);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        header {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background: rgba(0, 0, 0, 0.7);
        }
        .header-content {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .logo-container {
            margin-bottom: 20px;
        }
        .logo-img {
            width: 150px;
            height: auto;
        }
        .nav-buttons {
            display: flex;
            gap: 20px;
        }
        .content {
            text-align: center;
            max-width: 800px;
            margin: 0 auto;
        }
        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            font-size: 18px;
            color: white;
            background-color: #FF2D20;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #e02a1c;
        }
    </style>
</head>
<body class="antialiased font-sans">
    <div class="overlay">
        <header>
            <div class="header-content">
                <div class="logo-container">
                    <img src="{{ asset('images/FoodCatering.png') }}" alt="Food Catering Logo" class="logo-img">
                </div>
                @if (Route::has('login'))
                    <div class="nav-buttons">
                        @livewire('welcome.navigation')
                    </div>
                @endif
            </div>
        </header>
        <div class="content">
            <h1 class="text-4xl font-bold">Welcome to Food Edge Management System</h1>
            <p class="text-lg mt-4">Your ultimate solution for managing food catering services efficiently and effectively.</p>
            <a href="{{ route('login') }}" class="btn">Get Started</a>
        </div>
    </div>
</body>
</html>
