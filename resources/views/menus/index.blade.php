@extends('layouts.main')

@section('title', 'Menu Management')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Menu</h1>
        <a href="{{ route('menus.create') }}" class="btn btn-primary">Add Menu</a>
    </div>

    {{-- Menampilkan pesan sukses setelah membuat/mengupdate menu --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th style="width: 10%;">Icon</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Link</th>
                            <th style="width: 15%;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($menus as $menu)
                        <tr>
                            {{-- Kolom baru untuk menampilkan ikon --}}
                            <td class="text-center">
                                @if($menu->icon_class)
                                    <i class="{{ $menu->icon_class }}" style="font-size: 1.5rem;"></i>
                                @endif
                            </td>
                            <td>{{ $menu->name }}</td>
                            <td>{{ $menu->deskripsi }}</td>
                            <td>{{ $menu->link_menu }}</td>
                            <td>
                                <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        {{-- Pesan jika tidak ada menu sama sekali --}}
                        <tr>
                            <td colspan="5" class="text-center">No menus found. Click "Add Menu" to create one.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
