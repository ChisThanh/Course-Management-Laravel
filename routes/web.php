<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\CheckLogninMiddleware;
use App\Http\Middleware\CheckSupperAdminMiddleware;
use App\Models\Course;
use Illuminate\Support\Facades\Route;


Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin'])->name('process_login');

Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'ProcessRegister'])->name('process_register');




Route::group([
    // 'middleware' => 'admin', C1
    'middleware' => CheckLogninMiddleware::class,
], function () {
    Route::resource('courses', CourseController::class)->except([
        'show',
        'destroy',
    ]);

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('courses/api', [CourseController::class, 'api'])->name('courses.api');


    Route::resource('students', StudentController::class)->except([
        'show',
        'destroy',
    ]);
    Route::get('students/api', [StudentController::class, 'api'])->name('students.api');


    Route::group([
        // 'middleware' => 'admin', C1
        'middleware' => CheckSupperAdminMiddleware::class,
    ], function () {
        Route::delete('courses/{courses}', [CourseController::class, 'destroy'])
            ->name('courses.destroy');

        Route::delete('students/{courses}', [StudentController::class, 'destroy'])
            ->name('students.destroy');
    });
});



// Route::get('test', function () {
//     return view('layout.master');
// });



// Route::get('/courses', [CourseController::class, 'index'])->name('course.index');
// Route::get('/courses/create', [CourseController::class, 'create'])->name('course.create');
// Route::post('/courses/create', [CourseController::class, 'store'])->name('course.store');
// Route::post('/courses/destroy/{course}', [CourseController::class, 'destroy'])->name('course.destroy');
// Route::get('/courses/edit/{course}', [CourseController::class, 'edit'])->name('course.edit');
// Route::put('/courses/edit/{course}', [CourseController::class, 'update'])->name('course.update');

// Route::prefix('courses')->group(function () {
//     Route::get('/', [CourseController::class, 'index'])->name('course.index');
//     // Route::get('/create', [CourseController::class, 'create'])->name('course.create');
//     // Route::post('/create', [CourseController::class, 'store'])->name('course.store');
//     // Route::post('/destroy/{course}', [CourseController::class, 'destroy'])->name('course.destroy');
// });
