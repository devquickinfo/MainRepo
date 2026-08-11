<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\StudentListController;
use App\Http\Controllers\Backend\TeacherListController;
use App\Http\Controllers\Backend\TeacherController;
use App\Http\Controllers\Backend\IdCardController;
use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\StudentController;
use App\Http\Controllers\Backend\SchoolController;
use App\Http\Controllers\Backend\StudentImportController;
use App\Http\Controllers\UploadSampleController;


Route::get('/', function () {
    return view('frontend.login');
})->name('login');
Route::post('/', [LoginController::class, 'login'])->name('user.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('user.logout');
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [LoginController::class, 'dashboard'])->name('dashboard');
    Route::resource('students', StudentController::class);
    Route::get('/school/classes', [StudentController::class, 'schoolClasses'])->name('school.classes');
    Route::get('/school/classes/{classId}/sections/{sectionId}/students', [StudentController::class, 'classSectionStudents'])->name('school.class.section.students');
    Route::get('/schools/{school}/classes/{class}/students', [StudentController::class, 'classStudents'])->name('schools.classes.students');
    Route::get('/sections/{class}', [StudentController::class, 'getSections'])
    ->name('sections.byClass');

    Route::get('/school/profile', [SchoolController::class, 'profile'])->name('school.profile');
    Route::post('/school/profile', [SchoolController::class, 'updateProfile'])->name('school.profile.update');
    Route::resource('schools',SchoolController::class);

    Route::get('/student/import',
        [StudentImportController::class,'index'])
        ->name('student.import');

    Route::post('/student/import',
        [StudentImportController::class,'store'])
        ->name('student.import.store');

    Route::get('/student/sample',
        [StudentImportController::class,'downloadSample'])
        ->name('student.sample');

    Route::get('/student/dynamic-sample',
        [StudentImportController::class,'downloadDynamicSample'])
        ->name('student.dynamic.sample');
    Route::get('/id-card/create', [IdCardController::class, 'index'])
    ->name('idcard.create');
    Route::get('/idcard/search-students', [IdCardController::class, 'searchStudents']) 
    ->name('idcard.search.students');
    Route::post('/idcard/generate', [IdCardController::class, 'generate'])
    ->name('idcard.generate');
    Route::get('/student/list', [StudentListController::class, 'index'])
    ->name('student.list');
    Route::get('/teacher/list', [TeacherListController::class, 'index'])
    ->name('teacher.list');
    Route::resource('teachers', TeacherController::class);
    Route::resource('upload-samples', UploadSampleController::class);
    Route::delete('/upload-sample/all',[UploadSampleController::class, 'destroyAll'])->name('upload-sample.destroyAll');
    Route::post('/save-sample',[SchoolController::class, 'saveSample'])->name('selected-samples.store');

});
