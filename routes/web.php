<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ChiController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ThuController;
use App\Http\Controllers\DongController;
use App\Http\Controllers\KChiController;

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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/account/logout', [HomeController::class, 'logout'])->name('account.logout');
Route::get('/', [HomeController::class, 'index']);
Route::get('/family-tree', [HomeController::class, 'index'])->name('admin.tree');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin/baocaothuchi', [HomeController::class, 'thuchi'])->name('admin.tcreport.index');
Route::post('/admin/baocaothuchi', [HomeController::class, 'generateReport'])->name('admin.tcreport.generate');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/person/create', [AdminController::class, 'create'])->name('admin.person.create');
    Route::post('/admin/person/create', [AdminController::class, 'store'])->name('admin.person.store');
    Route::get('/admin/person/manage', [AdminController::class, 'manage'])->name('admin.person.manage');
    Route::delete('/admin/person/delete/{id}', [AdminController::class, 'delete'])->name('admin.person.delete');
    Route::get('/admin/person/edit/{person}', [AdminController::class, 'edit'])->name('admin.person.edit');
    Route::post('/admin/person/edit/{person}', [AdminController::class, 'update'])->name('admin.person.update');

    Route::get('/admin/thu/create', [ThuController::class, 'create'])->name('admin.thu.create');
    Route::post('/admin/thu/create', [ThuController::class, 'store'])->name('admin.thu.store');
    Route::get('/admin/thu/manage', [ThuController::class, 'manage'])->name('admin.thu.manage');
    Route::delete('/admin/thu/delete/{id}', [ThuController::class, 'delete'])->name('admin.thu.delete');
    Route::get('/admin/thu/edit/{thu}', [ThuController::class, 'edit'])->name('admin.thu.edit');
    Route::post('/admin/thu/edit/{thu}', [ThuController::class, 'update'])->name('admin.thu.update');

    Route::get('/admin/dong/create', [DongController::class, 'create'])->name('admin.dong.create');
    Route::post('/admin/dong/create', [DongController::class, 'store'])->name('admin.dong.store');
    Route::get('/admin/dong/manage', [DongController::class, 'manage'])->name('admin.dong.manage');
    Route::delete('/admin/dong/delete/{id}', [DongController::class, 'delete'])->name('admin.dong.delete');
    Route::get('/admin/dong/edit/{dong}', [DongController::class, 'edit'])->name('admin.dong.edit');
    Route::post('/admin/dong/edit/{dong}', [DongController::class, 'update'])->name('admin.dong.update');

    Route::get('/admin/baocaothu', [ThuController::class, 'index'])->name('admin.report.index');
    Route::post('/admin/baocaothu', [ThuController::class, 'generateReport'])->name('admin.report.generate');

    Route::get('/admin/baocaochi', [ChiController::class, 'index'])->name('admin.creport.index');
    Route::post('/admin/baocaochi', [ChiController::class, 'generateReport'])->name('admin.creport.generate');

    Route::get('/profile/{id}', [AdminController::class, 'showProfile'])->name('person.profile');
    Route::patch('/profile/{id}/update-picture', [AdminController::class, 'updatePicture'])->name('profile.update_picture');

    Route::get('/admin/chi/create', [ChiController::class, 'create'])->name('admin.chi.create');
    Route::post('/admin/chi/create', [ChiController::class, 'store'])->name('admin.chi.store');
    Route::get('/admin/chi/manage', [ChiController::class, 'manage'])->name('admin.chi.manage');
    Route::delete('/admin/chi/delete/{id}', [ChiController::class, 'delete'])->name('admin.chi.delete');
    Route::get('/admin/chi/edit/{chi}', [ChiController::class, 'edit'])->name('admin.chi.edit');
    Route::post('/admin/chi/edit/{chi}', [ChiController::class, 'update'])->name('admin.chi.update');

    Route::get('/admin/kchi/create', [KChiController::class, 'create'])->name('admin.kchi.create');
    Route::post('/admin/kchi/create', [KChiController::class, 'store'])->name('admin.kchi.store');
    Route::get('/admin/kchi/manage', [KChiController::class, 'manage'])->name('admin.kchi.manage');
    Route::delete('/admin/kchi/delete/{id}', [KChiController::class, 'delete'])->name('admin.kchi.delete');
    Route::get('/admin/kchi/edit/{kchi}', [KChiController::class, 'edit'])->name('admin.kchi.edit');
    Route::post('/admin/kchi/edit/{kchi}', [KChiController::class, 'update'])->name('admin.kchi.update');
});

require __DIR__.'/auth.php';
