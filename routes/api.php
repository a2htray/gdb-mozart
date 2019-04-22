<?php

// route helper collection
if (!function_exists('apiMozartRoute')) {
    /**
     * @param Closure $closure
     * @param bool $withUser
     * @return \Illuminate\Routing\Route
     */
    function apiMozartRoute(bool $withUser=true) {
        if ($withUser) {
            return Route::prefix('api/u/{username}');
        } else {
            return Route::prefix('api');
        }
    }
}

if (!function_exists('uApiMozartRoute')) {
    function uApiMozartRoute($name, $options=[]) {
        // Todo this is the mock data
        return route($name, array_merge(['username' => 'a2htray'], $options));
    }
}

apiMozartRoute($withUser=false)->namespace('A2htray\GDBMozart\Controllers\Api')
    ->group(function () {

        Route::post('login', 'LoginApiController')
            ->middleware('params:login')->name('api_login');

        Route::post('submitOboFile', 'SubmitOboFileApiController')
            ->middleware(['params:submitOboFile', 'apiAuth'])->name('api_submitOboFile');

        Route::post('analysis', 'AnalysisAddApiController')
            ->middleware(['params:analysisAdd', 'apiAuth'])->name('api_analysisAdd');
        Route::post('organism', 'OrganismAddApiController')
            ->middleware(['params:organismAdd', 'apiAuth'])->name('api_organismAdd');

        // resource
        Route::get('analysis', function () {
            return new \A2htray\GDBMozart\Resources\Analysis(\A2htray\GDBMozart\Models\Analysis::all());
        })->middleware(['apiAuth'])->name('api_analysisGet');

        Route::get('organisms', function () {
            return new \A2htray\GDBMozart\Resources\Organism(\A2htray\GDBMozart\Models\Organism::all());
        })->middleware(['apiAuth'])->name('api_organismGet');

        Route::get('features', function () {
            return new \A2htray\GDBMozart\Resources\Feature(\A2htray\GDBMozart\Models\Feature::all());
        })->middleware(['apiAuth'])->name('api_featureGet');
    });
