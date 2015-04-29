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
    echo "You did it, you're here!";
});

$app->group('/api',function () use ($app){
    $app->post('/auth',function () use ($app) {
        $authSQLite = new \Common\Authentication\SQLiteAuth();
        $jsonBody = json_decode($app->request()->getBody());

        $returnVal = $authSQLite->authenticate($jsonBody->{'username'}, $jsonBody->{'password'});
        $jsonResponse = json_decode($returnVal);
        if ($jsonResponse->{'boolVal'}) {
            $res = [
                "code" => "201",
                "message" => "Welcome",
                "name" => $jsonResponse->{'body'}->{'fName'} . " " . $jsonResponse->{'body'}->{'lName'}
            ];
            $app->response->setBody(json_encode($res));    
            $app->response->setStatus(201);
        } else {
            $res = [
                "code" => "401",
                "message" => "Intruder"
            ];
            $app->response->setBody(json_encode($res));
            $app->response->setStatus(401);
        }

        return;
    });
    $app->post('/register',function () use ($app) {
        $regUser = new \Common\Register\Register();
        $jsonBody = json_decode($app->request()->getBody());
        if ($regUser->registerUser($jsonBody->{'username'}, $jsonBody->{'email'}, $jsonBody->{'fName'}, $jsonBody->{'lName'}, $jsonBody->{'password'}, $jsonBody->{'twitter_username'})) {
            $res = [
                "code" => "201",
                "message" => "Welcome"
            ];    
            $app->response->setBody(json_encode($res));
            $app->response->setStatus(201);
        } else {
            $res = [
                "code" => "401",
                "message" => "Intruder"
            ];
            $app->response->setBody(json_encode($res));
            $app->response->setStatus(401);
        }
        return;
    });
    $app->post('/twitter',function () use ($app) {
        $jsonBody = json_decode($app->request()->getBody());
        $twitterAuth = new \Common\Authentication\TwitterAuth();
        //Get URL approved by Twitter to auth an account
        $twitterAuth->setTwitterID($jsonBody->{'twitter_username'}); 
        $twitterAuthUrl = $twitterAuth->authenticate($jsonBody->{'username'}, $jsonBody->{'password'}); 
        //Now auth the user using the URL
        echo $twitterAuthUrl;
    });
});

$app->run();

