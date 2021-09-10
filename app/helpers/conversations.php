<?php

function getConversation($user_id, $con)
{
    /* getting all the conversations
    for current (logged in) user
    */
    $query = $con->prepare("SELECT * FROM `conversations` 
                    WHERE user_1 = ? OR user_2 = ? 
                    ORDER BY msg_id DESC");
    $query->execute([$user_id, $user_id]);
    $count = $query->rowCount();

    if ($count > 0) {
        $conversations = $query->fetchAll();
        /*
        creating empty array to stre the user conversations */
        $user_data = [];
        #lopping throught the conversations
        foreach ($conversations as $conversation) {
            #if conversations user_1 row equal to user user_id
            if ($conversation["user_1"] == $user_id) {
                $query = $con->prepare("SELECT `user_id`,`name`, `user_name`,
                                `profile_p`, `last_seen` 
                                FROM `users` WHERE `user_id` = ?");
                $query->execute([$conversation["user_2"]]);
            } else {
                $query = $con->prepare("SELECT `user_id`,`name`, `user_name`,
                                `profile_p`, `last_seen` 
                                FROM `users` WHERE `user_id` = ?");
                $query->execute([$conversation["user_1"]]);
            }

            $allConversations = $query->fetchAll();
            #puching a data into the array
            array_push($user_data, $allConversations[0]);
        }
        return $user_data;
    } else {
        #there is not conversation matched, return empty array
        $conversations = [];
        return $conversations;
    }
}
