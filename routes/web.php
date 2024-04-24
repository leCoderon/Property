<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PropertyController as ControllersPropertyController;

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

Route::get('/', [HomeController::class, 'index'])->name('homepage');

Route::get('/properties', [ControllersPropertyController::class, 'index'])->name('property.index');
Route::get('/services', [ControllersPropertyController::class, 'services'])->name('property.services');
Route::get('/about', [ControllersPropertyController::class, 'about'])->name('property.about');
Route::get('/contact-us', [ControllersPropertyController::class, 'contactUs'])->name('property.contactus');
Route::get('/properties/{slug}-{property}', [ControllersPropertyController::class, 'show'])->name('property.show')->where([
    'id' => '[0-9]+',
    'slug' => '[0-9a-z\-]+',
]);

Route::post('/properties/{property}/contact', [ControllersPropertyController::class, 'contact'])->name('property.contact')->where([
    'id' => '[0-9]+',
]);


Route::get('/login', [AuthController::class, 'login'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [AuthController::class, 'handleLogin']);
Route::delete('/logout', [AuthController::class, 'logout'])
    ->middleware("auth")
    ->name("logout");

// Administration
Route::prefix("admin")->name("admin.")->middleware('auth')->group(function () {
    Route::resource("property", PropertyController::class)->except(['show']);
    Route::resource("option", OptionController::class)->except(['show']);
    Route::delete('delete-image/{image}', [PropertyController::class, 'deleteImage'])
    ->name('deleteImage')
    ->can('delete', 'image');
});