<?php

use App\Livewire\Auth\Login;
use App\Livewire\Counter;
use App\Livewire\OurWorksPage;
use App\Livewire\NewsPage;
use App\Http\Controllers\HomeController; // Import the HomeController
use Illuminate\Support\Facades\Route;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Define a route for the landing page
Route::get('/', [HomeController::class, 'index'])->name('home'); // Update to use HomeController

// Other routes
Route::get('/counter', Counter::class);
Route::get('/login', Login::class);
Route::get('/news', NewsPage::class)->name('news');
Route::get('/our-works', OurWorksPage::class);
