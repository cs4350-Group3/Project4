<?php
$autoLoader = realpath(
    __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.
    'vendor'.DIRECTORY_SEPARATOR.'autoload.php'
);

/** @noinspection PhpIncludeInspection */
require $autoLoader;

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Max-Age: 1000');

require 'config.php';

$app = new \Slim\Slim(
    $config['app']['slim-config']
);

$app->get('/',function (){
    echo "this is a test!";
});

$app->group('/api',function () use ($app){
    $app->post('/auth',function () use ($app) {
        $authSQLite = new \Common\Authentication\SQLiteAuth();
        $jsonBody = json_decode($app->request()->getBody());

        if ($authSQLite->authenticate($jsonBody->{'username'}, $jsonBody->{'password'})) {
            $res = [
                "code" => "201",
                "message" => "Welcome"
            ];    
            $app->response->setStatus(201);
        } else {
            $res = [
                "code" => "401",
                "message" => "Intruder"
            ];
            //$app->response->setStatus(401);
        }

        $app->response->setBody(json_encode($res));

        return;
    });
});

$app->run();

