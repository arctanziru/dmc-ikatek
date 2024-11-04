<?php

use App\Livewire\AboutUsPage;
use App\Livewire\AccountabilityPage;
use App\Livewire\Auth\Login;
use App\Livewire\Counter;
use App\Livewire\HistoryPage;
use App\Livewire\NewsPage;
use App\Livewire\OurTeamPage;
use App\Livewire\OurWorksPage;
use App\Livewire\DonatePage;
use App\Http\Controllers\HomeController; // Import the HomeController
use App\Livewire\Dashboard\News\NewsCreate;
use App\Livewire\Dashboard\News\NewsEdit;
use App\Livewire\Dashboard\News\NewsManagement;
use App\Livewire\Dashboard\User\UserCreate;
use App\Livewire\Dashboard\User\UserEdit;
use App\Livewire\Dashboard\User\UserManagement;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\StrategyPage;
use Illuminate\Support\Facades\Auth;
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
Route::get('/login', Login::class)->name('login');
Route::get('/news', NewsPage::class)->name('news');
Route::get('/our-works', OurWorksPage::class);
Route::get('/donate', DonatePage::class);
Route::get('/about-us', AboutUsPage::class);
Route::get('/leadership-and-organization', OurTeamPage::class);
Route::get('/history', HistoryPage::class);
Route::get('/strategy', StrategyPage::class);
Route::get('/accountability', AccountabilityPage::class);

Route::post('/logout', function () {
  Auth::logout();
  request()->session()->invalidate();
  request()->session()->regenerateToken();
  return redirect('/login');
})->name('logout');

Route::prefix('dashboard')
  ->middleware(['auth:sanctum', 'role:admin,reporter'])
  ->group(function () {
    Route::get('/', Dashboard::class)->name('dashboard');
    Route::group(['prefix' => 'users'], function () {
      Route::get('/', UserManagement::class)->name('users');
      Route::get('/create', UserCreate::class)->name('users.create');
      Route::get('/{user}/edit', UserEdit::class)->name('users.edit');
    });

    // news
    Route::group(['prefix' => 'news'], function () {
      Route::get('/', NewsManagement::class)->name('dashboard.news');
      Route::get('/create', NewsCreate::class)->name('dashboard.news.create');
      Route::get('/{news}/edit', NewsEdit::class)->name('dashboard.news.edit');
    });
  });