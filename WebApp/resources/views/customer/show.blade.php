@extends('lay.app')

@section('body')
    <!-- Profile Picture Section -->
    <div class="profile-picture text-center my-4">
        @if ($customer->photo)
            <img src="{{ asset($customer->photo) }}" alt="{{ $customer->name }}'s Photo" class="img-thumbnail profile-img">
        @else
            <p>No photo uploaded.</p>
        @endif
    </div>

    <h1 class="mb-0">Customer Details</h1>
    <hr />

    <!-- Wrap the receipt details content with the div element -->
    <div id="CustomerDetails">
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $customer->name }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">Membership</label>
                <input type="text" name="membership" class="form-control" placeholder="Paid" value="{{ $customer->membership }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Name" value="{{ $customer->address }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" placeholder="Item" value="{{ $customer->phone_number }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">About Me</label>
                <textarea class="form-control" name="details" placeholder="details" readonly>{{ $customer->details }}</textarea>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Created At</label>
                <input type="text" name="created_at" class="form-control" placeholder="Created At" value="{{ $customer->created_at }}" readonly>
            </div>
            <div class="col mb-3">
                <label class="form-label">Updated At</label>
                <input type="text" name="updated_at" class="form-control" placeholder="Updated At" value="{{ $customer->updated_at }}" readonly>
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
            <a href="{{ route('customer.edit', $customer->id) }}" type="button" class="btn btn-primary">Edit</a>
            </div>
        </div>
    </div>

    <style>
        .profile-picture {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .profile-img {
            border-radius: 50%;
            width: 150px; /* Adjust as needed */
            height: 150px; /* Adjust as needed */
            object-fit: cover; /* Ensure the image covers the entire circular area */
        }
    </style>
@endsection