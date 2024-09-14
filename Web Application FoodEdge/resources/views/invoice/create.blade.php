@extends('lay.app')

@section('body')
    <h1 class="mb-0">Add invoice</h1>
    <hr />
        {{-- Debugging: Display user_id to check --}}
        <p>User ID: {{ Auth::id() }}</p>
    <form action="{{ route('invoice.store') }}" method="POST" >
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="col">
                <input type="text" name="item" class="form-control" placeholder="Item">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <textarea class="form-control" name="description" placeholder="Description"></textarea>
            </div>
        </div>
        <div class="row mb-3">
            {{-- <div class="col">
                <input type="text" name="invoice_number" class="form-control" placeholder="Invoice Number">
            </div>
            <div class="col">
                <input type="text" name="total_amount" class="form-control" placeholder="Total Amount">
            </div> --}}
            <div class="col">
                <input type="text" name="totalPaid" class="form-control" placeholder="Total Amount">
            </div>
            <div class="col">
                <input type="hidden" name="user_id" class="form-control" value="{{ Auth::id() }}" placeholder="{{ Auth::id() }}">
            </div>
            <div class="col">
                <input type="hidden" name="status" class="form-control" value="0" placeholder="0">
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection