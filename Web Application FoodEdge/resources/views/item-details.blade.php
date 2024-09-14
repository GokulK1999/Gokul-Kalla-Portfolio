<!DOCTYPE html>
<html>

<head>
    <title>Item Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        .value {
            font-weight: bold;
        }
    </style>
</head>

<body>

    <div class="container">
        <h1>Item Details</h1>
        <table>
            @foreach ($itemData as $key)
            <tr>
                <th>Image</th>
                <td class="value">
                    <div class="img-box">
                        <img src="storage/images/{{$key->Photo}}" alt="">
                    </div>

                </td>
            </tr>
            <tr>
                <th>Food Name</th>
                <td class="value">{{ $key->ItemName }}</td>
            </tr>
            <tr>
                <th>Category</th>
                <td class="value">{{ $key->Category }}</td>
            </tr>
            <tr>
                <th>Price</th>
                <td class="value">{{ $key->Price }}</td>
            </tr>
            <tr>
                <th>Code</th>
                <td class="value">{{ $key->Code }}</td>
            </tr>

            @endforeach
        </table>
    </div>

</body>

</html>