<?php
session_start();

if (isset($_SESSION["unique_id"])) {
    $sender_id = htmlspecialchars($_POST["sender_id"]);
    $receiver_id = htmlspecialchars($_POST["receiver_id"]);
    $message = htmlspecialchars($_POST["message"]);

    //verifions le message est vide ou non
    if(!empty($message)){
        //on va inserer cela dans mla table message
        include_once "config.php";
        $query = $con->prepare("INSERT INTO `messages`(`emetteur_id`, `recepteur_id`, `message`)
         VALUES (?,?,?)");
         $query->execute([$sender_id,$receiver_id,$message]);
    }
         
} else {
    header("Location: ../login.php");
}
