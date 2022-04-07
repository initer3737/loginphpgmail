<?php
ini_set("display_errors",true);
error_reporting(E_ALL);

require_once("google.php");
$login_button = '';

if(isset($_GET["code"])){
 $token = $G_client->fetchAccessTokenWithAuthCode($_GET["code"]);
 if(!isset($token['error'])){
  $G_client->setAccessToken($token['access_token']);
  $_SESSION['access_token'] = $token['access_token'];
  $google_service = new Google_Service_Oauth2($G_client);
  $data = $google_service->userinfo->get();
  if(!empty($data['given_name'])){
   $_SESSION['user_first_name'] = $data['given_name'];
  }

  if(!empty($data['family_name'])){
   $_SESSION['user_last_name'] = $data['family_name'];
  }

  if(!empty($data['email'])){
   $_SESSION['user_email_address'] = $data['email'];
  }

  if(!empty($data['gender'])){
   $_SESSION['user_gender'] = $data['gender'];
  }

  if(!empty($data['picture'])){
   $_SESSION['user_image'] = $data['picture'];
  }
 }
}

if(!isset($_SESSION['access_token'])){
 $login_button = '<a href="'.$G_client->createAuthUrl().'" class="btn btn-outline-primary">login google</a>';
}

?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Login pake PHP dong</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 </head>
 <body>
  <div class="container">
      <div class="alert alert-primary"><h1 class="text-center">CUEKIN AJA KALO ADA ERROR INDEX.PHP LINE KE 13!</h1></div>
   <br />
   <h2 class="text-center shadow card bg-light p-2">login pake php dong </h2>
   <br />
   <div class="card shadow rounded p-2">
   <?php
   if($login_button == ''){
    echo '<div class="card-header h4">Welcome User</div><div class="card-body">';
    echo '<img src="'.$_SESSION["user_image"].'" class="img-fluid rounded-pill img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['user_first_name'].' '.$_SESSION['user_last_name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['user_email_address'].'</h3>';
    echo '<h3><a href="logout.php" class="btn btn-outline-danger">Logout</a></h3>';
   }else{
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?>
   </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 </body>
</html>