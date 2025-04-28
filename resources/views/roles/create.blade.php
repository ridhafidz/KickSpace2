@extends('layouts.main')

@section('title', 'Create Role')

@section('content')
    <h1>Create Role</h1>
    <a href="{{ route('roles.index') }}" class="btn btn-secondary mb-3">Back to Users</a>

    <form action="{{ route('roles.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Role Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
