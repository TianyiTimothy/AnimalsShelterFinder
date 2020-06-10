<?php

if (!isset($_SESSION['access_token'])) {
    header("Location: login.php");
} else {
    header("Location: list.php");
}