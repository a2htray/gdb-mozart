<?php

// route helper collection
if (!function_exists('mozartRoute')) {
    /**
     * @param $closure
     * @return \Illuminate\Routing\Route
     */
    function mozartRoute(Closure $closure) {
        return Route::prefix('/u/{username}')->group($closure);
    }
}

if (!function_exists('uMozartRoute')) {
    function uMozartRoute($name, $options=[]) {
        // Todo this is the mock data
        return route($name, array_merge(['username' => 'a2htray'], $options));
    }
}

Route::get('/login', 'A2htray\GDBMozart\Controllers\UserController@login')->name('login');

mozartRoute(function () {
    Route::get('/logout', function ($u) {
        echo 'logout';
    })->name('logout');
    Route::get('/notification/{id}', function ($u, $id) {
        echo $id;
    })->name('notification');
    Route::get('/notifications', function ($u) {
        echo $u;
    })->name('notifications');
});
