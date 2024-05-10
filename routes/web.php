<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;

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
Auth::routes();

Route::get('/', function () {
    // redirect to home page
    return redirect()->route('home');
    // return view('welcome');
});

// -------------------------------------------------------------------------------about
Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');
// -------------------------------------------------------------------------------about
Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contact'])->name('contact');
// -------------------------------------------------------------------------------home
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// -------------------------------------------------------------------------------show.single
Route::get('/job/{id}', [App\Http\Controllers\HomeController::class, 'show'])->name('jobs.single');
// -------------------------------------------------------------------------------save.job
Route::post('/job/save', [App\Http\Controllers\HomeController::class, 'saveJob'])->name('jobs.save')->middleware('auth');
// -------------------------------------------------------------------------------unsave.job
Route::post('/job/unsave', [App\Http\Controllers\HomeController::class, 'unsaveJob'])->name('jobs.unsave')->middleware('auth');
// -------------------------------------------------------------------------------apply.job
Route::post('/job/apply', [App\Http\Controllers\HomeController::class, 'applyJob'])->name('jobs.apply')->middleware('auth');
// -------------------------------------------------------------------------------single.category
Route::get('/categories/single/{name}', [App\Http\Controllers\HomeController::class, 'singleCategory'])->name('categories.single');
// -------------------------------------------------------------------------------profile
Route::get('/user/profile', [App\Http\Controllers\HomeController::class, 'singleUser'])->name('profile')->middleware('auth');
// -------------------------------------------------------------------------------applications
Route::get('/user/applications', [App\Http\Controllers\HomeController::class, 'applications'])->name('applications')->middleware('auth');
// -------------------------------------------------------------------------------saves
Route::get('/user/saves', [App\Http\Controllers\HomeController::class, 'saves'])->name('saves')->middleware('auth');
// -------------------------------------------------------------------------------edit.profile
Route::get('/user/profile/edit', [App\Http\Controllers\HomeController::class, 'editProfile'])->name('profile.edit')->middleware('auth');
// -------------------------------------------------------------------------------update.profile
Route::post('/user/profile/update', [App\Http\Controllers\HomeController::class, 'updateProfile'])->name('profile.update')->middleware('auth');
// ---------------------------------------------------------------------------------edit.cv
Route::get('/user/editCv', [App\Http\Controllers\HomeController::class, 'editCv'])->name('cv.edit')->middleware('auth');
// ---------------------------------------------------------------------------------update.cv
Route::post('/user/updateCv', [App\Http\Controllers\HomeController::class, 'updateCv'])->name('cv.update')->middleware('auth');


// ---------------------------------------------------------------------------------admin
// ->middleware('auth:admin')
// admin auth
Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'showLogin'])->name('admin.showLogin')->middleware('adminguest');
Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'login'])->name('admin.login')->middleware('adminguest');
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index')->middleware('adminguard');
Route::post('/admin/logout', [App\Http\Controllers\AdminController::class, 'logout'])->name('admin.logout')->middleware('adminguard');

// admin pages
Route::get('/admin/all-admin', [App\Http\Controllers\AdminController::class, 'showAdmin'])->name('view.admins')->middleware('adminguard');
Route::get('/admin/create-admins', [App\Http\Controllers\AdminController::class, 'createAdmins'])->name('create.admins')->middleware('adminguard');
Route::post('/admin/store-admins', [App\Http\Controllers\AdminController::class, 'storeAdmins'])->name('store.admins')->middleware('adminguard');

Route::get('/admin/display-categories', [App\Http\Controllers\AdminController::class, 'displayCategories'])->name('admin.displayCategories')->middleware('adminguard');
// update category
Route::get('/admin/create-categories', [App\Http\Controllers\AdminController::class, 'createCategories'])->name('admin.createCategories')->middleware('adminguard');
Route::post('/admin/store-categories', [App\Http\Controllers\AdminController::class, 'storeCategories'])->name('admin.storeCategories')->middleware('adminguard');
// edit category
Route::get('/admin/edit-categories/{id}', [App\Http\Controllers\AdminController::class, 'editCategories'])->name('admin.editCategories')->middleware('adminguard');
Route::post('/admin/update-categories/{id}', [App\Http\Controllers\AdminController::class, 'updateCategories'])->name('admin.updateCategories')->middleware('adminguard');
// delete category
Route::get('/admin/delete-categories/{id}', [App\Http\Controllers\AdminController::class, 'deleteCategories'])->name('admin.deleteCategories')->middleware('adminguard');

// display jobs
Route::get('/admin/display-job', [App\Http\Controllers\AdminController::class, 'displayJobs'])->name('admin.displayJobs')->middleware('adminguard');
// delete
Route::get('/admin/delete-job/{id}', [App\Http\Controllers\AdminController::class, 'deleteJobs'])->name('admin.deleteJobs')->middleware('adminguard');
// create jobs
Route::get('/admin/create-job', [App\Http\Controllers\AdminController::class, 'createJobs'])->name('admin.createJob')->middleware('adminguard');
// store jobs
Route::post('/admin/store-job', [App\Http\Controllers\AdminController::class, 'storeJobs'])->name('admin.storeJobs')->middleware('adminguard');
// display applications
Route::get('/admin/display-applications', [AdminController::class, 'displayApplications'])->name('admin.displayApplications')->middleware('adminguard');
