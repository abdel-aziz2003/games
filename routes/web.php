<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\CategoryController;

//WelcomeController
Route::get('/megzy', [WelcomeController::class, 'megzy'])->name('megzy');
Route::get('/', [WelcomeController::class, 'index'])->name('welcome');
Route::post('/filter/{route}/{ext?}', [WelcomeController::class, 'filter'])->name('filter');
Route::get('/notice', [WelcomeController::class, 'notice'])->name('notice');
Route::get('/contact', [WelcomeController::class, 'contact'])->name('contact');
Route::post('/contact/store', [WelcomeController::class, 'contact_store'])->name('contact_store');
Route::get('/search', [WelcomeController::class, 'search'])->name('search');


//CategoryController
Route::get('/category/index', [CategoryController::class, 'index'])->middleware(['auth', 'access:1'])->name('category');
Route::get('/category/create/{id?}', [CategoryController::class, 'create'])->middleware(['auth', 'access:1'])->name('category_create');
Route::post('/category/store', [CategoryController::class, 'store'])->middleware(['auth', 'access:1', 'demo'])->name('category_store');
Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->middleware(['auth', 'access:1', 'demo'])->name('category_delete');



//PageController
Route::get('/page/index', [PageController::class, 'index'])->middleware(['auth', 'access:1'])->name('page');
Route::get('/page/create/{id?}', [PageController::class, 'create'])->middleware(['auth', 'access:1'])->name('page_create');
Route::post('/page/store', [PageController::class, 'store'])->middleware(['auth', 'access:1', 'demo'])->name('page_store');
// Route::get('/{name}', [PageController::class, 'view'])->name('page_view');\
Route::get('/{name}', [PageController::class, 'view'])
    ->where('name', 'about-us|privacy-policy|terms-of-services')
    ->name('page_view');
Route::get('/page/delete/{id}', [PageController::class, 'delete'])->middleware(['auth', 'access:1', 'demo'])->name('page_delete');

//UserController
Route::get('/dashboard', [UserController::class, 'dashboard'])->middleware(['auth', 'verified', 'access:1'])->name('dashboard');

//SettingController
Route::get('/setting/create', [SettingController::class, 'create'])->middleware(['auth', 'access:1'])->name('setting_create');
Route::post('/setting/store', [SettingController::class, 'store'])->middleware(['auth', 'access:1', 'demo'])->name('setting_store');
Route::get('setting/icon_create', [SettingController::class, 'icon_create'])->middleware(['auth','access:1'])->name('setting_icon_create');
Route::post('setting/icon_store', [SettingController::class, 'icon_store'])->middleware(['auth','access:1', 'demo'])->name('setting_icon_store');
Route::get('/setting/social_create', [SettingController::class, 'social_create'])->middleware(['auth','verified','access:1'])->name('setting_social_create');
Route::post('/setting/social_store', [SettingController::class, 'social_store'])->middleware(['auth','verified','access:1', 'demo'])->name('setting_social_store');
Route::get('/setting/banner_create', [SettingController::class, 'banner_create'])->middleware(['auth', 'access:1'])->name('setting_banner_create');
Route::post('/setting/banner_store', [SettingController::class, 'banner_store'])->middleware(['auth', 'access:1', 'demo'])->name('setting_banner_store');
Route::get('/setting/adsense_create', [SettingController::class, 'adsense_create'])->middleware(['auth', 'access:1'])->name('adsense_create');
Route::post('/setting/adsense_store', [SettingController::class, 'adsense_store'])->middleware(['auth', 'access:1', 'demo'])->name('adsense_store');
Route::get('/setting/advert_create', [SettingController::class, 'advert_create'])->middleware(['auth', 'access:1'])->name('advert_create');
Route::post('/setting/advert_store', [SettingController::class, 'advert_store'])->middleware(['auth', 'access:1', 'demo'])->name('advert_store');
Route::get('/setting/remove_ad/{ad}', [SettingController::class, 'remove_ad'])->middleware(['auth', 'access:1', 'demo'])->name('remove_ad');
Route::get('/setting/captcha', [SettingController::class, 'captcha'])->middleware(['auth', 'access:1'])->name('captcha');
Route::post('/setting/captcha_store', [SettingController::class, 'captcha_store'])->middleware(['auth', 'access:1', 'demo'])->name('captcha_store');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->middleware(['demo'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->middleware(['demo'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


//GameController
// Route::get('/create', [GameController::class, 'manage'])->middleware(['auth', 'access:1'])->name('game_manage');
Route::get('/create', [GameController::class, 'manage'])->middleware(['auth', 'access:1'])->name('game_manage');
Route::get('/game/create/{id?}', [GameController::class, 'create'])->middleware(['auth', 'access:1'])->name('game_create');
Route::post('/game/store', [GameController::class, 'store'])->middleware(['auth', 'access:1', 'demo'])->name('game_store');
Route::get('/game/delete/{id}', [GameController::class, 'delete'])->middleware(['auth', 'access:1', 'demo'])->name('game_delete');
Route::get('/game/play/{slug}', [GameController::class, 'play'])->name('play');
Route::post('/game/like_game', [GameController::class, 'like_game'])->name('like_game');
Route::post('/game/dislike_game', [GameController::class, 'dislike_game'])->name('dislike_game');
Route::get('/{category_slug?}', [GameController::class, 'index'])->name('game');
