@extends('lay.app')

@section('body')
    <h1 class="mb-0">Edit Customer Profile</h1>
    <hr />
    <form action="{{ route('customer.update', $customer->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Photo</label>
                @if ($customer->photo)
                    <div class="mb-3">
                        <img src="{{ asset($customer->photo) }}" alt="{{ $customer->name }}'s Photo" class="img-thumbnail profile-img" style="width: 150px; height: 150px; object-fit: cover;">
                    </div>
                @endif
                <input type="file" name="photo" class="form-control" placeholder="Photo">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ $customer->name }}">
            </div>
        </div>
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control" placeholder="Address" value="{{ $customer->address }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Phone Number</label>
                <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" value="{{ $customer->phone_number }}">
            </div>
            <div class="col mb-3">
                <label class="form-label">Details</label>
                <textarea class="form-control" name="details" placeholder="Details">{{ $customer->details }}</textarea>
            </div>
        </div>
        @if(Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 2))
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Membership</label>
                <select class="form-select" name="membership">
                    <option value="Basic" @if($customer->membership == 'Basic') selected @endif>Basic</option>
                    <option value="Premium" @if($customer->membership == 'Premium') selected @endif>Premium</option>
                    <option value="None" @if($customer->membership == 'None') selected @endif>None</option>
                </select>
            </div>
        </div>
        @endif
        @if(Auth::check() && (Auth::user()->role == 3))
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Membership</label>
                <input type="text" name="membership" class="form-control" placeholder="Paid" value="{{ $customer->membership }}" readonly>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-warning">Update</button>
            </div>
        </div>
    </form>
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