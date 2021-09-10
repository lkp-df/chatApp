<?php
#for fucntions

function getUser($username, $con)
{
    $query = $con->prepare("SELECT * FROM `users` WHERE `user_name` = ?");
    $query->execute([$username]);
    $count = $query->rowCount();

    if ($count ===  1) {
        $result = $query->fetch();
        return $result;
    } else {
        $result = [];
        return $result;
    }
}
