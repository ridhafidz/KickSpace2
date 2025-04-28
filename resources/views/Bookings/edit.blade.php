@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Booking</h1>

    <form action="{{ route('bookings.update', $booking) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Event</label>
            <select name="event_id" class="form-control" required>
                @foreach($events as $event)
                    <option value="{{ $event->id }}" @if($booking->event_id == $event->id) selected @endif>{{ $event->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Venue</label>
            <select name="venue_id" class="form-control" required>
                @foreach($venues as $venue)
                    <option value="{{ $venue->id }}" @if($booking->venue_id == $venue->id) selected @endif>{{ $venue->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Date</label>
            <input type="date" name="date" class="form-control" value="{{ $booking->date }}" required>
        </div>

        <div class="mb-3">
            <label>Start Time</label>
            <input type="time" name="start_time" class="form-control" value="{{ $booking->start_time }}" required>
        </div>

        <div class="mb-3">
            <label>End Time</label>
            <input type="time" name="end_time" class="form-control" value="{{ $booking->end_time }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
