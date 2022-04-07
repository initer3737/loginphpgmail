<?php 
require_once"vendor/autoload.php";
ini_set("display_erorrs",true);
error_reporting(E_ALL);
/**
 * set client id
 * set client secret
 * redirect
 * add scope email and profile
 */
session_start();
$G_client=new Google_Client();
$clientId="isi pake punyamu ya!";
$G_client->setClientId($clientId);
$secret="isi pake punyamu ya!";
$G_client->setClientSecret($secret);
$redirect="http://127.0.0.1/logingoogle/";
$G_client->setRedirectUri($redirect);
$G_client->addScope("email");
$G_client->addScope("profile");


