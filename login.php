<?php
session_start();
if (isset($_SESSION["unique_id"])) {
    header("Location: user.php");
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
    <title>CHAT en Temps Réel - Connexion</title>
</head>

<body>
    <div class="wrapper">
        <section class="form login">
            <header>Chat en Temps Réel</header>
            <form action="#">
                <div class="error-txt">
                    <!--ceci est un message d'erreur !-->
                </div>

                <div>
                    <div class="field input">
                        <label for="email">Adresse Email </label>
                        <input type="text" name="email" placeholder="saisir une adresse Email">
                    </div>
                    <div class="field input">
                        <label for="pwd">Mot de Passe </label>
                        <input type="password" name="pwd" placeholder="Entrer votre mot de passe">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="field button">
                        <input type="submit" value="Continuez au chat">
                    </div>
                </div>
            </form>
            <div class="link">
                Pas de Compte ? <a href="index.php">Creez un compte</a>
            </div>
        </section>
    </div>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/login.js"></script>
</body>

</html>