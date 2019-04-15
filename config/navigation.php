<?php

return [
    'navs' => [
        'userNavigation' => [
            [
                'name' => 'Settings',
                'link' => '/settings',
            ],
            [
                'name' => 'Logout',
                'link' => '/logout',
                'class' => 'is-expand',
            ],
        ],
        'sidebar' => [
            [
                'name' => 'Dashboard',
                'link' => '/dashboard',
                'icon' => 'speed'
            ],
            [
                'name' => 'Leads',
                'link' => '/leads',
                'icon' => 'report'
            ],
            [
                'name' => 'Settings',
                'link' => '/settings',
                'icon' => 'settings'
            ],
        ]
    ]
];
