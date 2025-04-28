@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Edit Setting Menu</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('settings.update') }}" method="POST">
            @csrf

            @foreach ($roles as $role)
                <div class="card mb-3">
                    <div class="card-header">
                        <strong>Role: {{ $role->name }}</strong>
                    </div>
                    <div class="card-body">
                        @foreach ($menus as $menu)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="settings[{{ $role->id }}][]"
                                    value="{{ $menu->id }}"
                                    {{ isset($selected[$role->id]) && in_array($menu->id, $selected[$role->id]) ? 'checked' : '' }}>
                                <label class="form-check-label">{{ $menu->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
