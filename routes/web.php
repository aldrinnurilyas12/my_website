<?php

use App\Http\Controllers\ProfileController;
use aPP\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    Route::apiResource('dashboard_admin', App\Http\Controllers\DashboardMain::class);

    Route::apiResource('dailyposts', App\Http\Controllers\DailyPostController::class);
    Route::get('/postcreate', [App\Http\Controllers\DailyPostController::class, 'create'])->name('dailypost_create');
    Route::delete('deleteposts/{id}', [App\Http\Controllers\DailyPostController::class, 'destroy'])->name('deleteposts');

    Route::apiResource('projects', App\Http\Controllers\ProjectsController::class);
    Route::put('projects_update/{id}', [App\Http\Controllers\ProjectsController::class, 'update'])->name('projects_update');
    Route::delete('projects_delete/{id}', [App\Http\Controllers\ProjectsController::class, 'destroy'])->name('projects_delete');

    Route::apiResource('workingexperiences', App\Http\Controllers\WorkingExperience::class);
    Route::put('work_update/{id}', [App\Http\Controllers\WorkingExperience::class, 'update'])->name('work_update');
    Route::delete('work_delete/{id}', [App\Http\Controllers\WorkingExperience::class, 'destroy'])->name('work_delete');


    Route::apiResource('profilepictures', App\Http\Controllers\ProfilePictureController::class);
    Route::put('profile_update/{id}', [App\Http\Controllers\ProfilePictureController::class, 'update'])->name('profile_update');
    Route::delete('profile_delete/{id}', [App\Http\Controllers\ProfilePictureController::class, 'destroy'])->name('profile_delete');
});

require __DIR__ . '/auth.php';



// ROUTE WEB MAIN PAGES ----------------------

// Ini langsung menjalankan HomepageController@index saat membuka /
Route::get('/', [App\Http\Controllers\HomepageController::class, 'index']);


Route::get('/aldrinnurilyas', function () {
    return view('frontend.homepage.homepage');
});

Route::get('/about', function () {
    return view('frontend.about');
});

Route::get('/work', function () {
    return view('frontend.workingexperience.working');
});

Route::get('/dailypost', function () {
    return view('frontend.dailypost.dailypost_main');
});

Route::get('/sharingbooks', function () {
    return view('frontend.sharingbooks.sharingbooks');
});

Route::apiResource('aldrinnurilyas', App\Http\Controllers\HomepageController::class);

Route::get('/myprojects', [App\Http\Controllers\ProjectsController::class, 'showproject'])->name('myprojects');
Route::get('displayproject/{project_code}', [App\Http\Controllers\ProjectsController::class, 'displayproject'])->name('displayproject');

Route::get('myworking', [App\Http\Controllers\WorkingExperience::class, 'mywork'])->name('myworking');
Route::get('/posts', [App\Http\Controllers\DailyPostController::class, 'showpost'])->name('posts');
