@extends('layouts.main')

@section('title', 'Add Menu')

@section('content')
<div class="container">
    <h1>Add Menu</h1>

    <form action="{{ route('menus.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="deskripsi" class="form-label">Description</label>
            <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="link_menu" class="form-label">Link Menu</label>
            <input type="text" class="form-control" id="link_menu" name="link_menu" value="{{ old('link_menu') }}" placeholder="/users" required>
        </div>


        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('menus.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
