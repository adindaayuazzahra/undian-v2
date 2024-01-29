<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('index');
Route::get('/register', [HomeController::class, 'register'])->name('register');
Route::post('/register/do', [HomeController::class, 'registerDo'])->name('register.do');
Route::get('/cetak', [HomeController::class, 'cetak'])->name('cetak');
Route::post('/qrcode', [HomeController::class, 'qrcode'])->name('qrcode');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/login/do', [HomeController::class, 'loginDo'])->name('login.do');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [HomeController::class, 'adminHome'])->name('admin.home');
    Route::get('/admin/scann', [HomeController::class, 'scann'])->name('scann');
    Route::post('/admin/redeem', [HomeController::class, 'redeem'])->name('redeem');
    Route::get('/admin/list-peserta', [HomeController::class, 'listPeserta'])->name('admin.list_peserta');
    Route::get('/admin/list-hadiah', [HomeController::class, 'listHadiah'])->name('admin.list_hadiah');
    Route::post('/admin/hadiah/add/do', [HomeController::class, 'hadiahAddDo'])->name('hadiah.add.do');
    Route::post('/admin/hadiah/edit/do/{id}', [HomeController::class, 'hadiahEditDo'])->name('hadiah.edit.do');
    Route::get('/admin/hadiah/delete/do/{id}', [HomeController::class, 'hadiahDeleteDo'])->name('hadiah.delete.do');
    Route::get('/generate-gift/{id}', [HomeController::class, 'generateGift'])->name('admin.generate.gift');
    Route::post('/generate-gift/generate-pemenang', [HomeController::class, 'generatePemenang'])->name('admin.generate.pemenang');
    Route::post('/generate-gift/generate-pemenang/lock', [HomeController::class, 'lockPemenang'])->name('admin.lock.pemenang');
    Route::get('/button-gen', [HomeController::class, 'buttonGen'])->name('admin.button.generate');
    Route::get('/display/view', [HomeController::class, 'displayView'])->name('admin.display.view');
    Route::get('/ambil/hadiah', [HomeController::class, 'ambilHadiah'])->name('admin.ambil.hadiah');
    Route::get('/display/{id}', [HomeController::class, 'display'])->name('admin.display');
    Route::get('/ambil/display', [HomeController::class, 'ambilDisplay'])->name('admin.ambil.display');
    Route::get('/logout/do', [HomeController::class, 'logoutDo'])->name('logout.do');
});
