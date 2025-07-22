<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentApiController;

Route::get('/student-data/{id}', [StudentApiController::class, 'getStudentData']);
