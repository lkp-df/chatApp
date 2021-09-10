<?php
session_start();
#check if username & password are submit
if (
    isset($_POST["username"])
    && isset($_POST["pw"])
) {
    $username = $_POST["username"];
    $pw = $_POST["pw"];

    if (empty($username)) {
        #message d'error
        $em = "Username is required";
        #redirect to 'signup.php' and error message
        header("Location: ../../index.php?error=$em");
        exit();
    } else if (empty($pw)) {
        #message d'error
        $em = "Password is required";
        #redirect to 'signup.php' and error message
        header("Location: ../../index.php?error=$em");
        exit();
    } else {

        require_once "../../db/db.php";
        $db = new DB();
        $con = $db->connect();

        $query = $con->prepare("SELECT * FROM `users` WHERE `user_name` = ?");
        $query->execute([$username]);

        #check if the username exist
        if ($query->rowCount() === 1) {
            $result = $query->fetch();

            if ($result["user_name"] === $username) {
                #verification for password with passverify
                if (password_verify($pw, $result["pasword"])) {
                    //var_dump($result);
                    #creating session for the user who logiun successfully
                    $_SESSION["username"] = $result["user_name"];
                    $_SESSION["name"] = $result["name"];
                    $_SESSION["user_id"] = $result["user_id"];

                    #redirect to message plateform (home.php)
                    header("Location: ../../home.php");
                    exit();
                } else {
                    #message d'error
                    $em = "Incorrect Password or Username";
                    #redirect to 'signup.php' and error message
                    header("Location: ../../index.php?error=$em");
                    exit();
                }
            }
        } else {
            #message d'error
            $em = "Incorrect Password or Username";
            header("Location: ../../index.php?error=$em");
            exit();
        }
    }
} else {
    #redirect to 'signup.php' 
    header("Location: ../../index.php");
    exit();
}
