<?php

//Should get sent here from Twitter

//Use the Twitter Abraham external library??
require "twitteroauth/autoloader.php";
use Abraham\TwitterOAuth\TwitterOAuth;

$consumer_key = 'ourTestKey';
$consumer_secret = 'ourTestKey';

//Get the tokens
$oauth_verifier=$_GET['oauth_verifier'];
$token_secret=$_COOKIE['token_secret'];
$oauth_token=$_COOKIE['oauth_token'];

//change tokens to the oauth tokens
$conn = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token, $token_secret);
$access_token = $conn->oauth("oauth/access_token", array("oauth_verifier" => $oauth_verifier));

$accessToken=$acces_token['oauth_token'];
$secretToken=$access_token['oauth_token_secret'];

//Show the tokens
echo "access token:".$accessToken;
echo "secret token:".$secretToken;

