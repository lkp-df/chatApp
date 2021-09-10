<?php
session_start();
include_once "config.php";

//id de l'emetteur du message
$sender_id = $_SESSION["unique_id"];

//on recoit l'utilisateur a chercher en bd
$searchUser = htmlspecialchars($_POST["searchUser"]);

//on va chercher dans la bd un user qui correspond
$query = $con->prepare("SELECT * FROM `users` 
WHERE NOT unique_id = ? AND
(`prenom` LIKE '%$searchUser%' OR `nom` LIKE '%$searchUser%')
");
$query->execute([$sender_id]);

$output = "";
if ($query->rowCount() > 0) {
    //$result = $query->fetchAll();
    //foreach ($result as $row) {
    //$output .= '<a href="#">
    //<div class="content">
    // <img src="uploads/'.$row["img"].'" alt="">
    // <div class="details">
    //    <span>'.$row["prenom"].' '.$row["nom"].'</span>
    //   <p>ceci est un message de test</p>
    //</div>
    // </div>
    // <div class="status-dot">
    // <i class="fas fa-circle"></i>
    // </div>
    //  </a>';
    //echo $output;
    // }
    //on inclus les donnes de la discusions
    include_once "../dataDiscusion.php";
    echo $output;
} else {
    echo "Aucun resultat trouvé";
}
