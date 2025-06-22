@extends('layouts.main')

@section('content')
    <div class="container">
        <h1>Create Event</h1>

        {{-- Jika ada error umum (bukan dari validasi), tampilkan di sini --}}
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('events.store') }}" method="POST">
            @csrf

            <div class="form-group mb-3">
                <label for="name">Name</label>
                {{-- Tambahkan class 'is-invalid' jika ada error & tampilkan pesan error di bawahnya --}}
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="registration_fee">Registration Fee</label>
                {{-- Tambahkan class 'is-invalid' jika ada error & tampilkan pesan error di bawahnya --}}
                <input type="number" id="registration_fee" name="registration_fee" class="form-control @error('registration_fee') is-invalid @enderror" value="{{ old('registration_fee') }}" required>
                @error('registration_fee')
                    <div class="invalid-feedback" style="color: #dc3545;">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary mt-2">Save</button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary mt-2">Cancel</a>
        </form>
    </div>
@endsection
