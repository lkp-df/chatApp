<?php
session_start();

#chek if the user is logged in
if (isset($_SESSION["username"])) {
    #database connection
    require_once "../../db/db.php";
    $db = new DB();
    $con = $db->connect();

    #get the id from the user who is logged now
    $id = $_SESSION["user_id"];
    $query = $con->prepare("UPDATE `users` SET `last_seen`= NOW() WHERE `user_id` = ?");
     $query->execute([$id]);

    
} else {
    header("Location: ../../index.php");
    exit();
}
