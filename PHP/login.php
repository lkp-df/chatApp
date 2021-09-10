<?php
session_start();
include_once "config.php";
if (
    isset($_POST["pwd"]) && isset($_POST["email"])
) {
    if (
        !empty($_POST["pwd"]) && !empty($_POST["email"])
    ) {
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];
        //echo "pas vide";
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //verifions si cette email existe deja en bdd
            $query = $con->prepare("SELECT * FROM `users` WHERE email = ?");
            $query->execute([$email]);
            if ($query->rowCount() > 0) {
                $result = $query->fetch();
                //allons verifier le mt de passe pour la comparaison
                if (password_verify($pwd, $result["pwd"])) {
                    $_SESSION["unique_id"] = $result["unique_id"];
                    echo "succes";
                } else {
                    echo "Identifiants Incorrects";
                }
            } else {
                echo "Email ou mot de passe incorrect";
            }
        } else {
            echo "Veuillez saisir une adresse email correcte";
        }
    }else{
        echo "Tous les champs sont obligatoires";
    }
}
