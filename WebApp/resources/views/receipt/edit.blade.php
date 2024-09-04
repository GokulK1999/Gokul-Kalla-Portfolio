@extends('lay.app')

@section('body')
    <style>
        /* Additional CSS for receipt form styling */
        .form-container {
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 30px;
            background-color: #007bff; /* Adjusted background color to blue */
            max-width: 600px;
            margin: 0 auto;
        }

        .form-label {
            font-weight: bold;
            color: #fff; /* Adjusted text color to white */
            font-size: 1.2em;
            margin-bottom: 10px;
            display: block;
            text-align: left; /* Align label text to the left */
        }

        .form-control {
            border: none;
            background-color: #f9f9f9;
            margin-bottom: 20px;
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border-radius: 5px;
            color: #555;
            box-shadow: none; /* Remove box-shadow for input fields */
        }

        .form-select {
            border: none;
            background-color: #f9f9f9;
            margin-bottom: 20px;
            width: 100%;
            padding: 10px;
            font-size: 1em;
            border-radius: 5px;
            color: #555;
            box-shadow: none; /* Remove box-shadow for select fields */
        }

        .btn-primary {
            background-color: #fff; /* Adjusted background color to white */
            border: none;
            color: #007bff; /* Adjusted text color to blue */
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 1.2em;
            cursor: pointer;
            transition: background-color 0.3s, color 0.3s; /* Added transition for color change */
        }

        .btn-primary:hover {
            background-color: #f0f0f0; /* Adjusted hover background color */
            color: #0056b3; /* Adjusted hover text color */
        }
    </style>

    <div class="form-container">
        <h1 class="mb-0">Edit Receipt</h1>
        <hr />
        <form action="{{ route('receipt.update', $receipt->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $receipt->name }}" >
            </div>
            <div class="mb-3">
                <label class="form-label">Item</label>
                <input type="text" name="item" class="form-control" placeholder="Item" value="{{ $receipt->item }}" >
            </div>
            <div class="mb-3">
                <label class="form-label">Total Paid</label>
                <input type="text" name="totalPaid" class="form-control" placeholder="Total Paid" value="{{ $receipt->totalPaid }}" >
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Description">{{ $receipt->description }}</textarea>
            </div>
            
            <div class="mb-3">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>
@endsection