@extends('layouts.app')

@section('content')
<div class="container">
            <div class="alert alert-danger error-message" style="display:none">
            <ul>
            </ul>
        </div>
    <a class='btn btn-primary' href='{{route('category.create')}}'>Add new category</a>
<table class="table table-stripped">
        <tr>
        <th>@sortablelink('id', 'ID')</th>
        <th>@sortablelink('title', 'Title')</th>
        <th>Excerpt</th>
        <th>Description</th>
        <th>Posts</th>
        <th>Actions</th>
    </tr>

    @foreach ($categories as $category)
        <tr>
            <td>{{$category->id}}</td>
            <td><a class='btn btn-info' href="{{route('category.show', [$category])}}">{{$category->title}}</a></td>
            <td>{!!$category->excerpt!!}</td>
            <td>{!!$category->description!!}</td>
            <td>{{$category->categoryPosts->count()}}</td>
             <td><a href='{{route('category.edit',[$category])}}' class='btn btn-secondary'>Edit</a>
                <form method="post" action={{route('category.destroy',[$category])}}>
                @csrf
                <button type="submit" class="btn btn-danger removeCategory">DELETE Category</button>
            </form></td>
        </tr>
    @endforeach
</table>
</div>

<script>


    $(document).ready(function() {
        $(document).on('click', ".removeCategory", function() {
            console.log('veikie');
            $(this).parents('.category').remove();
        });
    });

        </script>

@endsection
