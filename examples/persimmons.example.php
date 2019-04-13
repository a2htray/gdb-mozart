<?php

/**
 * the length of unique name must be equal to 6
 */


return [
    'package_prefix' => 'mozart',
    'menus' => [
        [
            'name' => 'Contents',
            'region_type' => 1,
            'uri_pattern' => '/specie/{specie_id}/organism/{organism_id}'
        ],
        [
            'name' => 'System',
            'region_type' => 1,
            'is_group' => true,
            'children' => [
                [
                    'name' => 'Site status',
                    'uri_pattern' => '/site/status'
                ],
                [
                    'name' => 'Visit audit',
                    'uri_pattern' => '/site/audit',
                ]
            ]
        ]
    ],
    'actions' => [
        [
            'name' => 'Add species',
            'unique_name' => '101010',
        ],
        [
            'name' => 'Add organism',
            'unique_name' => '111111',
        ]
    ]
];