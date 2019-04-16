<?php

return [
    'site' => [
        // 网站的名称
        'name' => 'Mozart',
        // 网站的标语
        'slogan' => 'We find it and eat it',
    ],
    // 个体图片的存储路径，相对于网站根目录
    'avatar_dir' => 'avatar',
    'google' => [
        'fonts' => [
            // support local or remote
            'mode' => 'local'
        ]
    ],
    'obo' => [
        'defaults' => [
            'Gene Ontology' => public_path('files/obo/go.obo'),
            'Sequence Ontology' => public_path('files/obo/so.obo'),
            'Relationship Ontology' => public_path('files/obo/ro.obo'),
            'Taxonomic Rank' => public_path('files/obo/taxrank.obo'),
        ]
    ]
];
