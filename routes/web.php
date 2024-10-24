<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\portfolioController;


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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[HomeController::class,'Home'])->name('home');
Route::get('/admin',[BackendController::class,'Dashboard'])->name('dashboard');

// routes for profile info section
Route::get('/add/info',[BackendController::class,'addInfo'])->name('add.info');
Route::post('/insert/profile/info',[BackendController::class,'insertProfileInfo'])->name('insert.profile.info');
Route::get('/show/info',[BackendController::class,'showInfo'])->name('show.info');
Route::get('/edit/profile/info/{id}',[BackendController::class,'editProfileInfo'])->name('edit.profile.info');
Route::post('/delete/profile/info/{id}',[BackendController::class,'deleteProfileInfo'])->name('delete.profile.info');
Route::post('/update/profile/info/',[BackendController::class,'updateProfileInfo'])->name('update.profile.info');

// routes for about section
Route::get('/insert/about/',[BackendController::class,'InsertAbout'])->name('insert.about');
Route::get('/show/about/',[BackendController::class,'ShowAbout'])->name('show.about');
Route::post('/insert/about/data',[BackendController::class,'InsertAboutData'])->name('insert.about.data');
Route::get('/edit-about-info/{id}', [BackendController::class, 'editAboutInfo'])->name('edit.about.info');
Route::post('/update-about-info/{id}', [BackendController::class, 'updateAboutInfo'])->name('update.about.info');
Route::get('/delete-about-info/{id}', [BackendController::class, 'deleteAboutInfo'])->name('delete.about.info');


// routes for overview section

Route::get('/insert/overview/',[BackendController::class,'InsertOverview'])->name('insert.overview');
Route::get('/show/overview/',[BackendController::class,'ShowOverview'])->name('show.overview');
Route::post('/insert/overview/data',[BackendController::class,'InsertOverviewData'])->name('insert.overview.data');
Route::get('/edit/overview/info/{id}', [BackendController::class, 'editOverviewInfo'])->name('edit.overview.info');
Route::post('/update/overview/info/{id}', [BackendController::class, 'updateOverviewInfo'])->name('update.overview.info');
Route::get('/delete-overview-info/{id}', [BackendController::class, 'deleteOverviewInfo'])->name('delete.overview.info');

// routes for skill add
Route::get('/add/skill',[BackendController::class,'addSkill'])->name('add.skill');
Route::get('/show/skill',[BackendController::class,'showSkill'])->name('show.skill');
Route::post('/insert/skill',[BackendController::class,'insertSkill'])->name('insert.skill');
Route::get('/edit/skill/{id}',[BackendController::class,'editSkill'])->name('edit.skill');
Route::post('/update/skill/{id}',[BackendController::class,'updateSkill'])->name('update.skill');
Route::get('/delete/skill/{id}',[BackendController::class,'deleteSkill'])->name('delete.skill');


// portfolio routes starts here
Route::get('/add/product/',[PortfolioController::class,'addProduct'])->name('add.product');

Route::get('/add/branding/',[PortfolioController::class,'addBranding'])->name('Add.branding');
Route::get('/add/book/',[PortfolioController::class,'addBook'])->name('Add.book');
Route::post('/insert/product/',[PortfolioController::class,'insertProduct'])->name('insert.product');
Route::get('/edit/product/{id}',[PortfolioController::class,'editProduct'])->name('edit.product');
Route::post('/update/product/{id}',[PortfolioController::class,'updateProduct'])->name('update.product');
Route::get('/delete/product/{id}',[PortfolioController::class,'deleteProduct'])->name('delete.product');