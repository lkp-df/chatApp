<?php
$result = $query->fetchAll();
foreach ($result as $row) {

    $sql = $con->prepare("SELECT * FROM `messages` 
                        WHERE (`recepteur_id` = ? OR `emetteur_id` = ?)  
                        AND (`emetteur_id` = ? OR `recepteur_id` = ?)
                        ORDER BY msg_id DESC LIMIT 1");
    $sql->execute(
        [
            $row["unique_id"],
            $row["unique_id"],
            $sender_id,
            $sender_id
        ]
    );
    
    if ($sql->rowCount() > 0) {
        $res = $sql->fetch();
        $resp = $res["message"];
    } else {
        $resp =  "Aucune conversation, débutez une !";
    }

    //si le dernier message depasse un certains nombre de caractere, on affichera des point vers la fin
    //on verife la longuer du message
    (strlen($resp) > 28 ? $msg = substr($resp, 0, 40) . "..." : $msg = $resp);

    //afficher qui a envyer le dernier message.
    //echo $res["emetteur_id"];
    
    ($sender_id === $res["emetteur_id"] ? $vous = "vous: " : $vous = "");

    //verifions l'autre interlocuteur est en ligne ou non
    ($row["status"] == "deconnecter" ? $deconnecter = "deconnecter" : $deconnecter = "");

    $output .= '<a href="chat.php?user_id=' . $row["unique_id"] . '">
    <div class="content">
        <img src="uploads/' . $row["img"] . '" alt="">
        <div class="details">
            <span>' . $row["prenom"] . ' ' . $row["nom"] . '</span>
            <p>'.$vous.' ' . $msg . '</p>
        </div>
    </div>
    <div class="status-dot">
        <i class="fas fa-circle '.$deconnecter.'"></i>
    </div>
</a>';
    //echo $output;
}
