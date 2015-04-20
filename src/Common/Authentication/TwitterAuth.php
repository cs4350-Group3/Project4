<?php
namespace Common\Authentication;

//Use the Twitter Abraham external library??
require "twitteroauth/autoloader.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$consumer_key = 'ourTestKey';
$consumer_secret = 'ourTestKey';

//Connect to the Twitter app so we can get a request token
$connection = new TwitterOAuth($consumer_key, $consumer_secret);
$request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => "http://localhost...Common/Authentication/TwitterAuthResponse.php"));

//Put the token in a cookie
$oauth_token=$request_token['oauth_token'];
$token_secret=$request_token['oauth_token_secret'];
setcookie("token_secret"," ",time()-3600);
setcookie("token_secret",$token_secret,time()+60*10);
setcookie("oauth_token"," ",time()-3600);
setcookie("oauth_token",$oauth_token,time()+60*10);

//get URL used to authorize the token by Twitter
$url=$connection->url("oauth/authorize",array("oauth_token" => $oauth_token));

//Go to the URL
header('Location: '.$url);

