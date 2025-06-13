<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'index']);

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');

Route::get('new-topic', function () {
    return view('client.new-topic');
});
Route::get('category/overview/{id}', [FrontendController::class, 'categoryOverview'])->name('category.overview');
Route::get('forum/overview/{id}', [FrontendController::class, 'forumOverview'])->name('forum.overview');

//dashboard
Route::middleware(['auth',Admin::class])->prefix('dashboard')->group(function () {
    Route::get('home', [DashboardController::class, 'home'])->name('dashboard.home');
//categories
    Route::get('category/new', [CategoryController::class, 'create'])->name('category.new');
    Route::post('category/new', [CategoryController::class, 'store'])->name('category.store');
    Route::get('categories', [CategoryController::class, 'index'])->name('categories');
    Route::get('categories/{id}', [CategoryController::class, 'show'])->name('category');
    Route::get('categories/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
    Route::post('categories/edit/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::delete('categories/delete/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
// forums
    Route::get('forum/new', [ForumController::class, 'create'])->name('forum.new');
    Route::post('forum/new', [ForumController::class, 'store'])->name('forum.store');
    Route::get('forums', [ForumController::class, 'index'])->name('forums');
    Route::get('forums/{id}', [ForumController::class, 'show'])->name('forum');
    Route::get('forums/edit/{id}', [ForumController::class, 'edit'])->name('forum.edit');
    Route::post('forums/edit/{id}', [ForumController::class, 'update'])->name('forum.update');
    Route::delete('forums/delete/{id}', [ForumController::class, 'destroy'])->name('forum.destroy');
//users
    Route::get('users', [DashboardController::class, 'users'])->name('all_users');
    Route::get('admin/profile', [DashboardController::class, 'profile'])->name('admin.profile');
    Route::get('users/{id}', [DashboardController::class, 'show'])->name('show_user');
    Route::delete('users/{id}', [DashboardController::class, 'destroy'])->name('user.delete');
//notifications
    Route::get('notifications', [DashboardController::class, 'notifications'])->name('notifications');
    Route::get('notifications/mark-as-read/{id}', [DashboardController::class, 'markAsRead'])->name('notification.read');
    Route::delete('notifications/delete/{id}', [DashboardController::class, 'notificationDestroy'])->name('notification.delete');
//settings
    Route::get('settings/form', [DashboardController::class, 'settingsForm'])->name('settings.form');
    Route::post('settings/new', [DashboardController::class, 'newSetting'])->name('settings.new');
});

Route::middleware('auth')->prefix('client')->group(function () {
//  topics
    Route::get('topic/new/{id}', [TopicController::class, 'create'])->name('topic.new');
    Route::post('topic/new', [TopicController::class, 'store'])->name('topic.store');
    Route::get('topic/{id}', [TopicController::class, 'show'])->name('topic');
    Route::post('topic/reply/{id}', [TopicController::class, 'reply'])->name('topic.reply');
    Route::delete('topic/remove/{id}', [TopicController::class, 'remove'])->name('topic.delete');
    Route::delete('topic/reply/delete/{id}', [TopicController::class, 'destroy'])->name('reply.delete');

    Route::get('/user/{id}', [FrontendController::class, 'profile'])->name('client.user.profile');
    Route::get('/users', [FrontendController::class, 'users'])->name('client.users');
});

// get the latest updates from telegram chat group
Route::get('/updates', [TopicController::class, 'updates']);

Route::middleware('auth')->group(function (){
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('user/photo/update/{id}', [FrontendController::class, 'photoUpdate'])->middleware('auth')->name('user.photo.update');
    Route::post('reply/like/{id}', [TopicController::class, 'like'])->name('reply.like');
    Route::post('reply/dislike/{id}', [TopicController::class, 'dislike'])->name('reply.dislike');
});
    Route::post('category/search', [CategoryController::class, 'search'])->name('category.search');



//TODO
//Convert all deletes(destroy) to post or delete => route::delete
//*********DONE************//
// Have a look at like and dislike functions (a user should not be able to like twice / so, a table is needed for liked replies by users
//*********DONE************//
// make some default users, admins, categories, forums, ..... as seed
//*********DONE************//
// make sort by and pages at the bottom of forum-overview
//*********DONE************//
// remove unused css and js in dashboard.blade and app.blade in layouts folder
//add about of the previous projects to the project menu
