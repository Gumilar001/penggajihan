<?php

use App\Http\Controllers\{
    DashboardController,
    PenggajihanTniController

};
use App\Http\Controllers\CurrencyController;

use App\Http\Controllers\WebhookControllers;
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

// Auth::routes();
Route::group(['middleware' => ['guest']], function () {
    Route::get('login', function () { return view('auth.login'); })->name('login');
    Route::get('forgot-password', function () { return view('auth.forgot-password'); })->name('forgot-password');
    Route::get('new-password/{token}', function () { return view('auth.new-password'); })->name('new-password');
});


Route::get('/penggajihan-tni/cetak/{id}', [PenggajihanTniController::class, 'cetak'])->name('penggajihanTni.cetak');
Route::get('/penggajihan-pns/cetak/{id}', [PenggajihanTniController::class, 'cetakPns'])->name('penggajihanTni.cetakPns');

Route::group(['middleware' => ['auth']], function () {
    Route::get(
        'logout',
        function () {
            \Auth::logout();
            return redirect('login');
        }
    )->name('logout');
    Route::get('/', [DashboardController::class, 'index'])->name('home');


    //penggajian route
    Route::get(
        '/penggajihan/tni',
        function () {
            return view('pages.penggajihan.tni.index');
        }
    );
    Route::get(
        '/penggajihan/pns',
        function () {
            return view('pages.penggajihan.pns.index');
        }
    );
    Route::get(
        '/laporan/pns',
        function () {
            return view('pages.Laporan.pns');
        }
    );
    Route::get(
        '/laporan/tni',
        function () {
            return view('pages.Laporan.tni');
        }
    );
    Route::get(
        '/personel/pns',
        function () {
            return view('pages.personel.pns.index');
        }
    );
    Route::get(
        '/personel/pangkat',
        function () {
            return view('pages.personel.pangkat.index');
        }
    );
    Route::get(
        '/personel/tni',
        function () {
            return view('pages.personel.tni.index');
        }
    );
    //end Penggajihan
    Route::get(
        '/user/account',
        function () {
            return view('pages.user.account.index');
        }
    );
    Route::get(
        '/user/role',
        function () {
            return view('pages.user.role.index');
        }
    );
    Route::get(
        '/user/role/add',
        function () {
            return view('pages.user.role.add');
        }
    );
    Route::get(
        '/user/role/edit/{id}',
        function () {
            return view('pages.user.role.edit');
        }
    );

});