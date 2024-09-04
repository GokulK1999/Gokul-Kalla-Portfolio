@extends('lay.app')

@section('body')

    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">Customer Profile</h1>
        <a href="{{ route('customer.create') }}" class="btn btn-secondary">Add customer</a>
    </div>
    <hr />
    @if(Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-success">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Photo</th>
                <th>Address</th>
                <th>Details</th>
                <th>Paid</th>
                <th>Action</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @if($customer->count() > 0)
                @foreach($customer as $customer)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $customer->name}}</td>
                        <td class="align-middle">{{ $customer->photo }}</td>
                        <td class="align-middle">{{ $customer->address }}</td>
                        <td class="align-middle">{{ $customer->details }}</td>
                        <td class="align-middle">{{ $customer->membership ? 'Yes' : 'No' }}</td>
                        <td class="align-middle">
                            <div class="btn-group-vertical" role="group" aria-label="Vertical radio toggle button group">
                                <a href="{{ route('customer.show', $customer->id) }}" type="button" class="btn btn-outline-primary">Details</a>
                                <a href="{{ route('customer.edit', $customer->id) }}" type="button" class="btn btn-outline-secondary">Edit</a>
                            </div>
                        </td>
                        <td class="align-middle">
                            <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" type="button" class="btn btn-outline-danger p-0" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="7">No Invoices found</td>
                </tr>
            @endif
        </tbody>
    </table>
@endsection