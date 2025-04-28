@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Create Venue</h1>

    <form action="{{ route('venues.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>Image (optional)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Price Per Hour</label>
            <input type="text" name="price_per_hour" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Save</button>
    </form>
</div>
@endsection
