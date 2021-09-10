<?php

#get the chat between user
function getChats($id_1, $id_2, $con)
{
    $query = $con->prepare("SELECT * FROM `chats`
                 WHERE `from_id` = ? AND `to_id` = ?
                 OR `to_id` = ? AND `from_id` = ?
                 ORDER BY chat_id ASC");
    $query->execute([$id_1, $id_2, $id_1, $id_2]);
    $count = $query->rowCount();

    if ($count > 0) {
        $chats = $query->fetchAll();
        #return list of chats between the user passed in parameter
        return $chats;
    } else {
        $chats = [];
        return $chats;
    }
}
