@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card card-default">
        <div class="card-header">
            {{ isset($post) ? 'Edit post':'Create post'}}
        </div>
        <div class="card-body">
            <form action="{{ isset($post) ? route('posts.update',$post->id)  : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" placeholder="Title" value="{{ isset($post) ? $post->title : '' }}">
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" cols="5" rows="5" class="form-control @error('description') is-invalid @enderror">{{ isset($post) ? $post->description : '' }}</textarea>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <input id="content" type="hidden" name="content" class="form-control @error('content') is-invalid @enderror" value="{{ isset($post) ? $post->content : '' }}">
                    <trix-editor input="content"></trix-editor>
                    @error('content')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="published_at">Published At</label>
                    <input type="text" name="published_at" class="form-control" value="{{ isset($post) ? $post->published_at : '' }}" id="published_at">
                </div>
                @if(isset($post))
                    <img src="{{ asset('storage/'. $post->image) }}" alt="" style="width: 100%">
                @endif
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-success">{{ isset($post) ? 'Update Post' : 'Add Post'}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        flatpickr('#published_at',{
            enableTime: true
        })
    </script>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.0.0/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@endsection