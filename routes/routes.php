<?php

Route::get('/u/{username}/dashboard', function () {
    return view(PACKAGE_NAME . '::dashboard');
});