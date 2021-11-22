@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Category') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('category.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="category_title" class="col-md-4 col-form-label text-md-right">{{ __('Category title') }}</label>

                            <div class="col-md-6">
                                <input id="category_title" type="text" class="form-control @error('category_title') is-invalid @enderror" name="category_title" value='{{ old('category_title')}}' required autocomplete="category_title" autofocus>

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
                               <textarea class='summernote' name='category_excerpt' value='{{ old('category_excerpt') }}' required>
                               </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category_description" class="col-md-4 col-form-label text-md-right" >{{ __('Category  description:') }}</label>
                            <div class="col-md-6">
                               <textarea class='summernote' name='category_description' value='{{ old('category_description') }}' required>
                               </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-4">
                            </div>
                            <div class="col-md-4">
                                <input type="checkbox" id="postsNew" name="postsNew" value="1" />
                                <span>Add new post/s?</span>
                            </div>
                        </div>
                        <div class="posts-info d-none">
                            <div class="form-group row">
                                <div class="col-md-4">
                                </div>
                                <div class="col-md-6">
                                    <button type="button" class="btn btn-success" id="add-more-posts">Add More Posts</button>
                                </div>
                            </div>
                            <div class="post">
                                <div class="form-group row">
                                    <label for="postTitle" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                    <div class="col-md-6">
                                        <input type="text" class="form-control" name="postTitle[]">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="postExcerpt" class="col-md-4 col-form-label text-md-right">{{ __('Excerpt') }}</label>

                                    <div class="col-md-6">
                                        <textarea name="postExcerpt[]" class="form-control">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="postDescription" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                    <div class="col-md-6">
                                        <textarea name="postDescription[]" class="form-control">
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="postPicture" class="col-md-4 col-form-label text-md-right">{{ __('Post picture:') }}</label>
                                    <div class="col-md-6">
                                <input type="file" name="postPicture[]" class="form-control">
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>
                                <a href='{{route('category.index')}}'>Back</a>

                            </div>
                        </div>
                    </form>
                    <div class="post-template d-none">
                        <div class="post">
                            <div class="form-group row">
                                <label for="postTitle" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="postTitle[]">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="postExcerpt" class="col-md-4 col-form-label text-md-right">{{ __('Excerpt') }}</label>

                                <div class="col-md-4">
                                    <textarea name="postExcerpt[]" class=" form-control">
                                    </textarea>
                                </div>
                                <div class='col-md-2'>
                                    <button type='button' class='btn btn-danger removePost'>Remove post</button>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="postDescription" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>
                                <div class="col-md-4">
                                    <textarea name="postDescription[]" class="form-control">
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="post_picture" class="col-md-4 col-form-label text-md-right">{{ __('Picture:') }}</label>
                                <div class="col-md-6">
                            <input type="file" name="post_picture[]" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>

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
<script>
    $(document).ready(function() {
        $("#postsNew").click(function() {
           $(".posts-info").toggleClass("d-none");
        });
        $("#add-more-posts").click(function() {
           $(".posts-info").append($(".post-template").html());
             })

        $(document).on('click', ".removePost", function() {
             $(this).parents('.post').remove();
        });
    });
</script>
@endsection
