<?php
namespace Common\Authentication;
//Use the Twitter Abraham external library??
require "twitteroauth/autoloader.php";
use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterAuth implements IAuthentication {
      protected $user = " ";
      protected $userpass = " ";
      protected $twitterIdentifier = " ";
      protected $consumer_key = 'ourTestKey';
      protected $consumer_secret = 'ourTestKey';

      public function setTwitterID($twitterID) {
         $this->$twitterIdentifier = $twitterID;
      }
      public function authenticate($username, $password) {
         $this->user = $username;
         $this->userpass = $password;
         
         //Connect to the Twitter app so we can get a request token
         $connection = new TwitterOAuth($consumer_key, $consumer_secret);
         $request_token = $connection->oauth("oauth/request_token", array("oauth_callback" => "http://localhost:8080/...Common/Authentication/TwitterAuthResponse.php"));

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
         //header('Location: '.$url);
         //return the Twitter authorization url
         return $url;
      }
}