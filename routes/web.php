<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DriverController;
use App\Http\Controllers\ConstructorController;
use App\Http\Controllers\StandingController;

// Drivers
Route::get('/drivers', [DriverController::class, 'index']);
Route::get('/drivers/{id}', [DriverController::class, 'show']);

// Constructors
Route::get('/constructors', [ConstructorController::class, 'index']);
Route::get('/constructors/{id}', [ConstructorController::class, 'show']);

// Standings
Route::get('/standings/constructor/{year}', [StandingController::class, 'constructorStandings']);
Route::get('/standings/driver/{year}', [StandingController::class, 'driverStandings']);