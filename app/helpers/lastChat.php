<?php

#get the chat between user
function lastChat($id_1, $id_2, $con)
{
    $query = $con->prepare("SELECT * FROM `chats`
                 WHERE `from_id` = ? AND `to_id` = ?
                 OR `to_id` = ? AND `from_id` = ?
                 ORDER BY chat_id DESC LIMIT 1");
    $query->execute([$id_1, $id_2, $id_1, $id_2]);
    $count = $query->rowCount();

    if ($count > 0) {
        $chat = $query->fetch();
        #return list of chats between the user passed in parameter
        return $chat["message"];
    } else {
        $chat = "";
        return $chat;
    }
}
