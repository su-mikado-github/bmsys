<?php

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

Route::get('/', \App\Http\Controllers\Pages\IndexController::class)->name('top');
Route::get('/attest', \App\Http\Controllers\Pages\AttestController::class)->name('attest');
Route::get('/mypage', \App\Http\Controllers\Pages\MypageController::class)->name('mypage');
Route::get('/members', \App\Http\Controllers\Pages\MembersController::class)->name('members');
Route::get('/roles', \App\Http\Controllers\Pages\RolesController::class)->name('roles');
Route::get('/permission-setting', \App\Http\Controllers\Pages\PermissionSettingController::class)->name('permission-setting');
