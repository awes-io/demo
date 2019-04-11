<?php

return [

    //This key pass to vuejs config
    'frontend' => [
        'key' =>  env('AWES_CDN_KEY', 'undefined')
    ],

    'name' => env('APP_NAME', 'Awes.IO'),

    'url' => env('APP_URL', 'https://example.com'),

    'logo' => env('APP_LOGO', ''),

    'fonts' => ['https://fonts.googleapis.com/css?family=Roboto:300,400,400i,500,700'],

    'custom_styles' => '',

    'auth_bg_left' => 'https://static.awes.io/demo/bg_gifs.svg',

    'auth_bg_full' => 'https://static.awes.io/demo/awes-background.svg',

    'dist' => [
        'js/main.js',
        'js/main.legacy.js',
        'css/main.css'
    ],
    'chart_colors' => [
        'light-blue' => 'rgba(55,179,196,0.6)', // '#37b3c4',
        'blue' => 'rgba(63,135,199,0.6)', //'#3f87c7',
        'dark-blue' => 'rgba(63,75,181,0.6)', //'#3f4bb5',
        'violet' => 'rgba(135, 43, 188, 0.6)',
        'pink' => 'rgba(224,93,112,0.6)', //'#e05d70',
        'yellow' => 'rgba(191,139,47,0.6)', //'#bf8b2f',
        'orange' => 'rgba(169,84,37,0.6)', //'#a95425',
        'red' => 'rgba(188,43,77,0.6)', //'#bc2b4d',
        'green' => 'rgba(19,174,69,0.6)', //'#13ae45',
        'grey' => 'rgba(204,204,204,0.2)', //'#cccccc'
    ],

    'nav' => [
        'expanded' => true
    ],

    'footer_copyright' => '© 2019 - Proudly powered on <a href="https://www.awes.io" target="_blank">Awes.IO Platform</a>'
];
