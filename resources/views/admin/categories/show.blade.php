@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="card text-center ">
                <div class="card-body">
                    <span class="badge text-white" 
                        @if (isset($category))
                            style="background-color: {{ $category->color }}">
                            {{ $category->name }}
                        @else
                            style="background-color: red">
                            -
                        @endif
                    </span>
                </div>
            </div>
            @forelse ($category->posts as $post)
                <div class="col-12 mt-4">
                    <div class="card text-center ">
                        @if (filter_var($post->post_image, FILTER_VALIDATE_URL))
                            <img src="{{ $post->post_image }}" class="card-img-top" alt="{{ $post->title }}">                    
                        @else
                            <img src="{{ asset('storage/' . $post->post_image) }}" class="card-img-top" alt="">
                        @endif
                        <div class="card-body">
                            <span class="badge text-white" 
                                @if (isset($post->category))
                                    style="background-color: {{ $post->category->color }}">
                                    {{ $post->category->name }}
                                @else
                                    style="background-color: red">
                                    -
                                @endif
                            </span>
                            <span>  
                                @forelse ($post->tags as $tag)
                                    <span>
                                        #{{ $tag->name }}
                                    </span>
                                @empty
                                    <span>
                                        no tag
                                    </span>
                                @endforelse
                            </span>
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <span>{{ $post->user->name }}</span>
                            <span>{{ $post->post_date }}</span>
                            
                            <p class="card-text">{{ $post->post_content }}</p>
                        </div>
                        <form action="{{ route('admin.removePostFromCategory', $post->id) }}" method="POST" class="d-inline delete-comics">
                            @csrf
                            @method('PUT')
                            
                            <button type="submit" class="btn btn-sm btn-warning">Remove poste from this category</button>
                        </form>
                    </div>
                </div>
                @empty
                    no posts
                @endforelse
            <div class="text-center mt-4">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-success">
                    Edit
                </a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline delete-method">
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection