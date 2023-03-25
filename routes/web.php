<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\CommentController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
 

Route::get('/', [TestController::class, 'test']);

Route::get('/posts', [PostController::class, 'index'])->name('posts.index')->middleware('auth');

Route::group(['middleware'=>['auth']],function(){
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
    
    Route::get('/posts/edit/{post}', [PostController::class, 'edit'])->name('posts.edit');
    
    Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
    
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    
    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
    
    Route::post('/comments/{post}', [CommentController::class, 'store'])->name('comments.store');

    Route::delete('/comments/{id}', [CommentController::class, 'destroy'])->name('comments.destroy');    


});




Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



use Laravel\Socialite\Facades\Socialite;
 
Route::get('/auth/redirect', function () {
    // dd("stop");
    return Socialite::driver('github')->redirect();
});
 
Route::get('/auth/callback', function () {
    // $user = Socialite::driver('github')->user();
    // dd($user);
    $githubUser = Socialite::driver('github')->user();
    // dd($githubUser);
    $user = User::updateOrCreate([
        'github_id' => $githubUser->id,
    ], [
        'name' => $githubUser->name,
        'email' => $githubUser->email,
        'github_token' => $githubUser->token,
        'github_refresh_token' => $githubUser->refreshToken,
    ]);
 
    Auth::login($user);
    
});


// Http::get('https://api.github.com/issues',[
// 'Authorization'=>'Bearer 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'

// ]);