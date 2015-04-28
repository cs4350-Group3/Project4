<?php
$projectDir = realpath(dirname(__FILE__) . '/../../');
$authDir = $projectDir . '/src/Common/Authentication';
$registerDir = $projectDir . '/src/Common/Register';
$commonDir = $projectDir . '/src/Common';
$controllersDir = $projectDir . '/src/Controllers';
$configDir = $projectDir . '/src/Config';
$httpDir = $projectDir . '/src/Common/Http';
$routerDir = $projectDir . '/src/Common/Routers';
$srcDir = $projectDir . '/src';
$viewsDir = $projectDir . '/src/Views';
$config = [
    'app' => [
        'slim-config' => [
            'debug'       => true,
            'mode'        => 'development',
            'log.enabled' => true,
        ],
        'yii-config' => [
        ],
        'dir'          => [
            'authentication' => $authDir,
            'register'       => $registerDir,
            'common'         => $commonDir,
            'controllers'    => $controllersDir,
            'config'         => $configDir,
            'http'           => $httpDir,
            'routers'        => $routerDir,
            'src'            => $srcDir,
            'views'          => $viewsDir
        ],
        'endpoints' => [
        ]
    ]
];