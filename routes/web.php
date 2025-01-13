<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DriverController;
use App\Http\Controllers\ConstructorController;
use App\Http\Controllers\StandingController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CountryStatisticsController;


// Drivers
Route::get('/drivers', [DriverController::class, 'index']);
Route::get('/drivers/{id}', [DriverController::class, 'show']);

// Constructors
Route::get('/constructors', [ConstructorController::class, 'index']);
Route::get('/constructors/{id}', [ConstructorController::class, 'show']);

// Standings
Route::get('/standings/constructor/{year}', [StandingController::class, 'constructorStandings']);
Route::get('/standings/driver/{year}', [StandingController::class, 'driverStandings']);

//country info
Route::get('/country/{id}', [CountryController::class, 'show']);
Route::get('/country', [CountryController::class, 'index']);



// Combined driver count and stats grouped by country
Route::get('/country-stats', [CountryStatisticsController::class, 'combinedDriverStatistics']);
Route::get('/country-stats/{id}', [CountryStatisticsController::class, 'countryStatsById']);
