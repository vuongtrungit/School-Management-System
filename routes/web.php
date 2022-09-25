<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    return view('welcome');
});
Route::namespace('App\Http\Livewire')->group(function () {

    //? Routes that can be accessed only when logging in
    Route::middleware(['auth', 'verified'])->group(function () {

        //? Route for dashboard page
        Route::prefix('/dashboard')->namespace('Dashboard')->name('dashboard.')->group(function () {

            // livewire crud-generator Tall
            Route::get('/tall-crud-generator', TallCrud::class)->name('tall-crud-generator')->middleware('role:Admin');

            // for  School
            Route::prefix('/school')->namespace('School')->name('schools.')->group(function () {
                Route::get('/', Index::class)->name('index');
            });

            //super admin must have school id set
            Route::middleware(['App\Http\Middleware\EnsureSuperAdminHasSchoolId'])->group(function () {
                //? Displays data statistics and to set up page about
                Route::get('/', Index::class)->name('index');

                // for  School
                Route::prefix('/school')->namespace('School')->name('schools.')->group(function () {
                    //manage school settings
                    Route::get('/setting-school', SettingSchool::class)->name('settings-school');
                });


                // for  Student
                Route::prefix('/student')->namespace('Student')->name('students.')->group(function () {

                    Route::get('/', Index::class)->name('index');
                });

                // for  Parent
                Route::prefix('/parent')->namespace('Parent')->name('parents.')->group(function () {

                    Route::get('/', Index::class)->name('index');
                });

                // for  Teacher
                Route::prefix('/teacher')->namespace('Teacher')->name('teachers.')->group(function () {

                    Route::get('/', Index::class)->name('index');
                });
                // for  Classes
                Route::prefix('/class')->namespace('Classes')->name('classes.')->group(function () {

                    Route::get('/', Index::class)->name('index');
                });
            });
        });
    });
});



require __DIR__ . '/auth.php';
