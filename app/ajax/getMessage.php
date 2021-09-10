<?php
session_start();

if (isset($_SESSION["username"])) {
    require_once "../../db/db.php";
    $db = new DB();
    $con = $db->connect();

    #check the user that receive the message
    if (isset($_POST["id_2"])) {
        $id_2 = $_POST["id_2"];
        $id_1 = $_SESSION["user_id"];
        $opend  = 0;

        $query  = $con->prepare("SELECT * FROM `chats`
         WHERE `to_id` = ? AND `from_id` = ? 
         ORDER BY `chat_id` ASC");
        $query->execute([$id_1, $id_2]);
        $count = $query->rowCount();

        if ($count > 0) {
            $chats = $query->fetchAll();

            #looping thought the chats
            foreach ($chats as $chat) {
                #chack if the message is not seeing
                if ($chat["openned"] == 0) {
                    #we marq it as message read
                    $opend = 1;
                    $chat_id = $chat["chat_id"];

                    $query = $con->prepare("UPDATE `chats` SET `openned`=?
                                 WHERE `chat_id` = ?");
                    $query->execute([$opend, $chat_id]);

?>
                    <!-- user receive message left position -->
                    <p class="ltext  border rounded p-2 mb-1">
                        <?= $chat["message"]; ?>
                        <small class="d-block"><?= $chat["create_at"]; ?></small>
                    </p>
<?php
                }
            }
        }
    }
} else {
    header("Location: ../../index.php");
    exit();
}
