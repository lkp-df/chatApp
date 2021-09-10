<?php
session_start();

if (isset($_SESSION["username"])) {
    #destroy session
    session_unset();
    session_destroy();
}

#redirect to login page
header("Location: index.php");
