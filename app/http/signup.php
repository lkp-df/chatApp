<?php
#verifier si le name, username et passwrd sont definis
if (
    isset($_POST["name"])
    && isset($_POST["username"])
    && isset($_POST["pw"])
) {
    $name = $_POST["name"];
    $username = $_POST["username"];
    $pw = $_POST["pw"];

    #include database for connection
    require_once "../../db/db.php";
    $db = new DB();
    $con = $db->connect();

    #former une url avc les données reçues
    $data = "name=" . $name . "&username=" . $username;

    #verification des données pour la validation
    if (empty($name)) {
        #message d'error
        $em = "Name is required";
        #redirect to 'signup.php' with data and error message
        header("Location: ../../signup.php?error=$em&$data");
        exit();
    } else if (empty($username)) {
        #message d'error
        $em = "Username is required";
        #redirect to 'signup.php' with data and error message
        header("Location: ../../signup.php?error=$em&$data");
        exit();
    } else if (empty($pw)) {
        #message d'error
        $em = "PassWord is required";
        #redirect to 'signup.php' with data and error message
        header("Location: ../../signup.php?error=$em&$data");
        exit();
    } else {

        #eviter d'avoir un meme nm d'utilisateur

        $query = $con->prepare("SELECT `user_name`FROM `users` WHERE user_name = ?");
        $query->execute([$username]);
        $result = $query->fetchAll();
        $count = $query->rowCount();

        if ($count > 0) {
            $em = "Please change user name, ($username) is already used";
            header("Location: ../../signup.php?error=$em&$data");
            exit();
        } else {

            #profile picture check
            if (isset($_FILES["profile"])) {

                $profile = $_FILES["profile"]["name"];
                $tmp_name = $_FILES["profile"]["tmp_name"];
                $error = $_FILES["profile"]["error"];

                if ($error === 0) {

                    #get image extension a part
                    #but we can use directly the $_FILES[""]['type']
                    $img_ext = pathinfo($profile, PATHINFO_EXTENSION);

                    #convert extension to lowercase
                    $img_ext_lc = strtolower($img_ext);

                    #authaurized extension
                    $extension_allowed = array(
                        "jpg", "png",
                        "jpeg", "gif"
                    );

                    if (in_array($img_ext_lc, $extension_allowed)) {

                        #$profile = $_FILES["profile"]["name"];

                        #remaning the image with is username
                        #we concatene the username and is picture
                        #like username: lkp => lkp.png =>lkp.img_ext_lc

                        $new_img_name = $username . "." . $img_ext_lc;

                        #create  dir  path for upload  picture
                        $img_upload_path = "../../upload/" . $new_img_name;

                        #mova upload image to ./upload folder
                        move_uploaded_file($tmp_name, $img_upload_path);
                    } else {
                        $em = "Extension Allowed: JPG,PNG,GIF,JPEG";
                        header("Location: ../../signup.php?error=$em&$data");
                        exit();
                    }
                } /*else {
                    
                    $em = "Unknown error occured";
                    header("Location: ../../signup.php?error=$em&$data");
                    exit();
                }*/
            }
            #hash password first
            $pw = password_hash($pw, PASSWORD_DEFAULT);

            #if the user upload profile picture
            if (isset($new_img_name)) {
                #insert data to database
                $query = $con->prepare("INSERT INTO `users`
                (`name`, `user_name`, `pasword`, `profile_p`
                 ) 
                VALUES (?,?,?,?)");
                $query->execute([$name, $username, $pw, $new_img_name]);
            } else {
                #insert data to database withut a picture
                $query = $con->prepare("INSERT INTO `users`
                (`name`, `user_name`, `pasword`
                 ) 
                VALUES (?,?,?)");
                $query->execute([$name, $username, $pw]);
            }

            #success message
            $sm = "Account create successfully";

            #redirect to index.php for login
            header("Location: ../../index.php?success=$sm");
            exit();
        }
    }
} else {
    #redirect to 'signup.php' and passing error message
    header("Location: ../../signup.php");
    exit();
}
