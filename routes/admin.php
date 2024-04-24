<?php

use Illuminate\Support\Facades\Route;



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:admin']
    ], function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {

        Route::get('dashboard', function () {
            $data['notifications'] = auth('admin')->user()->unreadNotifications;
            return view('dashbord.home',$data);
        })->name('dashboard');


        Route::group(['prefix' => 'Tasks', 'as' => 'Tasks.'], function () {
            Route::controller(\App\Http\Controllers\Admin\Task_C::class)->group(function () {
                Route::get('/create_task', 'create_task')->name('create_task');
                Route::post('/save_task', 'save_task')->name('save_task');
                Route::get('/tasks_data', 'tasks_data')->name('tasks_data');
                Route::get('/get_ajax_tasks', 'get_ajax_tasks')->name('get_ajax_tasks');
                Route::get('/edit_task/{id}', 'edit_task')->name('edit_task');
                Route::post('/update_task/{id}', 'update_task')->name('update_task');
                Route::get('/delete_task/{id}', 'delete_task')->name('delete_task');
                Route::get('/details/{id}', 'details')->name('details');
                Route::get('/add_row', 'add_row')->name('add_row');
                Route::get('/notify', 'sub_tasks_time_notifications')->name('notify');
                Route::get('/delete_sub_task/{sub_task_id}/{main_task_id}', 'delete_sub_task')->name('delete_sub_task');
                Route::post('/edit_sub_task/{main_task_id}', 'edit_sub_task')->name('edit_sub_task');

            });

            Route::controller(\App\Http\Controllers\Admin\TasksNotification_C::class)->group(function () {
                Route::get('/notify', 'sub_tasks_time_notifications')->name('notify');
            });

        });

    });
});
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {
    require __DIR__ . '/auth_admin.php';
});
