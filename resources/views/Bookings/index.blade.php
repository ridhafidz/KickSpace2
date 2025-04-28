@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Bookings</h1>
        <a href="{{ route('bookings.create') }}" class="btn btn-primary mb-3">Create Booking</a>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>User</th>
                    <th>Event</th>
                    <th>Venue</th>
                    <th>Date</th>
                    <th>Start</th>
                    <th>End</th>
                    <th>Total Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bookings as $booking)
                    <tr>
                        <td>{{ $booking->user->name ?? '-' }}</td>
                        <td>{{ $booking->event->name ?? '-' }}</td>
                        <td>{{ $booking->venue->name ?? '-' }}</td>
                        <td>{{ $booking->date }}</td>
                        <td>{{ $booking->start_time }}</td>
                        <td>{{ $booking->end_time }}</td>
                        <td>Rp{{ number_format($booking->total_price, 2) }}</td>
                        <td>
                            <a href="{{ route('bookings.edit', $booking) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('bookings.destroy', $booking) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Are you sure?')"
                                    class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
