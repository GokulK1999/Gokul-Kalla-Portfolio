@extends('lay.app')

@section('body')
    <h1 class="mb-0">Edit Invoice</h1>
    <hr />
    <form action="{{ route('invoice.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $invoice->name }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Item</label>
                <input type="text" name="item" class="form-control" placeholder="Item" value="{{ $invoice->item }}" >
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Total Paid</label>
                <input type="text" name="totalPaid" class="form-control" placeholder="Total Amount" value="{{ $invoice->totalPaid }}" >
            </div>
            <div class="col mb-3">
                <label class="form-label">Description</label>
                <textarea class="form-control" name="description" placeholder="Description" >{{ $invoice->description }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Status</label>
                <select class="form-select" name="status">
                    <option value="1" @if($invoice->status) selected @endif>Yes</option>
                    <option value="0" @if(!$invoice->status) selected @endif>No</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
@endsection