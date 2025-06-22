@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Venue</h1>

    <form action="{{ route('venues.update', $venue) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $venue->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="price_per_hour">Price Per Hour</label>
            <input type="number" id="price_per_hour" name="price_per_hour" class="form-control @error('price_per_hour') is-invalid @enderror" value="{{ old('price_per_hour', $venue->price_per_hour) }}" required>
            @error('price_per_hour')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="image">Image (optional)</label>
            <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">

            @if ($venue->image)
                <div class="mt-2">
                    <small>Current Image:</small><br>
                    <img src="{{ asset('storage/' . $venue->image) }}" alt="{{ $venue->name }}" style="width: 150px; height: 100px; object-fit: cover; border-radius: 8px;">
                </div>
            @endif

            @error('image')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update</button>
        <a href="{{ route('venues.index') }}" class="btn btn-secondary mt-2">Cancel</a>
    </form>
</div>
@endsection
