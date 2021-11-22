@extends('layouts.app')

@section('content')
<div class="container">
    <a class='btn btn-primary' href='{{route('post.create')}}'>Add new post</a>

    <form action='{{route('post.index')}}' method='GET'>
        @csrf
        <div class="form-group row">
            <label for="filterCategory" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                <div class='col-md-6'>
                     <select class="form-control" name="filterCategory">
                        <option value="all" @if ($filterCategory == 'all') selected @endif>Visi</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" @if($filterCategory == $category->id) selected @endif>{{$category->title}}</option>
                          @endforeach
                        </select>
                </div>
                     <button type='submit' class='btn btn-primary'>Filter</button>
                     <a class='btn btn-success' href='{{route('post.index')}}'>Clear filter</a>

        </div>

    </form>


<table class="table table-stripped">
        <tr>
        <th>@sortablelink('id', 'ID')</th>
        <th>@sortablelink('title', 'Title')</th>
        <th>Excerpt</th>
        <th>Description</th>
        <th>@sortablelink('category_id', 'Category')</th>
        <th>Actions</th>
    </tr>

    @foreach ($posts as $post)
        <tr>
            <td>{{$post->id}}</td>
            <td><a class='btn btn-info' href="{{route('post.show', [$post])}}">{{$post->title}}</a></td>
            <td>{!!$post->excerpt!!}</td>
            <td>{!!$post->description!!}</td>
            <td>{{$post->postCategory->title}}</td>
             <td><a href='{{route('post.edit',[$post])}}' class='btn btn-secondary'>Edit</a>
                <form method="post" action={{route('post.destroy',[$post])}}>
                @csrf
                <button type="submit" class="btn btn-danger">DELETE POST</button>
            </form></td>
        </tr>
    @endforeach
</table>
{!! $posts->appends(Request::except('page'))->render()  !!}
</div>

@endsection
