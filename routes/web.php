<?php

use App\Http\Controllers\AuthManager;
use App\Http\Controllers\PatientController;
use Illuminate\Support\Facades\Route;

Route::get('/', [AuthManager::class,'login'])->name('login');
Route::post('/',[AuthManager::class,'loginPost'])->name('login.post');

Route::get('/sign-up', [AuthManager::class,'signup'])->name('signup');
Route::post('/sign-up',[AuthManager::class,'signupPost'])->name('signup.post');

Route::get('/dashboard',[PatientController::class, 'dashboard'])->name('dashboard');
Route::get('/dashboard/{department}',[PatientController::class, 'department']);
Route::post('/dashboard/addPatient',[PatientController::class,'addPatient'])->name('addPatient');
Route::put('/dashboard/{department}/up',[PatientController::class,'reorderQueueUp'])->name('reorderQueueUp');
Route::put('/dashboard/{department}/down',[PatientController::class,'reorderQueueDown'])->name('reorderQueueDown');
Route::put('/dashboard/served',[PatientController::class,'served'])->name('served');
Route::put('/dashboard/not_served',[PatientController::class,'not_served'])->name('not_served');


Route::get('/logout',[AuthManager::class,'logout'])->name('logout');
