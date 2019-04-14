<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('mozart.site.name') ?? env('APP_NAME') }} - @yield('title')</title>

  @if (config('mozart.google_fonts', true))
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
  @endif
</head>

<?php
    $mockProfileItems = [
        [
            'icon' => 'account_circle',
            'href' => '#',
            'title' => 'Profile',
        ],
        [
            'icon' => 'fullscreen_exit',
            'href' => uMozartRoute('logout'),
            'title' => 'Logout',
        ]
    ];

    // notification
    $mockNotificationTotal = 29;
    $mockNotificationItems = [];
    $mockNotificationItem = [
        'title' => 'New user registered',

        'color' => 'light-green',
        'icon' => 'account_circle',
        'timeLabel' => '2019-04-14 12:45'
    ];

    for($i = 0; $i < 5; $i++) {
        $mockNotificationItem['title'] = $mockNotificationItem['title'] . $i;
        $mockNotificationItem['href'] = uMozartRoute('notification', ['id' => $i]);
        array_push($mockNotificationItems, $mockNotificationItem);
    }

    $mockMenuItems = [
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'items' => [
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
            ]
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'href' => '/u/a2htray/dashboard',
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'href' => '/u/a2htray/dashboard',
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'items' => [
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
            ]
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'items' => [
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
            ]
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'href' => '/u/a2htray/dashboard',
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'href' => '/u/a2htray/dashboard',
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'items' => [
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
            ]
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'items' => [
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
            ]
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'href' => '/u/a2htray/dashboard',
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'href' => '/u/a2htray/dashboard',
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'items' => [
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
            ]
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'items' => [
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
                [
                    'title' => 'Dashboard',
                    'icon' => 'dashboard',
                    'href' => '/u/a2htray/dashboard',
                ],
            ]
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'href' => '/u/a2htray/dashboard',
        ],
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'href' => '/u/a2htray/dashboard',
        ],
    ];
?>

<body>
<div id="app">
    <v-app id="inspire">
        <v-toolbar
            color="blue"
            dark
            app
            :clipped-left="$vuetify.breakpoint.mdAndUp"
            fixed
        >
            <v-spacer></v-spacer>
            <m-notification
                total={{ $mockNotificationTotal }}
                href="{{ uMozartRoute('notifications') }}"
                :items="{{ json_encode($mockNotificationItems) }}">
            </m-notification>
            <m-avatar avatar-uri="{{ URL::asset('images/default-avatar.png') }}"
                      :items="{{ json_encode($mockProfileItems) }}">
            </m-avatar>
        </v-toolbar>
        <m-sidebar :items="{{ json_encode($mockMenuItems) }}">
        </m-sidebar>
        <v-content>
            <v-container fluid fill-height>
                <v-layout justify-center align-center>
                    @yield('content')
                </v-layout>
            </v-container>
        </v-content>
    </v-app>
</div>
<script src="{{ URL::asset('js/gdb-mozart.app.js') }}"></script>
</body>
</html>
