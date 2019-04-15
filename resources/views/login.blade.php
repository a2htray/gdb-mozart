<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('mozart.site.name') ?? env('APP_NAME') }} - Login</title>

    @if (config('mozart.google.fonts.mode', 'remote') == 'remote')
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    @else
        <link href='{{ URL::asset('css/google-fonts-material-icon.css') }}' rel="stylesheet">
    @endif
</head>

<body>
<div id="app">
    <v-app id="inspire">
        <v-content>
            <v-container fluid fill-height>
                <v-layout align-center justify-center>
                    <v-flex xs12 sm8 md4>
                        <m-login-panel title="Mozart Database System Login"></m-login-panel>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-content>
    </v-app>
</div>
<script src="{{ URL::asset('js/gdb-mozart.app.js') }}"></script>
</body>
</html>
