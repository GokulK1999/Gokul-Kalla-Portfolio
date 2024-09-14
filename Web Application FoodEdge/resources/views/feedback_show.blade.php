<!DOCTYPE html>
<html>
<head>
    <title>Feedback Display</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333;
        }

        .alert {
            padding: 10px;
            margin-bottom: 20px;
            background-color: #dff0d8;
            border: 1px solid #d6e9c6;
            border-radius: 4px;
            color: #3c763d;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        li {
            margin-bottom: 20px;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 4px;
        }

        p {
            margin: 0;
        }

        .name {
            font-weight: bold;
            margin-bottom: 5px;
        }

        .feedback {
            color: #333;
            margin-bottom: 10px;
        }

        .star-rating {
            color: #f39c12;
            font-size: 18px;
        }

        .btn-back {
            display: inline-block;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Submitted Feedback</h1>
        @if (session()->has('success'))
            <div class="alert">
                {{ session()->get('success') }}
            </div>
        @endif

        @if (isset($feedbacks) && count($feedbacks) > 0)
            <ul>
                @foreach ($feedbacks as $feedback)
                    <li>
                        <p class="name">Name: {{ $feedback->name ?? 'Anonymous' }}</p>
                        <p class="feedback">Feedback: {{ $feedback->feedback }}</p>
                        <p class="star-rating">Star Rating: {{ $feedback->star_rating }}</p>
                    </li>
                @endforeach
            </ul>
        @else
            <p>No feedback submitted yet.</p>
        @endif

        <!-- Button to go back to Management Dashboard -->
        <a href="{{ route('management') }}" class="btn-back">Go back to Dashboard</a>
    </div>
</body>
</html>
