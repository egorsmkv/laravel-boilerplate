<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/start-test-job', [HomeController::class, 'startTestJob']);
Route::get('/start-test-mail', [HomeController::class, 'startTestEmail']);
Route::get('/start-test-python-zmq', [HomeController::class, 'startTestPythonZMQ']);
