@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Create Event</h1>

    <form action="{{ route('events.store') }}" method="POST">
        @csrf

        <div class="form-group mb-2">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group mb-2">
            <label>Registration Fee</label>
            <input type="text" name="registration_fee" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Save</button>
    </form>
</div>
@endsection
