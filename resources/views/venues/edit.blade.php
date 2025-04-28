@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Venue</h1>

    <form action="{{ route('venues.update', $venue) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $venue->name }}" required>
        </div>

        <div class="form-group mb-2">
            <label>Image (optional)</label><br>
            @if($venue->image)
                <img src="{{ asset('storage/' . $venue->image) }}" width="100" class="mb-2">
            @endif
            <input type="file" name="image" class="form-control">
        </div>

        <div class="form-group mb-2">
            <label>Price Per Hour</label>
            <input type="text" name="price_per_hour" class="form-control" value="{{ $venue->price_per_hour }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>
@endsection
