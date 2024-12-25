<?php

use App\Livewire\AboutUsPage;
use App\Livewire\Auth\Login;
use App\Livewire\Counter;;

use App\Livewire\NewsPage;
use App\Livewire\NewsDetailPage;
use App\Livewire\OurReachPage;
use App\Livewire\OurWorksPage;
use App\Livewire\DonatePage;
use App\Http\Controllers\PushSubscriptionController;
use App\Livewire\Dashboard\CoveredArea\CoveredAreaCreate;
use App\Livewire\Dashboard\CoveredArea\CoveredAreaEdit;
use App\Livewire\Dashboard\CoveredArea\CoveredAreaManagement;
use App\Livewire\Dashboard\News\NewsCreate;
use App\Livewire\Dashboard\News\NewsEdit;
use App\Livewire\Dashboard\News\NewsManagement;
use App\Livewire\Dashboard\User\UserCreate;
use App\Livewire\Dashboard\User\UserEdit;
use App\Livewire\Dashboard\User\UserManagement;
use App\Livewire\Dashboard\Dashboard;
use App\Livewire\Dashboard\Disaster\DisasterCreate;
use App\Livewire\Dashboard\Disaster\DisasterEdit;
use App\Livewire\Dashboard\Disaster\DisasterManagement;
use App\Livewire\Dashboard\Disaster\Program\AreaOfWork\AreaOfWorkCreate;
use App\Livewire\Dashboard\Disaster\Program\AreaOfWork\AreaOfWorkEdit;
use App\Livewire\Dashboard\Disaster\Program\AreaOfWork\AreaOfWorkManagement;
use App\Livewire\Dashboard\Disaster\Program\Category\DisasterProgramCategoryCreate;
use App\Livewire\Dashboard\Disaster\Program\Category\DisasterProgramCategoryEdit;
use App\Livewire\Dashboard\Disaster\Program\Category\DisasterProgramCategoryManagement;
use App\Livewire\Dashboard\Disaster\Program\DisasterProgramCreate;
use App\Livewire\Dashboard\Disaster\Program\DisasterProgramEdit;
use App\Livewire\Dashboard\Disaster\Program\DisasterProgramManagement;
use App\Livewire\Dashboard\Donation\DonationCreate;
use App\Livewire\Dashboard\Donation\DonationEdit;
use App\Livewire\Dashboard\Donation\DonationManagement;
use App\Livewire\Dashboard\News\Category\NewsCategoryCreate;
use App\Livewire\Dashboard\News\Category\NewsCategoryEdit;
use App\Livewire\Dashboard\News\Category\NewsCategoryManagement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\ReportDisaster;
use App\Livewire\DisasterPage;
use App\Livewire\HomePage;
use App\Livewire\PasswordReset;
use App\Livewire\Programs\ProgramPage;
use App\Livewire\Programs\ProgramDetailPage;
use App\Livewire\ProgramCategoryPage;
use App\Livewire\Programs\CityPrograms;
use Illuminate\Support\Facades\Artisan;

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


Route::get('/link-storage', function () {
  Artisan::call('storage:link');
  return 'success';
});

// Define a route for the landing page
Route::get('/', HomePage::class)->name('home'); // Update to use HomeController

// Other routes
Route::get('/counter', Counter::class);
Route::get('/login', Login::class)->name('login');
Route::get('/news', NewsPage::class)->name('news');
Route::get('/news/{id}', NewsDetailPage::class)->name('news.detail');
Route::get('/our-works', OurWorksPage::class);
Route::get('/our-reach', OurReachPage::class)->name('our-reach');
Route::get('/donate', DonatePage::class);
Route::get('/about-us', AboutUsPage::class);
Route::get('/program-category/{id}', ProgramCategoryPage::class);
// About Us
// Route::get('/leadership-and-organization', OurTeamPage::class);
// Route::get('/history', HistoryPage::class);
// Route::get('/strategy', StrategyPage::class);
// Route::get('/accountability', AccountabilityPage::class);
Route::get('/disaster', DisasterPage::class);
Route::get('/disaster/report', ReportDisaster::class)->name('report.disaster');
Route::get('/programs', ProgramPage::class)->name('programs');
Route::get('/programs/city/{city}', CityPrograms::class)->name('city-programs');
Route::get('/programs/{id}', ProgramDetailPage::class)->name('programs.detail');


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

    Route::group(['prefix' => 'covered-area'], function () {
      Route::get('/', CoveredAreaManagement::class)->name('dashboard.covered-area');
      Route::get('/create', CoveredAreaCreate::class)->name('dashboard.covered-area.create');
      Route::get('/{coveredArea}/edit', CoveredAreaEdit::class)->name('dashboard.covered-area.edit');
    });

    // news
    Route::group(['prefix' => 'news'], function () {
      Route::get('/', NewsManagement::class)->name('dashboard.news');
      Route::get('/create', NewsCreate::class)->name('dashboard.news.create');
      Route::get('/{news}/edit', NewsEdit::class)->name('dashboard.news.edit');

      // news category
      Route::group(['prefix' => 'category'], function () {
        Route::get('/', NewsCategoryManagement::class)->name('dashboard.news.category');
        Route::get('/create', NewsCategoryCreate::class)->name('dashboard.news.category.create');
        Route::get('/{category}/edit', NewsCategoryEdit ::class)->name('dashboard.news.category.edit');
      });
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

        Route::group(['prefix' => 'areaOfWork'], function () {
          Route::get('/', AreaOfWorkManagement::class)->name('dashboard.disaster.program.areaOfWork');
          Route::get('/create', AreaOfWorkCreate::class)->name('dashboard.disaster.program.areaOfWork.create');
          Route::get('/{areaOfWork}/edit', AreaOfWorkEdit::class)->name('dashboard.disaster.program.areaOfWork.edit');
        });
      });
    });

    Route::group(['prefix' => 'donation'], function () {
      Route::get('/', DonationManagement::class)->name('dashboard.donation');
      Route::get('/create', DonationCreate::class)->name('dashboard.donation.create');
      Route::get('/{donation}/edit', DonationEdit::class)->name('dashboard.donation.edit');
    });
    Route::get('/password/reset', PasswordReset::class)->name('password.reset');
  });

Route::post('/push', [PushSubscriptionController::class, 'store'])
  ->middleware('auth')
  ->name('push');


// Route::prefix('report')
//   ->middleware(['auth:sanctum', 'role:admin,reporter'])
//   ->group(function () {
//     Route::get('/dashboard', Reporter::class)->name('reporter.dashboard');
//     Route::get('/disaster', DisasterReportCreate::class)->name('reporter.disaster');
//   });