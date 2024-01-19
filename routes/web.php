<?php

use App\Http\Controllers\absensiController;
use App\Http\Controllers\absensiSettingsController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\dashboardUser;
use App\Http\Controllers\FaceRecognitionController;
use App\Http\Controllers\qrController;
use App\Http\Controllers\pagesController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\scanController;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\testController;
use App\Http\Controllers\userController;
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

// Route::get('/', function () {
//     return view('Auth.login');
// });
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/masuk', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/qrCode', [qrController::class, 'index']);
Route::get('/absen', [qrController::class, 'absen']);
// Route::get('/sekolah', [pagesController::class, 'sekolah']);
Route::get('/absen', [qrController::class, 'absen'])->name('absen');

Route::group(['middleware' => ['auth', 'hakakses:admin']], function () {
    Route::get('/', [dashboardUser::class, 'index']);
    Route::get('/dashboard', [pagesController::class, 'dashboard']);
    Route::get('/siswa', [pagesController::class, 'siswa']);
    Route::resource('/students', StudentsController::class);
    Route::get('/sekolah', [pagesController::class, 'sekolah']);
    Route::resource('/schools', SchoolsController::class);
    Route::get('/setting-jam', [pagesController::class, 'settingJam']);
    Route::resource('/setting_absensi', absensiSettingsController::class);
    Route::get('/get-jlm-siswa', [absensiController::class, 'get_jml_siswa']);
    Route::get('/profile', [ProfilController::class, 'index']);
    Route::resource('/users', userController::class);
    Route::get('/pengguna', [ProfilController::class, 'pengguna']);
    Route::get('/cek_users/{id}', [ProfilController::class, 'cek_users']);
    Route::get('/get_data_absensi', [absensiController::class, 'get_data_absensi']);
    Route::get('/get_data_absensi_persekolah', [absensiController::class, 'get_data_absensi_persekolah']);
    Route::get('/profil-admin', [testController::class, 'profilAdmin']);
    Route::get('/per-siswa', [pagesController::class, 'perSiswa']);
    Route::get('/per-sekolah', [pagesController::class, 'perSekolah']);
    Route::get('/qrcode', [pagesController::class, 'qrCode']);
    Route::get('/cek_scan', [scanController::class, 'cekscan']);
    Route::get('/FaceScan/{id}/{kode}', [FaceRecognitionController::class, 'index']);
    Route::post('/save-image', [FaceRecognitionController::class, 'saveImage']);
});
Route::group(['middleware' => ['auth', 'hakakses:student']], function () {
    Route::get('/profil-user', [testController::class, 'profilUser']);
    Route::get('/cameraScan', [scanController::class, 'scan']);
    Route::get('/addscan/{kode}', [scanController::class, 'addscan']);
    Route::get('/cek_photo', [scanController::class, 'cek_photo']);
});