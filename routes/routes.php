<?php

Route::get('/u/{username}/dashboard', function () {
    return view(PACKAGE_NAME . '::dashboard');
});

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
