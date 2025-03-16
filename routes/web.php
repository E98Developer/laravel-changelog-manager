<?php
use E98Developer\LaravelChangelogManagerPackage\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;
Route::resource('test', TestController::class);
