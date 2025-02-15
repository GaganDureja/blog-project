@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<div class="container">
    <h2>Create a New Post</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <select name="category_id" class="form-control" required>
                <option value="">Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="heading" class="form-label">Heading</label>
            <input type="text" name="heading" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" accept="image/*" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="tags" class="form-label">Tags (comma-separated, like Instagram)</label>
            <input type="text" name="tags" class="form-control" placeholder="e.g. Laravel, PHP, Blog">
        </div>

        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>
@endsection
