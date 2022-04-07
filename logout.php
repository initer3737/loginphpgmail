<?php
require_once"google.php";
ini_set("display_erorrs",true);
error_reporting(E_ALL);

$accesstoken=$_SESSION['access_token'];
 
//Reset OAuth access token
$G_client->revokeToken($accesstoken);
 
//Destroy entire session data.
session_destroy();
 
//redirect page to index.php
header('location:index.php');