<?php

#check if the message was read or opened 
#if the user is online, the message should be opened to 1
function opened($id_1, $con, $chats)
{
    foreach ($chats as $chat) {
        if ($chat["openned"] == 0) {
            #we update the message to opened
            $openned = 1;
            $chat_id = $chat["chat_id"];

            $query = $con->prepare("UPDATE `chats` SET `openned`=?
                                 WHERE `from_id`= ? AND  `chat_id` = ?");
            $query->execute([$openned, $id_1, $chat_id]);
        }
    }
}
