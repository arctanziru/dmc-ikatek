<?php

use App\Livewire\AboutUsPage;
use App\Livewire\AccountabilityPage;
use App\Livewire\Auth\Login;
use App\Livewire\Counter;;

use App\Livewire\HistoryPage;
use App\Livewire\NewsPage;
use App\Livewire\OurReachPage;
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
use App\Livewire\Dashboard\Disaster\DisasterCreate;
use App\Livewire\Dashboard\Disaster\DisasterEdit;
use App\Livewire\Dashboard\Disaster\DisasterManagement;
use App\Livewire\Dashboard\Disaster\Program\Category\DisasterProgramCategoryCreate;
use App\Livewire\Dashboard\Disaster\Program\Category\DisasterProgramCategoryEdit;
use App\Livewire\Dashboard\Disaster\Program\Category\DisasterProgramCategoryManagement;
use App\Livewire\Dashboard\Disaster\Program\DisasterProgramCreate;
use App\Livewire\Dashboard\Disaster\Program\DisasterProgramEdit;
use App\Livewire\Dashboard\Disaster\Program\DisasterProgramManagement;
use App\Livewire\Dashboard\Donation\DonationCreate;
use App\Livewire\Dashboard\Donation\DonationEdit;
use App\Livewire\Dashboard\Donation\DonationManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Reporter\Reporter;
use App\Livewire\Reporter\Disaster\DisasterReportManagement;
use App\Livewire\Reporter\Disaster\DisasterReportCreate;
use App\Livewire\ReportDisaster;
use App\Livewire\DisasterPage;
use App\Livewire\ProgramPage;

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
Route::get('/our-reach', OurReachPage::class);
Route::get('/donate', DonatePage::class);
Route::get('/about-us', AboutUsPage::class);
Route::get('/leadership-and-organization', OurTeamPage::class);
Route::get('/history', HistoryPage::class);
Route::get('/strategy', StrategyPage::class);
Route::get('/accountability', AccountabilityPage::class);
Route::get('/disaster', DisasterPage::class);
Route::get('/disaster/report', ReportDisaster::class)->name('report.disaster');
Route::get('/programs', ProgramPage::class);

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

    Route::group(['prefix' => 'disaster'], function () {
      Route::get('/', DisasterManagement::class)->name('dashboard.disaster');
      Route::get('/create', DisasterCreate::class)->name('dashboard.disaster.create');
      Route::get('/{disaster}/edit', DisasterEdit::class)->name('dashboard.disaster.edit');
      Route::group(['prefix' => 'program'], function () {
        Route::get('/', DisasterProgramManagement::class)->name('dashboard.disaster.program');
        Route::get('/create', DisasterProgramCreate::class)->name('dashboard.disaster.program.create');
        Route::get('/{program}/edit', DisasterProgramEdit::class)->name('dashboard.disaster.program.edit');

        Route::group(['prefix' => 'category'], function () {
          Route::get('/', DisasterProgramCategoryManagement::class)->name('dashboard.disaster.program.category');
          Route::get('/create', DisasterProgramCategoryCreate::class)->name('dashboard.disaster.program.category.create');
          Route::get('/{category}/edit', DisasterProgramCategoryEdit::class)->name('dashboard.disaster.program.category.edit');
        });
      });
    });

    Route::group(['prefix' => 'donation'], function () {
      Route::get('/', DonationManagement::class)->name('dashboard.donation');
      Route::get('/create', DonationCreate::class)->name('dashboard.donation.create');
      Route::get('/{donation}/edit', DonationEdit::class)->name('dashboard.donation.edit');
    });
  });


// Route::prefix('report')
//   ->middleware(['auth:sanctum', 'role:admin,reporter'])
//   ->group(function () {
//     Route::get('/dashboard', Reporter::class)->name('reporter.dashboard');
//     Route::get('/disaster', DisasterReportCreate::class)->name('reporter.disaster');
//   });