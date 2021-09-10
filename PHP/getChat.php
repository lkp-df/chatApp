<?php
session_start();
include_once "config.php";
if (isset($_SESSION["unique_id"])) {
    $sender_id = htmlspecialchars($_POST["sender_id"]);
    $receiver_id = htmlspecialchars($_POST["receiver_id"]);

    $output = "";

    $query = $con->prepare("SELECT * FROM `messages`
       JOIN users ON users.unique_id = messages.recepteur_id
     WHERE (messages.`emetteur_id` = ? AND messages.`recepteur_id` = ?)
     OR (messages.`emetteur_id` = ? AND messages.`recepteur_id` = ?) 
     AND users.unique_id = messages.recepteur_id  ORDER BY msg_id");
    $query->execute([$sender_id, $receiver_id, $receiver_id, $sender_id]);

    if ($query->rowCount() > 0) {
        $result = $query->fetchAll();
        foreach ($result as $row) {

            //distinguer l'emetteur et le recepteur pour positionner les messages aux endroits exactes
            if ($row["emetteur_id"] === $sender_id) { //si ca correspond donc c'est lui l'emeteur
                $output .= '<div class="chat msg_sortant">
                                    <div class="details">
                                    <p>' . $row["message"] . '</p>
                                    </div>
                                </div>';
            } else { //c'est le recepteur
                $output .= '<div class="chat msg_entrant">
                <img src="uploads/'.$row["img"].'" alt="">
                <div class="details">
                    <p>' . $row["message"] . '</p>
                </div>
            </div>';
            }
        }
        //affiche le contenu de output qu'importe l'ordre
        echo $output;
    }
} else {
    header("Location: ../login.php");
}
