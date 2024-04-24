<?php

use Illuminate\Support\Facades\Route;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:web']
    ], function () {


        Route::get('dashboard', function () {
            return view('dashbord.web.home');
        })->name('dashboard');


        Route::group(['prefix' => 'Tasks', 'as' => 'Tasks.'], function () {
            Route::controller(\App\Http\Controllers\Web\Task_C::class)->group(function () {
                Route::get('/tasks_data', 'tasks_data')->name('tasks_data');
                Route::get('/get_ajax_tasks', 'get_ajax_tasks')->name('get_ajax_tasks');
                Route::get('/show_sub_tasks/{id}', 'show_sub_tasks')->name('show_sub_tasks');
                Route::get('/update_status/{id}/{status}/{main_task_id}', 'update_status')->name('update_status');
                Route::get('/notify', 'sub_tasks_time_notifications')->name('notify');

            });

            Route::controller(\App\Http\Controllers\Admin\TasksNotification_C::class)->group(function () {
                Route::get('/notify', 'sub_tasks_time_notifications')->name('notify');
            });

        });


});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    require __DIR__ . '/auth_user.php';
});
