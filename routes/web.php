<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\SppController;

use App\Http\Controllers\admin\PayController;

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
    return view('home');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::prefix('admin')->middleware('checkRole:admin')->group(function(){
	Route::get('/', [AdminController::class, 'index'])->name('admin.index');
	Route::prefix('spp')->group(function(){
		Route::get('/', [SppController::class, 'index'])->name('admin.spp.index');
		Route::get('/tambah', [SppController::class, 'create'])->name('admin.spp.create');
		Route::post('/tambah/store', [SppController::class, 'store'])->name('admin.spp.store');
		Route::delete('/{id_spp}/destroy', [SppController::class, 'destroy'])->name('admin.spp.destroy');
		Route::get('/{id_spp}/edit', [SppController::class, 'edit'])->name('admin.spp.edit');
		Route::put('/{id_spp}/edit/update', [SppController::class, 'update'])->name('admin.spp.update');
	});
	Route::prefix('kelas')->group(function(){
		Route::get('/', [ClassController::class, 'index'])->name('admin.class.index');
		Route::get('/tambah', [ClassController::class, 'create'])->name('admin.class.create');
		Route::post('/tambah/store', [ClassController::class, 'store'])->name('admin.class.store');
		Route::delete('/{id_class}/destroy', [ClassController::class, 'destroy'])->name('admin.class.destroy');
		Route::get('/{id_class}/edit', [ClassController::class, 'edit'])->name('admin.class.edit');
		Route::put('/{id_class}/edit/update', [ClassController::class, 'update'])->name('admin.class.update');
	});
	Route::prefix('siswa')->group(function(){
		Route::get('/', [StudentController::class, 'index'])->name('admin.student.index');
		Route::get('/tambah', [StudentController::class, 'create'])->name('admin.student.create');
		Route::post('/tambah/store', [StudentController::class, 'store'])->name('admin.student.store');
		Route::delete('/{nisn}/destroy', [StudentController::class, 'destroy'])->name('admin.student.destroy');
		Route::get('/{nisn}/edit', [StudentController::class, 'edit'])->name('admin.student.edit');
		Route::put('/{nisn}/edit/update', [StudentController::class, 'update'])->name('admin.student.update');
		Route::get('/{nisn}', [StudentController::class, 'show'])->name('admin.student.show');
	});
	Route::prefix('staff')->group(function(){
		Route::get('/', [StaffController::class, 'index'])->name('admin.staff.index');
		Route::get('/tambah', [StaffController::class, 'create'])->name('admin.staff.create');
		Route::post('/tambah/store', [StaffController::class, 'store'])->name('admin.staff.store');
		Route::delete('/{id}/destroy', [StaffController::class, 'destroy'])->name('admin.staff.destroy');
		Route::get('/{id}/edit', [StaffController::class, 'edit'])->name('admin.staff.edit');
		Route::put('/{id}/edit/update', [StaffController::class, 'update'])->name('admin.staff.update');
		Route::get('/{id}', [StaffController::class, 'show'])->name('admin.staff.show');
	});
	Route::prefix('pembayaran')->group(function(){
		Route::get('/', [PayController::class, 'index'])->name('admin.payment.index');
		Route::get('/tambah', [PayController::class, 'create'])->name('admin.payment.create');
		Route::post('/tambah/store', [PayController::class, 'store'])->name('admin.payment.store');
		Route::delete('/{id}/destroy', [PayController::class, 'destroy'])->name('admin.payment.destroy');
		Route::get('/{id}/edit', [PayController::class, 'edit'])->name('admin.payment.edit');
		Route::put('/{id}/edit/update', [PayController::class, 'update'])->name('admin.payment.update');
		Route::get('/{id}', [PayController::class, 'show'])->name('admin.payment.show');
	});
});

Route::prefix('payment')->middleware('checkRole:admin, staff')->group(function(){
	Route::get('/', [PaymentController::class, 'index'])->name('payment.index');

	Route::get('/entry', [PaymentController::class, 'insert'])->name('payment.entry');

});
