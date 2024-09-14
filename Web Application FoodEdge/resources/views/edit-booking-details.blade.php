<!DOCTYPE html>
<html lang="en">

<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" />
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Catering Booking Form</title>
    <style>
        body {
            font-family: "Times New Roman", Times, serif;
            font-size: 15px;
            margin: 0;
            padding: 0;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 1000px;
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
        <h2 style="text-align:center">Edit Item Details</h2>
        @foreach ($bookingData as $key)
        <form action="{{ route('update-booking', ['id' => $key->id]) }}" enctype="multipart/form-data" method="post">
            @csrf
            @method("PUT")

            <br>
            <br>
            <h2>Booking Details: </h2>
            <label for="bookingtheme">Booking Theme:</label>
            <select id="bookingtheme" value="{{ $key->BookingTheme}}" name="bookingtheme" required>
                <option value="">----------</option>
                <option value="Farm-to-Table" @if($key->BookingTheme=="Farm-to-Table") selected @endif>Farm-to-Table</option>
                <option value="Vintage Diner" @if($key->BookingTheme=="Vintage Diner") selected @endif>Vintage Diner</option>
                <option value="Asian Fusion" @if($key->BookingTheme=="Asian Fusion") selected @endif>Asian Fusion</option>
                <option value="Garden Café" @if($key->BookingTheme=="Garden Café") selected @endif>Garden Café</option>
                <option value="Sci-Fi Diner" @if($key->BookingTheme=="Sci-Fi Diner") selected @endif>Sci-Fi Diner</option>
                <option value="Tropical Paradise" @if($key->BookingTheme=="Tropical Paradise") selected @endif>Tropical Paradise</option>
                <option value="Speakeasy" @if($key->BookingTheme=="Speakeasy") selected @endif>Speakeasy</option>
            </select>
            <label for="bookingtype">Catering Booking Type:</label>
            <select id="bookingtype" value="{{ $key->BookingType}}" name="bookingtype" required>
                <option value="">----------</option>
                <option value="Corporate Event" @if($key->BookingType=="Corporate Event") selected @endif>Corporate Event</option>
                <option value="Wedding" @if($key->BookingType=="Wedding") selected @endif>Wedding</option>
                <option value="Birthday Party" @if($key->BookingType=="Birthday Party") selected @endif>Birthday Party</option>
            </select>
            <label for="bookingdate">Catering Booking Date:</label>
            <input type="date" id="bookingdate" value="{{ $key->BookingDate}}" name="bookingdate" required><br><br><br>
            <h2>Cilent Details: </h2>
            <label for="customername">Name:</label>
            <input type="text" id="customername" value="{{ $key->CustomerName}}" name="customername" required><br><br>
            <label for="customeremail">Email:</label>
            <input type="email" id="customeremail" value="{{ $key->CustomerEmail}}" name="customeremail" required><br><br>
            <label for="phonenumber">Phone Number:</label>
            <input type="tel" id="phonenumber" value="{{ $key->PhoneNumber}}" name="phonenumber" required><br><br>
            <label for="foodorderlist">Food Order List:</label>

            <select class="select2" name="foodorderlist[]" id="foodorderlist" multiple>
                @foreach($itemlist as $item)
                <option value="{{$item->ID}}">{{$item->ItemName}}</option>
                @endforeach
            </select>
            <label for="status">Status:</label>
            <select id="status" value="{{ $key->Status}}" name="status" required>
                <option value="">----------</option>
                <option value="Pending" @if($key->Status=="Pending") selected @endif>Pending</option>
                <option value="Approved" @if($key->Status=="Approved") selected @endif>Approved</option>
                <option value="Clear" @if($key->Status=="Clear") selected @endif>Clear</option>
            </select>
            <br><br>
            <label for="remarks">Remarks:</label><br>
            <textarea id="remarks" name="remarks" rows="10" style="width: 25em;" required>{{ $key->Remarks}}</textarea><br><br>
            <h3>Booking Confirmation and Terms: </h3>
            <p>I, the undersigned, confirm that the information provided above is accurate, and I agree to the terms and conditions of the catering booking. I understand that a deposit may be required to confirm the booking, and final details will be arranged closer to the event date.</p>
            <br><br><br>


            <button type="submit">Update</button>
            <button type="button" onclick="window.history.back()">Cancel</button>

        </form> @endforeach
    </div>

</body>

<script>
    $(document).ready(function() {
        $('.select2').select2();
    });
</script>

</html>