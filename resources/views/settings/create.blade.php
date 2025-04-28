@extends('layouts.main')

@section('content')
    <div class="container">
        <h2>Buat Setting Menu</h2>

        <form action="{{ route('settings.store') }}" method="POST">
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
                                    value="{{ $menu->id }}">
                                <label class="form-check-label">{{ $menu->name }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach

            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
    </div>
@endsection
