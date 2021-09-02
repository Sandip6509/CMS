@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card card-default">
        <div class="card-header">
            {{ isset($tag) ? 'Edit tag':'Create tag'}}
        </div>
        <div class="card-body">
            <form action="{{ isset($tag) ? route('tags.update',$tag->id)  : route('tags.store') }}" method="POST">
                @csrf
                @if(isset($tag))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" value="{{ isset($tag) ? $tag->name : '' }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-success">{{ isset($tag) ? 'Update Tag' : 'Add Tag'}}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection