@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.categories.store') }}" method="post">
                @csrf
                @method('POST')

                @include('admin.categories.includes.form')
            </form>
        </div>
    </div>
</div>
@endsection