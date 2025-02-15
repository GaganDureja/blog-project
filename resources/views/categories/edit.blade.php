@extends('layouts.app')

@section('title', 'Update Category')

@section('content')
    <h1>Update Category</h1>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $category->name) }}" required>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('categories.index') }}" class="btn btn-warning">Cancel</a>
    </form>
@endsection
