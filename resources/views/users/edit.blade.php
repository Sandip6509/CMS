@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="card card-default">
        <div class="card-header">My Profile</div>
        <div class="card-body">
            <form action="{{ route('users.update-profile') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control  @error('name') is-invalid @enderror" name="name" id="name" value="{{ $user->name }}">
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="about">About Me</label>
                    <textarea name="about" id="about" cols="5" rows="5" class="form-control @error('about') is-invalid @enderror">{{ $user->about }}</textarea>
                    @error('about')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <button type="submit" class="btn btn-success btn-sm">Update Profile</button>
            </form>
        </div>
    </div>
</div>
@endsection