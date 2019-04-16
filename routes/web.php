<?php

// route helper collection
if (!function_exists('mozartRoute')) {
    /**
     * @param $closure
     * @return \Illuminate\Routing\Route
     */
    function mozartRoute() {
        return Route::prefix('/u/{username}');
    }
}

if (!function_exists('uMozartRoute')) {
    function uMozartRoute($name, $options=[]) {
        // Todo this is the mock data
        return route($name, array_merge(['username' => 'a2htray'], $options));
    }
}

Route::get('/login', 'A2htray\GDBMozart\Controllers\UserController@login')->name('login');

mozartRoute()->namespace('A2htray\GDBMozart\Controllers')->group(function () {
    Route::get('/logout', 'UserController@logout')->name('logout');

    Route::get('/notification/{id}', function ($u, $id) {
        echo $id;
    })->name('notification');
    Route::get('/notifications', function ($u) {
        echo $u;
    })->name('notifications');

    Route::get('/dashboard', 'DashboardController@show')->middleware('webAuth')->name('dashboard');
    Route::get('/dataUpload', 'DataController@upload')->middleware('webAuth')->name('data_upload');
});
