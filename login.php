<?php

require_once "keys/keys.php";
require_once "GoogleAPI/vendor/autoload.php";

// google client object
$googleClient = new Google_Client();
$googleClient->setClientId($GSI_CLIENT_ID);
$googleClient->setClientSecret($GSI_CLIENT_SECRET);
$googleClient->setRedirectUri("https://localhost/xmlfinal/list.php");
$googleClient->addScope('email');
$googleClient->addScope('profile');

$login_button = '';

if (isset($_GET['code'])) {
    $token = $googleClient->fetchAccessTokenWithAuthCode($_GET['code']);

    if (!isset($token['error'])) {
        $googleClient->setAccessToken($token['access_token']);
        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($googleClient);

        $data = $google_service->userinfo->get();

        if (!empty($data['given_name'])) {
            $_SESSION['user_first_name'] = $data['given_name'];
        }
        if (!empty($data['family_name'])) {
            $_SESSION['user_last_name'] = $data['family_name'];
        }
        if (!empty($data['email'])) {
            $_SESSION['user_email'] = $data['email'];
        }

    }
}

// user already login
if (!isset($_SESSION['access_token'])) {
    $login_button = '<a class="btn btn-dark" href="' . $googleClient->createAuthUrl() . '">Click to Login</a>';
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with google</title>
</head>
<body>
<?php require_once "includes/header.php";?>
<div class="container">
    <div class="row d-flex justify-content-center">
        <div class="col-md-3">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" style="width: 50px;" src="img/logo.png" alt="logo image">
                <div class="card-body">
                    <h5 class="card-title">Please Login First</h5>
                    <p class="card-text">
                        Our website requires you to login first (in order to prevent hacker attacks)
                    </p>
            <?php
            if ($login_button == '') {
                echo '<div class="panel-heading">Welcome ' . $_SESSION["user_first_name"] . '</div><div class="panel-body">';
                echo '<h3><b>Name: </b>' . $_SESSION["user_first_name"] . ' ' . $_SESSION['user_last_name'] . '</h3>';
                echo '<h3><b>Email: </b>' . $_SESSION["user_email"] . '</h3>';
                echo '<h3><a href="logout.php">Logout</h3></div>';
            } else {
                echo '<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark">'.$login_button.'</div>';
            }
            ?>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>