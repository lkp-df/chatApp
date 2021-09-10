<?php
session_start();
include_once "PHP/config.php";
if (!isset($_SESSION["unique_id"])) {
    header("Location: login.php");
}else{
    $EnLigne = "En Ligne";
    $query = $con->prepare("UPDATE `users` SET `status`=? WHERE `unique_id` = ?");
    $query->execute([$EnLigne,$_SESSION["unique_id"]]);
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
    <title>CHAT en Temps Réel - Users</title>
</head>

<body>
    <div class="wrapper">
        <section class="users">
            <header>
                <?php
                $query = $con->prepare("SELECT * FROM `users` WHERE `unique_id` = ?");
                $query->execute([$_SESSION["unique_id"]]);
                if ($query->rowCount() > 0) {
                    $result = $query->fetch();
                ?>
                    <div class="content">
                        <img src="uploads/<?= $result["img"]; ?>" alt="">
                        <div class="details">
                            <span><?= $result["prenom"] . "&nbsp; " . $result["nom"]; ?></span>
                            <p><?= $result["status"]; ?></p>
                        </div>
                    </div>
                <?php } ?>
                <a href="logout.php" class="logout">Déconnexion</a>
            </header>
            <div class="search">
                <span class="text">rechercher un utilisateur</span>
                <input type="text" placeholder="saisir un nom à rechercher">
                <button>
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <!-- show all user (user list) -->
            <div class="users-list">
                <!-- <a href="#">
                    <div class="content">
                        <img src="picture/user-default.png" alt="">
                        <div class="details">
                            <span>LKP Prod</span>
                            <p>ceci est un message de test</p>
                        </div>
                    </div>
                    <div class="status-dot">
                        <i class="fas fa-circle"></i>
                    </div>
                </a> -->
            </div>
        </section>
    </div>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="javascript/users.js"></script>
</body>

</html>