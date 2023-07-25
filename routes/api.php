<?php

use App\Http\Controllers\EmployeeController;
use App\Models\JobPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::middleware('auth:sanctum')->group(function () {

// Route::get('/job-positions', function (Request $request) {

//     $departmentID = $request->get('department_id', 0);

//     $positions = JobPosition::query()
//         ->where('department_id', $departmentID)
//         ->get();

//     return $positions;
// });

Route::get('/job-positions', [EmployeeController::class, 'filterJobPosition']);

// });
