@extends('layouts.main')

@section('content')
<div class="container">
    <h1>Edit User</h1>

    {{-- Penting: tambahkan enctype untuk file upload --}}
    <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $user->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="profile_picture">Profile Picture (optional)</label>
            <input type="file" id="profile_picture" name="profile_picture" class="form-control @error('profile_picture') is-invalid @enderror">

            @if ($user->profile_picture)
                <div class="mt-2">
                    <small>Current Picture:</small><br>
                    <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" style="width: 100px; height: 100px; object-fit: cover; border-radius: 50%;">
                </div>
            @endif

            {{-- Menampilkan pesan error validasi untuk gambar profil --}}
            @error('profile_picture')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="password">New Password (optional)</label>
            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror">
            <small class="form-text text-muted">Leave blank if you don't want to change the password.</small>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mb-3">
            <label for="password_confirmation">Confirm New Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="role_id">Role</label>
            <select id="role_id" name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                <option value="">Select Role</option>
                @foreach($roles as $role)
                    <option value="{{ $role->id }}" {{ old('role_id', $user->role_id) == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
            @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-2">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary mt-2">Cancel</a>
    </form>
</div>
@endsection
