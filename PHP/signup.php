<?php
session_start();
include_once "config.php";
if (
    isset($_POST["prenom"]) && isset($_POST["nom"])
    && isset($_POST["email"]) && isset($_POST["pwd"])

) {
    if (
        !empty($_POST["prenom"]) && !empty($_POST["nom"])
        && !empty($_POST["email"]) && !empty($_POST["pwd"])
    ) {
        $prenom = $_POST["prenom"];
        $nom = $_POST["nom"];
        $email = $_POST["email"];
        $pwd = $_POST["pwd"];
        //verifions si l'email est valide
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            //verifions si cette email existe deja en bdd
            $query = $con->prepare("SELECT  `email` FROM `users` WHERE email = ?");
            $query->execute([$email]);
            if ($query->rowCount() > 0) {
                echo "$email - Cette Adresse email est déja utilisée, merci de changer";
            } else {
                //verification de l'image
                if (isset($_FILES["image"]) && !empty($_FILES["image"])) {
                    if ($_FILES["image"]["size"] > 2000000) {
                        echo "Taille trop grande";
                    } else {
                        //verifions la taille d'abord
                        $img_name = $_FILES["image"]["name"];
                        $img_type = $_FILES["image"]["type"];
                        $temp_name = $_FILES["image"]["tmp_name"];

                        //on separer l'image en verifiant l'extension
                        $img_explode = explode(".", $img_name);
                        $img_ext = end($img_explode); // nous prennons l'extension

                        //on transforme en minuscule l'extension
                        $img_ext = strtolower($img_ext);

                        //liste des extensions autoriser
                        $tab_extensions = ["png", "jpeg", "jpg", "gif"];

                        //verifions si l'extension figure dans notre tableau
                        if (in_array($img_ext, $tab_extensions) == true) {
                            $time = time(); //return le temps courrant
                            #nous en avons besoin du temps afin que qaund on insert une image, on va y concatener le temps courant pour qu'on est des images uniques

                            //deplacons l'image dans un dossier specifique
                            $new_image_name = $time . $img_name;

                            if (move_uploaded_file($temp_name, "../uploads/" . $new_image_name)) {
                                $status = "En Ligne"; //une fois qu'un utilisateur creer un compte, on l'active directement
                                $generate_id = rand(time(), 10000000); //creation d'un id aleatoire pour un user

                                //inserons le user apres que le fichier est deja eté stocké
                                $pwd = password_hash($pwd, PASSWORD_BCRYPT);

                                $query = $con->prepare("INSERT INTO `users`(`unique_id`, `prenom`, `nom`, `email`, `pwd`, `img`, `status`)
                                                    VALUES (?,?,?,?,?,?,?)");
                                $query->execute([$generate_id, $prenom, $nom, $email, $pwd, $new_image_name, $status]);

                                if ($query) { //si le compte a ete creer
                                    //on va recuperer les informations du compte créé
                                    $query = $con->prepare("SELECT * FROM `users` WHERE `email` = '$email' ");
                                    $query->execute();
                                    //on verifie est ce que cet email existe
                                    if ($query->rowCount() > 0) {
                                        $result = $query->fetch();
                                        //creons la session pour cette utilisateur
                                        $_SESSION["unique_id"] = $result["unique_id"];
                                        echo "succes";
                                    }
                                } else {
                                    echo "Impossible de créer un compte,veuillez rééssayer";
                                }
                            } else {
                                echo "veuillez réessayer svp";
                            }
                        } else {
                            echo "les extensions autorisées sont - jpg, png, jpeg, gif";
                        }
                    }
                } else {
                    echo "Svp, selectionnez une image svp";
                }
            }
        } else {
            echo " $email - Eamil Invalide, veuillez resaisir un Email valide";
        }
    } else {
        echo "Tous les champs sont obligatires";
    }
}
