@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('New Category') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('category.update', [$category]) }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="category_title" class="col-md-4 col-form-label text-md-right">{{ __('Category title') }}</label>

                            <div class="col-md-6">
                                <input id="category_title" type="text" class="form-control @error('category_title') is-invalid @enderror" name="category_title" value='{{$category->title}}' required autocomplete="category_title" autofocus>
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
                               <textarea class='summernote' name='category_excerpt' required>
                                {!!$category->excerpt!!}
                               </textarea>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="category_description" class="col-md-4 col-form-label text-md-right" >{{ __('Category  description:') }}</label>
                            <div class="col-md-6">
                               <textarea class='summernote' name='category_description' required>
                                {!!$category->description!!}
                            </textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save category') }}
                                </button>
                                <a href='{{route('category.index')}}'>Back</a>

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
