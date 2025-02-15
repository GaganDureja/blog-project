@extends('layouts.app')

@section('title', 'Tags')

@section('content')
    <h1>Tags</h1>
    @if(auth()->check() && auth()->user()->is_admin)
        <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Add Tag</a>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>
                        @if(auth()->check() && auth()->user()->is_admin)
                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('tags.destroy', $tag->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger" onclick="return confirm('Delete this tag?')">Delete</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
