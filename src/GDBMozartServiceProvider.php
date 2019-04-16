<?php

namespace A2htray\GDBMozart;

use A2htray\GDBMozart\Logic\Auth\Guard\XTokenGuard;
use A2htray\GDBMozart\Logic\Auth\UserProvider;
use A2htray\GDBMozart\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

define('PACKAGE_NAME', 'mozart');

require_once __DIR__ . '/utils.php';

class GDBMozartServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // configuration files
        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path(PACKAGE_NAME . '.php'),
        ], PACKAGE_NAME . '_config');

        // web assets
        $this->publishes([
            __DIR__ . '/../resources/favicon.ico' =>
                public_path('favicon.ico'),

            __DIR__ . '/../resources/logo.png' =>
                public_path('images/logo.png'),

            __DIR__ . '/../resources/default-avatar.jpg' =>
                public_path('images/default-avatar.png'),

            __DIR__ . '/../resources/dist/js/gdb-mozart.app.js' =>
                public_path('js/gdb-mozart.app.js'),

            __DIR__ . '/../resources/css/google-fonts-material-icon.css' =>
                public_path('css/google-fonts-material-icon.css'),
        ], PACKAGE_NAME . '_public');

        $this->publishes([
            __DIR__ . '/../files/obo/so.obo' =>
                public_path('files/obo/so.obo'),
            __DIR__ . '/../files/obo/go.obo' =>
                public_path('files/obo/go.obo'),
            __DIR__ . '/../files/obo/go.obo' =>
                public_path('files/obo/ro.obo'),
            __DIR__ . '/../files/obo/go.obo' =>
                public_path('files/obo/taxrank.obo'),
        ], PACKAGE_NAME . '_obo');

        // routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');

        // make the views available
        $this->loadViewsFrom(__DIR__ . '/../resources/views', PACKAGE_NAME);

        // bind
        $this->app->bind('A2htray\GDBMozart\Models\User', function () {
            return new User();
        });

        Auth::provider('XToken', function ($app, array $config) {
            return new UserProvider($app->make('A2htray\GDBMozart\Models\User'));
        });

        Auth::extend('XToken', function ($app, $name, array $config) {
            return new XTokenGuard(Auth::createUserProvider($config['provider']), $app->make('request'));
        });
    }
}
