@extends('layouts.main')

@section('title', 'Edit Menu')

@section('content')
    <div class="container">
        <h1>Edit Menu</h1>

        {{-- Menampilkan error validasi jika ada --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('menus.update', $menu->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $menu->name) }}"
                    required>
            </div>

            <div class="mb-3">
                <label for="deskripsi" class="form-label">Description</label>
                <textarea class="form-control" id="deskripsi" name="deskripsi" required>{{ old('deskripsi', $menu->deskripsi) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="link_menu" class="form-label">Link Menu</label>
                <input type="text" class="form-control" id="link_menu" name="link_menu"
                    value="{{ old('link_menu', $menu->link_menu) }}" required>
            </div>

            {{-- === BLOK KODE YANG DITAMBAHKAN === --}}
            <div class="mb-3">
                <label for="icon_class" class="form-label">Icon Class</label>
                <input type="text" class="form-control" id="icon_class" name="icon_class"
                    value="{{ old('icon_class', $menu->icon_class) }}" placeholder="Contoh: mdi mdi-calendar-check">
                <div class="form-text">
                    Cari nama kelas ikon di <a href="https://materialdesignicons.com/" target="_blank">Material Design
                        Icons</a>.
                </div>
            </div>
            {{-- =================================== --}}

            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('menus.index') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
