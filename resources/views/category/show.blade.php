@extends('layouts.app')


@section('content')
{{-- <a href='{{route('category.pdfcategory', [$category])}}' class='btn btn-primary'>Export category PDF</a> --}}
<div class='container'>

<h2> ID: {{$category->id}}</h2>
<h2> Title: {{$category->title}}</h2>
<h2>Total posts: {{$postsCount}}</h2>

@if($postsCount !=0)
<h3 class='posts-list'>Posts list</h3>
<table class="posts table table-striped">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Excerpt</th>
        <th>Description</th>
        <th>Actions</th>
    </tr>
@foreach ($posts as $post)
<tr class="post">
    <td>{{$post->id}}</td>
    <td>{{$post->title}}</td>
    <td>{!!$post->excerpt!!}</td>
    <td>{!!$post->description!!}</td>
<td>
    {{-- <form method="POST" action="{{route('post.destroy',[$post])}}">
        @csrf
        <button type="submit" class="btn btn-primary">DELETE </button>
    </form> --}}

    <button class="btn btn-danger postDelete" data-postid="{{$post->id}}">DELETE AJAX</button>
</td>
</tr>

@endforeach
</table>
@else
<div class="alert alert-danger">
    <p>No posto in ze kategorijo</p>
</div>
@endif

<a class='btn btn-success' href='{{route('category.edit', [$category])}}'>Edit category</a>
<a class='btn btn-secondary' href='{{route('category.index')}}'>Back</a>
</div>

<script>
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $(".postDelete").click(function() {
            var postID = $(this).attr("data-postid");
            $(this).parents(".post").remove();

            $.ajax({
                type: 'POST',
                url: '/posts/deleteAjax/' + postID ,
                success: function(data) {
                    alert(data.success);
                    console.log(data.postsCount);
                    if(data.postsCount == 0) {
                        $(".posts").remove();
                        $(".posts-list").remove();
                        $(".container-show").append("<div class='alert alert-danger'><p>No posts in the category</p></div> ")

                    }
                }
            });
        });
    });
</script>



@endsection
