<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\User;
use App\Models\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard')->with('post_count',Post::all()->count())
                                    ->with('trashed_count',Post::onlyTrashed()->get()->count())
                                    ->with('users_count',User::all()->count())
                                    ->with('categories_count',Category::all()->count());

    }
}
