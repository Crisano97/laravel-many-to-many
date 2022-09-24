@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
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
                    {{-- <span>   --}}
                        {{-- @if (isset($post->tags))
                            @foreach ($post->tags as $tag)
                                #{{ $tag->name }}
                            @endforeach
                        @else
                            no tag
                        @endif --}}
                        {{-- @forelse ($post->tags as $tag)
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
                    
                    <p class="card-text">{{ $post->post_content }}</p> --}}
                </div>
                
            </div>
            <div class="text-center mt-4">
                <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-success">
                    Edit
                </a>
                <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline delete-comics">
                    @csrf
                    @method('DELETE')
                    
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection