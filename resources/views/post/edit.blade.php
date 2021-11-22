@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit POST') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('post.update', [$post]) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="post_title" class="col-md-4 col-form-label text-md-right">{{ __('Post title') }}</label>
                            <div class="col-md-6">
                                <input id="post_title" type="text" class="form-control @error('post_title') is-invalid @enderror" name="post_title" value='{{ $post->title}}' required autocomplete="post_title" autofocus>
                                @error('post_title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_excerpt" class="col-md-4 col-form-label text-md-right" >{{ __('Post  excerpt:') }}</label>
                            <div class="col-md-6">
                               <textarea class='summernote' name='post_excerpt' required>
                                {!! $post->excerpt !!}
                               </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_description" class="col-md-4 col-form-label text-md-right" >{{ __('Post  description:') }}</label>
                            <div class="col-md-6">
                               <textarea class='summernote' name='post_description'  required>
                                {!! $post->description !!}
                            </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_picture" class="col-md-4 col-form-label text-md-right">{{ __('Post picture:') }}</label>
                            <div class="col-md-6">
                        <input type="file" name="post_picture" class="form-control" alt='{{$post->picture}}'>
                        <img src='{{$post->picture}}' alt='{{$post->picture}}' style='width:400px'>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                            <div class="col-md-6">
                                <select class="form-control @error('post_category_id') is-invalid @enderror"" name="post_category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}" @if($category->id == $post->category_id) selected @endif>{{$category->title}}</option>
                                    @endforeach
                                </select>
                                @error('post_category_id')
                                <span role="alert" class="invalid-feedback">
                                    {{$message}}
                                </span>
                            @enderror
                            </div>
                        </div>




                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save post') }}
                                </button>
                                <a href='{{route('post.index')}}'>Back</a>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>
@endsection
