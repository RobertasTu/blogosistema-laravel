@extends('layouts.app')


@section('content')
{{-- <a href='{{route('category.pdfcategory', [$category])}}' class='btn btn-primary'>Export category PDF</a> --}}
<div class='container'>

<h2> ID: {{$post->id}}</h2>
<h2> Title: {{$post->title}}</h2>
<h2> Excerpt: {!!$post->excerpt!!}</h2>
<h2> Descripiton: {!!$post->description!!}</h2>
<h2> Picture: <img src='{{$post->picture}}' alt='{{$post->picture}}' style='width:400px'></h2>
<h2> Category: {{$post->postCategory->title}}</h2>

<a class='btn btn-secondary' href='{{route('post.edit', [$post])}}'>Edit</a>


<a class='btn btn-success' href='{{route('post.index')}}'>Back</a>
</div>





@endsection
