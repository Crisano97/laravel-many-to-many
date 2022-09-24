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
                        <th>Name</th>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>
                                    <span class="badge text-white" 
                                        @if (isset($category))
                                            style="background-color: {{ $category->color }}">
                                            {{ $category->name }}
                                        @else
                                            style="background-color: red">
                                            -
                                        @endif
                                    </span>
                                </td>
                                
                                <td>
                                    <a href="{{ route('admin.categories.show', $category->id) }}" class="btn btn-sm btn-primary">
                                        View
                                    </a>
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-success">
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline delete-comics">
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
