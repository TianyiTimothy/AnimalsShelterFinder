<!DOCTYPE html>
<html lang="en">

<?php
session_start();
require_once "keys/keys.php";
require_once "GoogleAPI/vendor/autoload.php";

// google client object
$googleClient = new Google_Client();
$googleClient->setClientId($GSI_CLIENT_ID);
$googleClient->setClientSecret($GSI_CLIENT_SECRET);
$googleClient->setRedirectUri("https://tianyi.codes/list.php");
$googleClient->addScope('email');
$googleClient->addScope('profile');

// signing in? store token into session
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

        // redirect to list
        header("Location: list.php");
    } else {
        echo "error occurs when doing Google login.";
    }
}
//echo $_SERVER['REQUEST_URI'];
// if not sign in: redirect
if (!isset($_SESSION['access_token']) && !explode("login.php", $_SERVER['REQUEST_URI'])) {
    header("Location: login.php");
}else if(isset($_SESSION['access_token'])){
?>
<head>
    <title>Animals Shelter Finder</title>
    <link href="https://fonts.googleapis.com/css2?family=Indie+Flower&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/base.css">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
            integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
            integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
            integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
            crossorigin="anonymous"></script>
</head>

<body>
<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-left">

        <?php
        echo "<h4>welcome, " . $_SESSION["user_first_name"] . "</h4>";
        ?>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
<!--                <li class="nav-item">-->
<!--                    <a class="btn btn-outline-dark mb-1 nav-link" href="index.php">Home</a>-->
<!--                </li>-->
                <li class="nav-item">
                    <a class="btn btn-outline-dark mb-1 nav-link" href="list.php">Animal Shelter Finder</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-dark mb-1 nav-link" href="map.php">Map</a>
                </li>
                <!--                <li class="nav-item dropdown">-->
                <!--                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"-->
                <!--                       data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                <!--                        Dropdown-->
                <!--                    </a>-->
                <!--                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">-->
                <!--                        <a class="dropdown-item" href="#">Action</a>-->
                <!--                        <a class="dropdown-item" href="#">Another action</a>-->
                <!--                        <div class="dropdown-divider"></div>-->
                <!--                        <a class="dropdown-item" href="#">Something else here</a>-->
                <!--                    </div>-->
                <!--                </li>-->
                <!--                <li class="nav-item">-->
                <!--                    <a class="nav-link disabled" href="#">Disabled</a>-->
                <!--                </li>-->
                <?php
                echo "<form action='login.php' method='post'>";
                echo "<input class='btn btn-outline-dark mb-1 nav-link' style='display: inline-block;width: 100%;' type='submit' name='signout' value='sign out' />";
                echo "</form>";
                }

                ?>
            </ul>
        </div>
    </nav>
</header>
<main id="main">