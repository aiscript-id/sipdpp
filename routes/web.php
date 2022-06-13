<?php

use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\SurveyController as AdminSurveyController;
use App\Http\Controllers\Admin\SurveyFieldController as AdminSurveyFieldController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WilayahController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('provinces', [WilayahController::class, 'provinces'])->name('provinces');
Route::get('cities', [WilayahController::class, 'cities'])->name('cities');
Route::get('districts', [WilayahController::class, 'districts'])->name('districts');
Route::get('villages', [WilayahController::class, 'villages'])->name('villages');

Auth::routes();
Route::middleware('role:superadmin|admin')->prefix('admin')->group(function() {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin');
    Route::resource('users', AdminUserController::class);

    Route::resource('events', AdminEventController::class);
    Route::get('events/{event}/survey', [AdminEventController::class, 'survey'])->name('events.surveys');
    Route::post('events/survey/store', [AdminEventController::class, 'surveyStore'])->name('events.surveys.store');
    Route::delete('events/survey/destroy', [AdminEventController::class, 'surveyDestroy'])->name('events.surveys.destroy');

    Route::resource('surveys', AdminSurveyController::class);
    // route group survey
    Route::get('surveys/{survey}/fields', [AdminSurveyController::class, 'fields'])->name('surveys.fields');

    // publish
    Route::put('publish', [AdminController::class, 'publish'])->name('admin.publish');

    Route::resource('fields', AdminSurveyFieldController::class)->only(['store', 'update', 'destroy']);
});

Route::middleware('role:user')->prefix('user')->group(function() {
    Route::get('/dashboard', [UserController::class, 'index'])->name('user');

    // lengkapi profile
    Route::get('/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile/avatar', [UserController::class, 'updateAvatar'])->name('profile.avatar');
    Route::post('/profile/password', [UserController::class, 'updatePassword'])->name('profile.password');

    // event user
    Route::get('/events', [EventController::class, 'index'])->name('user.events');
    Route::get('/events/{slug}/join', [EventController::class, 'join'])->name('user.events.join');
    Route::get('/events/{slug}/show', [EventController::class, 'show'])->name('user.events.show');

    // survey
    Route::get('/events/{slug}/surveys/{slug_survey}', [SurveyController::class, 'joinSurvey'])->name('user.surveys.join');
    Route::put('events/{survey_user}/update', [SurveyController::class, 'update'])->name('user.surveys.update');
});


Route::get('/home', [HomeController::class, 'index'])->name('home');


