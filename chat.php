<?php
session_start();
include_once "PHP/config.php";
if (!isset($_SESSION["unique_id"])) {
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <title>CHAT en Temps Réel - Chat</title>
</head>

<body>
    <div class="wrapper">
        <section class="chat-area">
            <header>
                <?php
                //recevoir le user_id de l'interlocuteur
                $user_id = htmlspecialchars($_GET["user_id"]);

                //affichage du nom et prenom et image de l'interlocuteur
                $query = $con->prepare("SELECT `unique_id`, `prenom`, `nom`, `img`, `status`
                         FROM `users` WHERE `unique_id` = ?");
                $query->execute([$user_id]);
                $result = $query->fetch();
                ?>
                <a href="user.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
                <img src="uploads/<?= $result["img"]; ?>" alt="">
                <div class="details">
                    <span><?= $result["prenom"] . "&nbsp; " . $result["nom"]; ?></span>
                    <p><?= $result["status"]; ?></p>
                </div>
            </header>
            <div class="chat-box">
                <!-- message sortant
                <div class="chat msg_sortant">
                    <div class="details">
                    <p>' . $row["message"] . '</p>
                    </div>
                </div>
                 -->
                <!-- message entrant
                    <div class="chat msg_entrant">
                        <img src="picture/user-default.png" alt="">
                        <div class="details">
                            <p>fugit est doloremque sunt iusto voluptatibus ex facere distinctio ullam ipsa eaque velit impedit corporis.</p>
                        </div>
                    </div>
                -->
            </div>
            <!-- partie pour ecrire le message -->
            <form action="#" class="typing-area" autocomplete="off">
                <input type="hidden" name="sender_id" value="<?= $_SESSION["unique_id"]; ?>">
                <input type="hidden" name="receiver_id" value="<?= $user_id; ?>">

                <input type="text" name="message" class="input-field" placeholder="Veuillez saisir votre message">
                <button><i class="fab fa-telegram-plane"></i></button>
            </form>
        </section>
    </div>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="javascript/chat.js"></script>

</body>

</html>