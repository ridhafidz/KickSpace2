@extends('layouts.main')

@section('title', 'Menu List')

@section('content')
<div class="container">
    <h1>Menu</h1>
    <a href="{{ route('menus.create') }}" class="btn btn-primary mb-3">Add Menu</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr><th>Name</th><th>Description</th><th>Link</th><th>Action</th></tr>
        </thead>
        <tbody>
        @foreach ($menus as $menu)
            <tr>
                <td>{{ $menu->name }}</td>
                <td>{{ $menu->deskripsi }}</td>
                <td>
                    <a href="{{ url($menu->link_menu) }}" target="_blank">{{ $menu->link_menu }}</a>
                </td>

                <td>
                    <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@endsection
