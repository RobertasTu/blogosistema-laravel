@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New POST') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('post.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="post_title" class="col-md-4 col-form-label text-md-right">{{ __('Post title') }}</label>
                            <div class="col-md-6">
                                <input id="post_title" type="text" class="form-control @error('post_title') is-invalid @enderror" name="post_title" value='{{ old('post_title')}}' required autocomplete="post_title" autofocus>
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
                               <textarea class='summernote' name='post_excerpt' value='{{ old('post_excerpt') }}' required>
                               </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_description" class="col-md-4 col-form-label text-md-right" >{{ __('Post  description:') }}</label>
                            <div class="col-md-6">
                               <textarea class='summernote' name='post_description' value='{{ old('post_description') }}' required>
                               </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="post_picture" class="col-md-4 col-form-label text-md-right">{{ __('Post picture:') }}</label>
                            <div class="col-md-6">
                        <input type="file" name="post_picture" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row post_category_id">
                            <label for="post_category_id" class="col-md-4 col-form-label text-md-right">{{ __('Category') }}</label>
                            <div class="col-md-6">
                                <select id='post_category_id' class="form-control @error('post_category_id') is-invalid @enderror"" name="post_category_id">
                                    @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                                @error('post_category_id')
                                <span role="alert" class="invalid-feedback">
                                    {{$message}}
                                </span>
                            @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <input type="checkbox" id="categoryNew" name="categoryNew" value="1" />
                                <span>Add new category?</span>
                            </div>
                        </div>
                        <div class="category-info d-none">

                            <div class="form-group row">
                                <label for="category_title" class="col-md-4 col-form-label text-md-right">{{ __('Category title') }}</label>

                                <div class="col-md-6">
                                    <input id="category_title" type="text" class="form-control @error('category_title') is-invalid @enderror" name="category_title" value='{{ old('category_title')}}' >

                                    @error('category_title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category_excerpt" class="col-md-4 col-form-label text-md-right" >{{ __('Category  excerpt:') }}</label>
                                <div class="col-md-6">
                                   <textarea class='form-row' name='category_excerpt' value='{{ old('category_excerpt') }}'>
                                   </textarea>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="category_description" class="col-md-4 col-form-label text-md-right" >{{ __('Category  description:') }}</label>
                                <div class="col-md-6">
                                   <textarea class='form-row' name='category_description' value='{{ old('category_description') }}'>
                                   </textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create new post') }}
                                </button>
                                <a href='{{route('post.index')}}'>Back</a>

                            </div>
                    </div>
                    </form>



            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>

<script>
    $(document).ready(function() {
        $("#categoryNew").click(function() {
            $(".category-info").toggleClass("d-none");
            $(".post_category_id").toggleClass("d-none");
        });
    });
</script>
@endsection
