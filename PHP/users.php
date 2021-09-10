<?php
session_start();
include_once "config.php";
$sender_id = $_SESSION["unique_id"];

$query = $con->prepare("SELECT * FROM `users`
WHERE NOT unique_id = ?");
$query->execute([$sender_id]);

$output = "";
if ($query->rowCount() == 1) {
    $output .= "Pas d'utilisateurs pour converser";
    echo $output;
} else if ($query->rowCount() > 1) {
    //$result = $query->fetchAll();
    //foreach ($result as $row) {
    //$output = '<a href="#">
    //<div class="content">
    //<img src="uploads/' . $row["img"] . '" alt="">
    //<div class="details">
    //<span>' . $row["prenom"] . "&nbsp; " . $row["nom"] . '</span>
    //<p>ceci est un message de test</p>
    //</div>
    //</div>
    //<div class="status-dot">
    //<i class="fas fa-circle"></i>
    //</div>
    //</a>';
    //    echo $output;
    //}
    include_once "../dataDiscusion.php";
}
//on affiche au moins le contenu de output
echo $output;
