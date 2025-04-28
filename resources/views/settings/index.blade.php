@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Setting Menu per Role</h2>

        <a href="{{ route('settings.create') }}" class="btn btn-success mb-3">Buat Setting Menu</a>
        <a href="{{ route('settings.edit') }}" class="btn btn-primary mb-3">Edit Setting Menu</a>

        @foreach ($roles as $role)
            <div class="card mb-3">
                <div class="card-header">
                    {{ $role->name }}
                </div>
                <div class="card-body">
                    @foreach ($menus as $menu)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="settings[{{ $role->id }}][]"
                                value="{{ $menu->id }}" disabled
                                {{ isset($selected[$role->id]) && in_array($menu->id, $selected[$role->id]) ? 'checked' : '' }}>
                            <label class="form-check-label">{{ $menu->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
