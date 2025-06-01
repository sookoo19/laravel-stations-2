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

use App\Http\Controllers\PracticeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\SchedulesController;


// Route::get('URL', [Controllerの名前::class, 'Controller内のfunction名']);
Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);
Route::get('/getPractice', [PracticeController::class, 'getPractice']);
Route::get('/movies', [MovieController::class, 'getMovie']);
Route::get('/admin/movies',[MovieController::class,'getAdminMovie']);
Route::get('/admin/movies/create',[MovieController::class,'getAdminMovieStore']);
Route::post('/admin/movies/store', [MovieController::class, 'storeAdminMovie']);
Route::get('/admin/movies/{id}/edit/',[MovieController::class,'editAdminMovieStore']);
Route::patch('/admin/movies/{id}/update',[MovieController::class,'updateAdminMovieStore']);
Route::delete('/admin/movies/{id}/destroy',[MovieController::class,'destroyAdminMovieStore']);
Route::get('/movies',[MovieController::class,'searchAdminMovieStore']);
Route::get('/sheets',[MovieController::class,'sheetsAdminMovie']);
Route::get('/movies/{id}',[MovieController::class,'schedulesMovie']);

Route::get('/admin/schedules',[SchedulesController::class,'adminAllschedulesMovie']);
Route::get('/admin/schedules/{id}',[SchedulesController::class,'adminScheduleDetail']);
Route::get('/admin/movies/{id}', [SchedulesController::class, 'showMovie']);
Route::get('/admin/movies/{id}/schedules/create',[SchedulesController::class,'crateAdminSchedulesMovie']);
Route::get('/admin/schedules/{scheduleId}/edit',[SchedulesController::class,'editAdminSchedulesMovie']);
Route::patch('/admin/schedules/{id}/update',[SchedulesController::class,'updateAdminSchedulesMovie']);
Route::delete('/schedules/{id}/destroy',[SchedulesController::class,'destroySchedulesMovie']);
Route::post('/admin/movies/{id}/schedules/store', [SchedulesController::class, 'storeAdminSchedulesMovie']);
Route::delete('/admin/schedules/{id}/destroy',[SchedulesController::class,'destroyAdminSchedulesMovie']);
