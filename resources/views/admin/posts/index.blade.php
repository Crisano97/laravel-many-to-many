@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">

                @if (session('result-message'))
                    <div class="alert alert-{{ session('result-class-message') }}">
                        {{ session('result-message') }}
                    </div>
                @endif

                <table class="table table-striped">
                    <thead>
                        <th>ID</th>
                        <th>Author</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Tags</th>
                    </thead>
                    <tbody>
                        @forelse ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->title }}</td>
                                <td>
                                    <span class="badge text-white" 
                                        @if (isset($post->category))
                                            style="background-color: {{ $post->category->color }}">
                                            {{ $post->category->name }}
                                        @else
                                            style="background-color: red">
                                            -
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <span>  
                                        @if (isset($post->tags))
                                            @foreach ($post->tags as $tag)
                                                #{{ $tag->name }}
                                            @endforeach
                                        @else
                                            no tag
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.posts.show', $post->id) }}" class="btn btn-sm btn-primary">
                                        View
                                    </a>
                                    <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-sm btn-success">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST" class="d-inline delete-comics">
                                        @csrf
                                        @method('DELETE')
                                        
                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </td>
                                
                            </tr>
                        @empty
                            <tr>
                                <td colspan=7>non sono disponibili post</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
