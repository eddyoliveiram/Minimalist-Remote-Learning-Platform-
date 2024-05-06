<?php

use App\Http\Controllers\AlternativesController;
use App\Http\Controllers\ContentsController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\CourseStructure;
use App\Http\Controllers\ModulesController;
use App\Http\Controllers\ProfessorsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\StudentViewController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('courses.create');
    }

    return view('auth.login');
});


Route::middleware('auth')->group(function () {
    Route::get('/index', function () {
        return view('index');
    })->name('index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware(['auth', 'isAdminOrProfessor'])->group(function () {
        Route::resource('courses', CoursesController::class);
        Route::resource('modules', ModulesController::class);
        Route::resource('contents', ContentsController::class);
        Route::resource('questions', QuestionsController::class);
        Route::resource('alternatives', AlternativesController::class);
    });

    Route::middleware(['isAdmin'])->group(function () {
        Route::resource('students', StudentsController::class);
        Route::resource('professors', ProfessorsController::class);
    });

    Route::middleware(['isStudent'])->group(function () {
        Route::get('student/courses-list', [StudentViewController::class, 'index'])->name('student.courses-list');
        Route::get('student/course-show', [StudentViewController::class, 'show'])->name('student.course-show');
        Route::post('courses/{course}/enroll',
            [StudentViewController::class, 'enrollStudent'])->name('courses.enroll_student');
        Route::post('courses/{course}/disenroll',
            [StudentViewController::class, 'disenrollStudent'])->name('courses.disenroll_student');
        Route::get('student/modules/{module}/show-contents',
            [StudentViewController::class, 'showContents'])->name('student.modules.show-contents');
    });


    Route::get('/api/courses/{status?}', [CoursesController::class, 'apiCourses'])->name('api.courses');
});

require __DIR__.'/auth.php';
