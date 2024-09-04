@extends('lay.app')

@section('body')
    <h1 class="mb-0">Add Customer Profile</h1>
    <hr />
    <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="name" class="form-control" placeholder="Name">
            </div>
            <div class="col">
                <input type="file" name="photo" class="form-control" placeholder="Photo">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <input type="text" name="address" class="form-control" placeholder="Address">
            </div>
            <div class="col">
                <input type="text" name="phone_number" class="form-control" placeholder="Phone Number">
            </div>
            <div class="col">
            </div>
            <div class="col">
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <textarea class="form-control" name="details" placeholder="Details"></textarea>
            </div>
            <div class="col">
                <input type="hidden" name="user_id" class="form-control" value="{{ Auth::id() }}" placeholder="{{ Auth::id() }}">
            </div>
        </div>
        @if(Auth::check() && (Auth::user()->role == 1 || Auth::user()->role == 2))
        <div class="row">
            <div class="col mb-3">
                <label class="form-label">Membership</label>
                <select class="form-select" name="membership">
                    <option value="Basic">Basic</option>
                    <option value="Premium">Premium</option>
                    <option value="None" selected>None</option>
                </select>
            </div>
        </div>
        @endif
        @if(Auth::check() && (Auth::user()->role == 3))
            <input type="hidden" name="membership" value="Basic">
        @endif
        <div class="row">
            <div class="d-grid">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </form>
@endsection