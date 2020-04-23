<?php

require_once "keys/keys.php";

$login_button = '';
if (isset($_POST['signout'])) {
//    session_unset($_SESSION['access_token']);
    // clean all session
    // todo: clean login session only.
    session_start();
    session_destroy();
}


?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login with google</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body id="body">
<?php require_once "includes/header.php"; ?>
<div class="card" style="width: 18rem;">
    <div class="card-header"><h1>ASF Login</h1></div>
    <div class="card-body">
        <h5 class="card-title">Please Login First</h5>
        <p class="card-text">
            Animal Shelter Finder requires you to login (in order to prevent hacker attacks)
        </p>
        <?php
        // user not login
        if (!isset($_SESSION['access_token'])) {
            $login_button = '<a class="btn btn-dark" href="' . $googleClient->createAuthUrl() . '">Click to Login</a>';
        }

        if ($login_button == '') {
            header("Location: list.php");
        } else {
            echo '<div class="g-signin2" data-onsuccess="onSignIn" data-theme="dark">' .
                $login_button . '</div>';
        }
        ?>
    </div>
</div>
</body>
</html>