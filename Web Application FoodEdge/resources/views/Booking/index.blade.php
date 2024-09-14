<!DOCTYPE html>
<html>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <title>Catering Booking Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1800px;
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

        .btn-box {
            display: flex;
            justify-content: space-around;
            /* Evenly space the buttons */
            margin-top: 20px;
            /* Add some space between the box and the buttons */
        }

        /* Styling the buttons */
        .btn-box a {
            padding: 10px 20px;
            background-color: #ffcc00;
            /* bright color */
            color: #ffffff;
            /* white text color */
            text-decoration: none;
            /* Remove underline from links */
            border-radius: 5px;
            /* Rounded corners */
            transition: background-color 0.3s;
            /* Smooth transition on hover */
        }

        /* Hover effect for buttons */
        .btn-box a:hover {
            background-color: #ffa500;
            /* Darker color on hover */
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-12" style="padding:20px;">
                <div class="card">
                    <div class="card-header">
                        <h1>Catering Booking List</h1>
                    </div>
                    <div class="card-body">


                        <br />
                        <br />
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <thead>               
                                    <tr>
                                            <th>Catering Booking ID</th>
                                            <th>Catering Booking Theme</th>
                                            <th>Catering Booking Type</th>
                                            <th>Catering Booking Date</th>
                                            <th>Customer Name</th>
                                            <th>Email</th>
                                            <th>Phone Number</th>
                                            <th>Food Order</th>
                                            <th>Remarks</th>
                                            <th>Actions</th>
                                        </tr>             
                                        @foreach ($bookingData as $key)

                                        <tr>
                                        <td class="value">{{ $key->id }}</td>
                                            <td class="value">{{ $key->BookingTheme }}</td>
                                            <td class="value">{{ $key->BookingType }}</td>
                                            <td class="value">{{ $key->BookingDate }}</td>
                                            <td class="value">{{ $key->CustomerName }}</td>
                                            <td class="value">{{ $key->CustomerEmail }}</td>
                                            <td class="value">{{ $key->PhoneNumber }}</td>
                                            <td class="value" style="white-space: pre-wrap;">{{ $key->FoodOrderList }}</td>
                                            <td class="value">{{ $key->Remarks }}</td>
                                            <td class="value">                        
                               <a href="{{ url('edit-booking-details/?id='.$key->id) }}"  > <button type="button" class="btn btn-info">Edit</button> </a>
                               <a href="{{ url('delete-booking-details/'.$key->id) }}"  >  <button type="button"  class="btn btn-danger">Delete</button> </a>
                                            </td>

                                        </tr>
                        
                                        @endforeach
   
                                    </thead>
                                   

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="btn-box">
            <a href="add-booking" class="option1">
                Add New Booking
            </a>
            <a href="/invoices/create" class="option1">
                Check Out
            </a>
        </div>
    </div>

</body>

</html>