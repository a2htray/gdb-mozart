<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('mozart.site.name') ?? env('APP_NAME') }} - @yield('title')</title>

    @if (config('mozart.google.fonts.mode', 'remote') == 'remote')
        <link href='https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900|Material+Icons' rel="stylesheet">
    @else
        <link href='{{ URL::asset('css/google-fonts-material-icon.css') }}' rel="stylesheet">
    @endif
</head>

<?php
    $user = \Illuminate\Support\Facades\Auth::user();
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

    $menus = [
        [
            'title' => 'Dashboard',
            'icon' => 'dashboard',
            'href' => sprintf('/u/%s/dashboard?token=%s', $user->name, $user->token),
        ],
        [
            'title' => 'Data Upload',
            'icon' => 'cloud_upload',
            'color' => 'green darken-2',
            'items' => [
                [
                    'title' => 'Sequence',
                    'icon' => 'filter_1',
                    'color' => 'blue darken-2',
                    'href' => sprintf('/u/%s/dataUpload?dataType=fasta&token=%s', $user->name, $user->token),
                ],
                [
                    'title' => 'Annotation',
                    'icon' => 'filter_2',
                    'color' => 'purple darken-2',
                    'href' => sprintf('/u/%s/dataUpload?dataType=gff&token=%s', $user->name, $user->token),
                ],
                [
                    'title' => 'Variation',
                    'icon' => 'filter_3',
                    'href' => sprintf('/u/%s/dataUpload?dataType=vcf&token=%s', $user->name, $user->token),
                ],
                [
                    'title' => 'Ontology',
                    'icon' => 'filter_4',
                    'color' => 'teal darken-2',
                    'href' => sprintf('/u/%s/dataUpload?dataType=obo&token=%s', $user->name, $user->token),
//                    '/u/a2htray/dataUpload?type=obo',
                ],
            ]
        ],
        [
            'title' => 'Resource',
            'icon' => 'dashboard',
            'items' => [
                [
                    'title' => 'Analysis',
                    'icon' => 'dashboard',
                    'href' => sprintf('/u/%s/dashboard?token=%s', $user->name, $user->token),
                ],
                [
                    'title' => 'Organism',
                    'icon' => 'dashboard',
                    'href' => sprintf('/u/%s/dashboard?token=%s', $user->name, $user->token),
                ],
                [
                    'title' => 'Feature',
                    'icon' => 'dashboard',
                    'href' => sprintf('/u/%s/dashboard?token=%s', $user->name, $user->token),
                ],
                [
                    'title' => 'Ontology',
                    'icon' => 'dashboard',
                    'href' => sprintf('/u/%s/dashboard?token=%s', $user->name, $user->token),
                ],
            ]
        ],
        [
            'title' => 'Graph',
            'icon' => 'cloud_upload',
            'items' => [
                [
                    'title' => 'Sequence',
                    'icon' => 'filter_1',
                    'color' => 'blue darken-2',
                    'href' => sprintf('/u/%s/dashboard?token=%s', $user->name, $user->token),
                ],
            ]
        ],
        [
            'title' => 'Tool',
            'icon' => 'dashboard',
            'items' => [
                [
                    'title' => 'Blast',
                    'icon' => 'dashboard',
                    'href' => sprintf('/u/%s/dashboard?token=%s', $user->name, $user->token),
                ],
            ]
        ],
        [
            'title' => 'Mview',
            'icon' => 'dashboard',
            'href' => sprintf('/u/%s/dashboard?token=%s', $user->name, $user->token),
        ],
        [
            'title' => 'File Browser',
            'icon' => 'dashboard',
            'href' => sprintf('/u/%s/dashboard?token=%s', $user->name, $user->token),
        ],
        [
            'title' => 'Setting',
            'icon' => 'dashboard',
            'items' => [
                [
                    'title' => 'Site Status',
                    'icon' => 'dashboard',
                    'href' => sprintf('/u/%s/dashboard?token=%s', $user->name, $user->token),
                ],
                [
                    'title' => 'People',
                    'icon' => 'dashboard',
                    'href' => sprintf('/u/%s/dashboard?token=%s', $user->name, $user->token),
                ],
            ]
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
            <v-toolbar-items>
                <m-logo uri="{{ URL::asset('images/logo.png') }}"></m-logo>
            </v-toolbar-items>

            <v-toolbar-items>
                <v-toolbar-title>Mozart</v-toolbar-title>
            </v-toolbar-items>

            <v-toolbar-items>
                <m-tool-side-button></m-tool-side-button>
            </v-toolbar-items>

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
        <m-sidebar :items="{{ json_encode($menus) }}">
        </m-sidebar>
        <v-content>
            <v-container v-bind:style="{padding: 0 + 'px'}" fluid grid-list-md>
                <m-breadcrumbs :items="{{ json_encode($breadcrumbs) }}"></m-breadcrumbs>
                    @yield('content')
            </v-container>
        </v-content>
    </v-app>
</div>
<script src="{{ URL::asset('js/gdb-mozart.app.js') }}"></script>
</body>
</html>
