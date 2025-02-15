@extends('layouts.app')

@section('title', 'Update Tag')

@section('content')
    <h1>Update Tag</h1>
    <form action="{{ route('tags.update', $tag->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Tag Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $tag->name) }}" required>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('tags.index') }}" class="btn btn-warning">Cancel</a>
    </form>
@endsection
