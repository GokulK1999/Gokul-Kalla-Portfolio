@extends('lay.app')

@section('body')

    <div class="d-flex align-items-center justify-content-between">
        <h1 class="mb-0">List Invoices</h1>
        @if(Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 2))
        <a href="{{ route('invoice.create') }}" class="btn btn-secondary">Add Invoice</a>
        @endif
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
                <th>Item</th>
                <th>Total Amount</th>
                <th>Description</th>
                @if(Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 2))
                <th>User id</th>
                @endif
                <th>Paid</th>
                <th>Action</th>
                @if(Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 2))
                <th>Delete</th>
                @endif
                @if(Auth::check() && (Auth::user()->role == 3))
                <th>Pay</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @if($invoice->count() > 0)
                @foreach($invoice as $invoice)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $invoice->name}}</td>
                        <td class="align-middle">{{ $invoice->item }}</td>
                        <td class="align-middle">{{ $invoice->totalPaid }}</td>
                        <td class="align-middle">{{ $invoice->description }}</td>
                        @if(Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 2))
                        <td class="align-middle">{{ $invoice->user_id }}</td>
                        @endif
                        <td class="align-middle">{{ $invoice->status ? 'Yes' : 'No' }}</td>
                        <td class="align-middle">
                            <div class="btn-group-vertical" role="group" aria-label="Vertical radio toggle button group">
                                <a href="{{ route('invoice.show', $invoice->id) }}" type="button" class="btn btn-outline-primary">Details</a>
                                @if(Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 2))
                                <a href="{{ route('invoice.edit', $invoice->id) }}" type="button" class="btn btn-outline-secondary">Edit</a>
                                @endif
                            </div>
                        </td>
                        @if(Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 2))
                        <td class="align-middle">
                            <form action="{{ route('invoice.destroy', $invoice->id) }}" method="POST" type="button" class="btn btn-outline-danger p-0" onsubmit="return confirm('Delete?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-outline-danger">Delete</button>
                            </form>
                        </td>
                        @endif
                        <td class="align-middle">
                            <form action="{{ route('invoice.pay', $invoice->id) }}" method="POST" type="button" class="btn btn-outline-warning p-0">
                              @csrf
                              @method('POST')
                            <!-- check for authentication -->
                            @if(Auth::check() && (Auth::user()->role == 3 && !$invoice->status))
                              <button class="btn btn-outline-primary">Pay</button>
                            @elseif(Auth::check() && (Auth::user()->role == 3) && $invoice->status)
                              <button class="btn btn-outline-primary" disabled>Pay</button>
                            @endif
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