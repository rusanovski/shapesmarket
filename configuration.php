<?php if (__VER === '__VER') { http_response_code(404); exit; }

    $config = [
        'db' => [
            'host' => '127.0.0.1',
            'user' => 'root',
            'password' => 'password',
            'database' => 'shapemarket',
            'table' => 'shapes',
        ],

        'fields' => [
            'type' => ['circle', 'triangle', 'rectangle'],
            'color' => ['red', 'green', 'blue', 'purple', 'yellow', 'orange'],
            'size' => ['M', 'L', 'XL'],
            'stroke' => ['0', '1', '2', '4', '8', '16', '32'],
        ]

    ];