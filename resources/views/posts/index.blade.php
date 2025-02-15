@extends('layouts.app')

@section('title', 'Posts')

@section('content')
    <h1>Posts</h1>
    @if(auth()->check())
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Add Post</a>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Heading</th>
                <th>Category</th>
                <th>Tags</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->heading }}</td>
                    <td>{{ $post->category->name }}</td>
                    <td>
                        @foreach ($post->tags as $tag)
                            <span class="badge bg-info">{{ $tag->name }}</span>
                        @endforeach
                    </td>
                    <td>
                        <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-info">View</a>
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger" onclick="return confirm('Delete this post?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
