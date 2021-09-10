<?php
session_start();

if (isset($_SESSION["unique_id"])) {
    include_once "PHP/config.php";
    //changeons le status en deconnecter une fois qu'il se deconnecte
    $deconnecter = "deconnecter";
    $query = $con->prepare("UPDATE `users` SET `status`=? WHERE `unique_id` = ?");
    $query->execute([$deconnecter,$_SESSION["unique_id"]]);

    if ($query) {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
}
