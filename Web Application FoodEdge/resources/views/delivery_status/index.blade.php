<!DOCTYPE html>
<html>
<head>
    <title>Delivery Status Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="mb-4">Manage Delivery Status</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <a href="{{ route('delivery_status.create') }}" class="btn btn-success mb-4">Add Delivery Status</a>
    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-4">Back to Dashboard</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($statuses as $status)
                <tr>
                    <td>{{ $status->order_id }}</td>
                    <td>
                        <form action="{{ route('delivery_status.update', $status->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" class="form-control">
                                <option value="pending" {{ $status->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="successful" {{ $status->status == 'successful' ? 'selected' : '' }}>Successful</option>
                                <option value="completed" {{ $status->status == 'completed' ? 'selected' : '' }}>Completed</option>
                            </select>
                            <button type="submit" class="btn btn-primary mt-2">Update</button>
                        </form>
                    </td>
                    <td>
                        <form action="{{ route('delivery_status.destroy', $status->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
