@extends('lay.app')

@section('body')
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            padding-top: 20px;
        }

        .receipt-container {
            max-width: 1000px; /* Increased max-width */
            margin: 0 auto;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .receipt-container h1 {
            color: #007bff;
            font-size: 32px;
            margin-bottom: 20px;
        }

        .receipt-container .btn-primary {
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            font-size: 18px;
            text-decoration: none;
            color: #fff;
            transition: background-color 0.3s ease;
        }

        .receipt-container .btn-primary:hover {
            background-color: #0056b3;
        }

        .receipt-container table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .receipt-container th, .receipt-container td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
        }

        .receipt-container th {
            background-color: #007bff;
            color: #fff;
            font-size: 18px;
        }

        .receipt-container td {
            font-size: 16px;
        }

        .receipt-container .btn-group {
            display: flex;
        }

        .receipt-container .btn-group a, .receipt-container .btn-group form {
            margin-right: 10px;
        }
    </style>

    <div class="receipt-container">
        <h1>List Receipts</h1>
        <div class="d-flex justify-content-between align-items-center">
            <a href="{{ route('receipt.create') }}" class="btn btn-primary">Add Receipt</a>
            <!-- Search form -->
            <form action="{{ route('receipt.index') }}" method="GET" class="mb-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" placeholder="Search receipts">
                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                </div>
            </form>
        </div>
        <hr>
        <!-- Receipts table -->
        <table class="table table-hover">
            <!-- Table header -->
            <thead class="table-primary">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Item</th>
                    <th>Total Paid</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Loop through receipts -->
                @if($receipts->count() > 0)
                    @foreach($receipts as $receipt)
                        <tr>
                            <!-- Display receipt data -->
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $receipt->name }}</td>
                            <td>{{ $receipt->item }}</td>
                            <td>{{ $receipt->totalPaid }}</td>
                            <td>{{ $receipt->description }}</td>
                            
                            <!-- Actions: Detail, Edit, Delete -->
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="{{ route('receipt.show', $receipt->id) }}" type="button" class="btn btn-secondary">Detail</a>
                                    <a href="{{ route('receipt.edit', $receipt->id)}}" type="button" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('receipt.destroy', $receipt->id) }}" method="POST" type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger m-0">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td class="text-center" colspan="7">No receipts found</td>
                    </tr>
                @endif
            </tbody>
        </table>
        <!-- Pagination links -->
        {{ $receipts->links() }}
    </div>
@endsection