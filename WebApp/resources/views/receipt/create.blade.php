@extends('lay.app')

@section('body')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        .add-receipt-container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .add-receipt-container h1 {
            color: #007bff;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .add-receipt-container .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 18px;
            text-decoration: none;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .add-receipt-container .btn-primary:hover {
            background-color: #0056b3;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            font-weight: bold;
            display: block;
        }

        .form-group input[type="text"],
        .form-group select,
        .form-group textarea {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
            width: 100%;
            font-size: 16px;
        }

        .form-group textarea {
            height: 100px;
        }

        .form-group::after {
            content: "";
            display: table;
            clear: both;
        }

        .form-group input[type="text"] {
            float: left;
            width: calc(100% - 10px);
        }

        .form-group .text-label {
            float: right;
            width: 10px;
            text-align: center;
            line-height: 36px;
        }
    </style>

    <div class="add-receipt-container">
        <h1>Add Receipt</h1>
        <hr>
        <form action="{{ route('receipt.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" placeholder="Enter name" required>
            </div>
            <div class="form-group">
                <label for="totalPaid">Total Paid:</label>
                <input type="text" name="totalPaid" id="totalPaid" placeholder="Enter total paid" oninput="formatCurrency(this)" required>
            </div>
            <div class="form-group">
                <label for="item">Item:</label>
                <select name="item" id="item" required>
                    <option value="" disabled selected>Select Item</option>
                    <option value="Malay Cuisine">Malay Cuisine</option>
                    <option value="Chinese Cuisine">Chinese Cuisine</option>
                    <option value="Japanese Cuisine">Japanese Cuisine</option>
                    <option value="Korean Cuisine">Korean Cuisine</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" placeholder="Enter description" required></textarea>
            </div>
            <div class="form-group">
                <div class="d-grid">
                    <button class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function formatCurrency(input) {
            // Remove non-numeric characters from input value
            let num = input.value.replace(/\D/g, '');

            // Format the number as currency with RM symbol
            input.value = 'RM ' + formatNumber(num);
        }

        function formatNumber(num) {
            // Add commas to separate thousands
            return num.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    </script>
@endsection