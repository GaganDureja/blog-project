@extends('layouts.app')

@section('title', 'Manage Categories')

@section('content')
<div class="container">
    <h2>Categories</h2>

    @if(auth()->check() && auth()->user()->is_admin)
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add Category</a>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    <td>
                        @if(auth()->check() && auth()->user()->is_admin)
                            <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('categories.destroy', $category) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?');">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
