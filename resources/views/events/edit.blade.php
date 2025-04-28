@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit Event</h1>

    <form action="{{ route('events.update', $event) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ $event->name }}" required>
        </div>

        <div class="form-group mb-2">
            <label>Registration Fee</label>
            <input type="text" name="registration_fee" class="form-control" value="{{ $event->registration_fee }}" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
</div>
@endsection
