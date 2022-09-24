@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                @csrf
                @method('PUT')

                @include('admin.categories.includes.form')
            </form>
        </div>
    </div>
</div>
@endsection