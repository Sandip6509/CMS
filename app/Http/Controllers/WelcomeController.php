<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome')
            ->with('categories',Category::all())
            ->with('tags',Tag::all())
            ->with('posts',Post::searched()->Paginate(2));
    }

}
