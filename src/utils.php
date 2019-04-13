<?php

use A2htray\GDBMozart\Package;

if (!function_exists('package')) {
    function package($packageName) {
        return new Package($packageName);
    }
}

// route helper collection
if (!function_exists('mozartRoute')) {
    function mozartRoute() {
        return Route::prefix('/u/{username}');
    }
}