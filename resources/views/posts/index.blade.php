@extends('layouts.app')

@section('content')
<div class="col-md-8">
    <div class="d-flex justify-content-end mb-2">
        <a href="{{ route('posts.create') }}" class="btn btn-success float-right">Add Post</a>
    </div>
    <div class="card card-default">
        <div class="card-header">Posts</div>
        <div class="card-body">
            @if($posts->count() > 0)
            <table class="table">
                <thead>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th></th>
                    <th class="text-right">Action</th>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>
                                <img src="{{ asset('storage/'.$post->image) }}" width="60px" height="60px">
                            </td>
                            <td>
                                {{ $post->title }}
                            </td>
                            <td>
                                <a href="{{ route('categories.edit',$post->category->id) }}">
                                    {{ $post->category->name }}
                                </a>
                            </td>
                            @if ($post->trashed())
                                <td class="text-right">
                                    <form action="{{ route('restore-posts', $post->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-info btn-sm">Restore</button>
                                    </form>
                                    
                                </td>
                            @else
                                <td class="text-right">
                                    <a href="{{ route('posts.edit',$post->id) }}" class="btn btn-info btn-sm">Edit</a>
                                </td>
                            @endif
                            <td class="text-right">
                                <form action="{{ route('posts.destroy',$post->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="" class="btn btn-danger btn-sm">
                                        {{ $post->trashed() ? 'Delete' : 'Trash' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <h3 class="text-center">No Posts Yet</h3>
            @endif
        </div>
    </div>
</div>
@endsection