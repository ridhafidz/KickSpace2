@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Venues</h1>
    <a href="{{ route('venues.create') }}" class="btn btn-primary mb-3">Add Venue</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Image</th>
                <th>Price Per Hour</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venues as $venue)
                <tr>
                    <td>{{ $venue->name }}</td>
                    <td>
                        @if($venue->image)
                            <img src="{{ asset('storage/' . $venue->image) }}" alt="Image" width="100">
                        @endif
                    </td>
                    <td>Rp{{ number_format($venue->price_per_hour, 2) }}</td>
                    <td>
                        <a href="{{ route('venues.edit', $venue) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('venues.destroy', $venue) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
