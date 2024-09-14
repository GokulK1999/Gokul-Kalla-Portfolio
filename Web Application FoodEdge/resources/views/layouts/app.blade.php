<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
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
        .content-wrapper {
            background-color: rgba(0, 0, 0, 0.7);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        header {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            text-align: center;
        }
        main {
            flex: 1;
            padding: 20px;
        }
        footer {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 20px;
            text-align: center;
        }
        .custom-button {
            display: block;
            text-align: center;
            font-weight: bold;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
            transition: background-color 0.3s ease;
            text-decoration: none;
            color: white;
        }
        .custom-button:hover {
            filter: brightness(0.9);
        }
    </style>
</head>
<body>
    <div class="content-wrapper">
        <livewire:layout.navigation />
        <!-- Page Heading -->
        @if (isset($header))
            <header class="shadow">
                <div class="max-w-7xl mx-auto">
                    {{ $header }}
                </div>
            </header>
        @endif
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        <footer>
            &copy; {{ date('Y') }} Food Catering Management. All rights reserved.
        </footer>
    </div>
</body>
</html>
