@extends('layouts.app')

@section('title', 'Add Category')

@section('content')
    <h1>Add Category</h1>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <button class="btn btn-success">Save</button>
        <a href="{{ route('categories.index') }}" class="btn btn-warning">Cancel</a>
    </form>
@endsection
