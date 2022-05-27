<?php

use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Category;
use App\Models\Setting;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontEndController::class,'index'])->name('home');
Route::get('/test',function(){
    return User::find(1)->profile;
});
Route::get('/post/{slug}',[FrontEndController::class,'singlePost'])->name('post.single');
Route::get('/category/{id}',[FrontEndController::class,'category'])->name('category.single');
Route::get('/tag/{id}',[FrontEndController::class,'tag'])->name('tag.single');
Route::get('/results',function(){
   $posts=Post::where('title','like','%'.request('query').'%')->get();
    return view('results')->with('posts',$posts)
                         ->with('title','Search Results:'.request('query'))
                        ->with('query',request('query'))
                        ->with('categories',Category::take(5)->get())
                        ->with('settings',Setting::first());

});

Auth::routes();



Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
    Route::get('/dashboard', [HomeController::class,'index'])->name('home');
    Route::get('/post/create',[PostsController::class,'create'])->name('post.create');
    Route::post('/post/store',[PostsController::class,'store'])->name('post.store');
    Route::get('/category/create',[CategoriesController::class,'create'])->name('category.create');
    Route::post('/category/store',[CategoriesController::class,'store'])->name('category.store');
    Route::get('/categories',[CategoriesController::class,'index'])->name('categories');
    Route::get('/category/edit/{id}',[CategoriesController::class,'edit'])->name('category.edit');
    Route::post('/category/update/{id}',[CategoriesController::class,'update'])->name('category.update');
    Route::get('/category/delete/{id}',[CategoriesController::class,'delete'])->name('category.delete');
    Route::get('/posts',[PostsController::class,'index'])->name('posts');
    Route::get('/post/edit/{id}',[PostsController::class,'edit'])->name('post.edit');
    Route::get('/post/destroy/{id}',[PostsController::class,'destroy'])->name('post.destroy');
    Route::post('/post/update/{id}',[PostsController::class,'update'])->name('post.update');
    Route::get('/posts/trashed',[PostsController::class,'trashed'])->name('post.trashed');
    Route::get('/posts/kill/{id}',[PostsController::class,'kill'])->name('post.kill');
    Route::get('/posts/restore/{id}',[PostsController::class,'restore'])->name('post.restore');
    Route::get('/tags',[TagsController::class,'index'])->name('tags');
    Route::get('/tag/edit/{id}',[TagsController::class,'edit'])->name('tag.edit');
    Route::get('/tag/destroy/{id}',[TagsController::class,'destroy'])->name('tag.destroy');
    Route::post('/tag/update/{id}',[TagsController::class,'update'])->name('tag.update');
    Route::post('/tag/store',[TagsController::class,'store'])->name('tags.store');
    Route::get('/tag/create',[TagsController::class,'create'])->name('tag.create');
    Route::get('/user/create',[UsersController::class,'create'])->name('user.create');
    Route::post('/user/store',[UsersController::class,'store'])->name('user.store');
    Route::get('/users',[UsersController::class,'index'])->name('users');
    Route::get('user/admin/{id}',[UsersController::class,'admin'])->name('user.admin')->middleware('admin');
    Route::get('user/not_admin/{id}',[UsersController::class,'not_admin'])->name('user.not_admin');
    Route::get('user/profile',[ProfilesController::class,'index'])->name('user.profile');
    Route::get('user/delete/{id}',[UsersController::class,'destroy'])->name('user.delete');
    Route::post('user/profile/update',[ProfilesController::class,'update'])->name('user.profile.update');
    Route::get('/settings',[SettingsController::class,'index'])->name('settings')->middleware('admin');
    Route::post('/settings/update',[SettingsController::class,'update'])->name('settings.update')->middleware('admin');


});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{id}', [BlogController::class, 'readPost'])->name('blog.post.read');
