<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Item</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        input[type="text"],
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button[type="submit"] {
            background-color: #4CAF50;
        }

        button[type="button"] {
            background-color: #808080;
        }
    </style>

</head>

<body>

    <div class="container">
        <h2>Add Item</h2>
        <form action="{{ route('submit.item') }}" enctype="multipart/form-data" method="post">
            @csrf

            <input type="file" name="image" placeholder="Choose image" id="image" required>
            <img src="" id="preview" style="max-width: 200px; max-height: 200px;">
            <br>
            <label for="food_name">Food Name:</label>
            <input type="text" id="food_name" name="food_name" required><br><br>

            <label for="code">Code:</label>
            <input type="text" id="code" name="code" required><br><br>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="Main Course">Main Course</option>
                <option value="Appetizer">Appetizer</option>
                <option value="Dessert">Dessert</option>
                <option value="Beverage">Beverage</option>
                <!-- Add more options as needed -->
            </select><br><br>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required><br><br>



            <button type="submit" onclick="window.history.back()">Submit</button>
            <button type="button" onclick="window.history.back()">Cancel</button>
        </form>
    </div>

</body>

<script>
    var fileTag = document.getElementById("image");
    var preview = document.getElementById("preview");

    fileTag.addEventListener("change", function() {
        changeImage(this);
    });

    function changeImage(input) {
        var reader;

        if (input.files && input.files[0]) {
            reader = new FileReader();

            reader.onload = function(e) {
                preview.setAttribute('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

</html>