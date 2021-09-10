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
    <title>CHAT en Temps Réel - Inscription</title>
</head>

<body>
    <div class="wrapper">
        <section class="form signup">
            <header>Chat en Temps Réel</header>
            <form action="#" enctype="multipart/form-data">
                <div class="error-txt"><!--c'est la qu'on affiche les erreus!--></div>
                <div class="name-details">
                    <div class="field input">
                        <label for="prenom">Prenom </label>
                        <input type="text" placeholder="Votre Prenom Ici" name="prenom">
                    </div>
                    <div class="field input">
                        <label for="nom">Nom </label>
                        <input type="text" placeholder="Votre Nom Ici" name="nom">
                    </div>
                </div>
                <div>
                    <div class="field input">
                        <label for="email">Adresse Email </label>
                        <input type="text" placeholder="Votre adresse Email Ici" name="email">
                    </div>
                    <div class="field input">
                        <label for="pwd">Mot de Passe </label>
                        <input type="password" placeholder="Votre Mot de passe Ici" name="pwd">
                        <i class="fa fa-eye"></i>
                    </div>
                    <div class="field image">
                        <label for="image">Choisir une image </label>
                        <input type="file" name="image">
                    </div>
                    <div class="field button">
                        <input type="submit" value="Continuez au chat">
                    </div>
                </div>
            </form>
            <div class="link">
                Vous avez déja un compte ? <a href="login.php">Connectez-vous</a>
            </div>
        </section>
    </div>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="javascript/pass-show-hide.js"></script>
    <script src="javascript/signup.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>