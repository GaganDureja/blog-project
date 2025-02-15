@extends('layouts.app')

@section('title', $post->heading)

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-body">
            <h1 class="card-title">{{ $post->heading }}</h1>

            <!-- Category -->
            <p class="text-muted">
                <strong>Category:</strong>
                <a href="{{ route('category.show', $post->category->slug) }}" class="text-primary">
                    {{ $post->category->name }}
                </a>
            </p>

            <!-- Tags -->
            <p>
                <strong>Tags:</strong>
                @foreach($post->tags as $tag)
                    <a href="{{ route('tag.show', $tag->slug) }}" class="badge bg-secondary">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </p>

            <!-- Image -->
            @if($post->image)
                <img src="{{ asset('storage/'.$post->image) }}" alt="{{ $post->heading }}" class="img-fluid rounded my-3">
            @endif

            <!-- Description -->
            <p class="card-text">{{ $post->description }}</p>

            <a href="{{ route('home') }}" class="btn btn-outline-secondary">Back to Posts</a>
        </div>
    </div>
</div>
@endsection
