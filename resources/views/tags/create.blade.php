@extends('layouts.app')

@section('title', 'Add Tag')

@section('content')
    <h1>Add Tag</h1>
    <form action="{{ route('tags.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Tag Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('tags.index') }}" class="btn btn-warning">Cancel</a>
    </form>
@endsection
