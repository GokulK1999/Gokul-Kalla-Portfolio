<!DOCTYPE html>
<html>
<head>
    <title>Leave Your Feedback</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        textarea {
            height: 150px;
            resize: none;
        }
        .rating {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }
        .rating input {
            display: none;
        }
        .rating label {
            cursor: pointer;
            font-size: 30px;
            color: #ccc;
            margin: 0 5px;
        }
        .rating label:before {
            content: '\2605';
        }
        .rating input:checked ~ label:before {
            color: orange;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        .btn-back {
            display: block;
            text-align: center;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }
        .btn-back:hover {
            background-color: #0056b3;
        }
    </style>
    <script>
        function validateForm(event) {
            const ratings = document.getElementsByName('rating');
            let ratingSelected = false;
            for (const rating of ratings) {
                if (rating.checked) {
                    ratingSelected = true;
                    break;
                }
            }
            if (!ratingSelected) {
                alert('Please select a rating before submitting.');
                event.preventDefault();
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Leave Your Feedback</h1>
        @if (session()->has('form_success'))
        <div class="alert alert-success" style="background-color: #d4edda; 
            color: #155724; border-color: #c3e6cb; padding: 15px; border-radius: 4px; margin-bottom: 20px;">
            <strong>Thank you for your feedback!</strong>
        </div>
        @endif

        <form action="{{ route('feedback.store') }}" method="POST" onsubmit="validateForm(event)">
            @csrf
            <label for="name">Name:</label>
            <input type="text" name="name" id="name">
            <label for="feedback">Feedback:</label>
            <textarea name="feedback" id="feedback" required></textarea>
            <div class="rating">
                <input type="radio" id="star5" name="rating" value="5">
                <label for="star5">5 stars</label>
                <input type="radio" id="star4" name="rating" value="4">
                <label for="star4">4 stars</label>
                <input type="radio" id="star3" name="rating" value="3">
                <label for="star3">3 stars</label>
                <input type="radio" id="star2" name="rating" value="2">
                <label for="star2">2 stars</label>
                <input type="radio" id="star1" name="rating" value="1">
                <label for="star1">1 star</label>
            </div>
            <button type="submit">Submit Feedback</button>
        </form>
        <a href="{{ route('dashboard') }}" class="btn-back">Go back to Dashboard</a>
    </div>
</body>
</html>
