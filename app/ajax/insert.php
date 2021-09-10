<?php
session_start();

#check if the user is logged
if (isset($_SESSION["username"])) {

    if (
        isset($_POST["message"]) && !empty($_POST["message"])
        && isset($_POST["to_id"]) && !empty($_POST["to_id"])
    ) {


        #for db connection
        require_once "../../db/db.php";
        $db = new DB();
        $con = $db->connect();

        #get data form XHR request and store it
        $message = htmlspecialchars($_POST["message"]); //is juste a feiw security
        $to_id = $_POST["to_id"];
        #the sender is id is store in a session variable
        $from_id = $_SESSION["user_id"];

        #we insert the message in db so that the receiver can see it
        $query = $con->prepare("INSERT INTO `chats`(`from_id`, `to_id`, `message`)
                     VALUES (?,?,?)");
        $query->execute([$from_id, $to_id, $message]);

        #if the message is inserted
        if ($query) {
            #check if this the first conversation between them(entre les deux users)
            $query = $con->prepare("SELECT * FROM `conversations`
         WHERE `user_1` = ? AND `user_2` = ?
         OR    `user_2` = ? AND `user_1` = ?");
            #soit un est emetteur et l'autre recepteur et vice versa
            $query->execute([
                $from_id,
                $to_id,
                $from_id,
                $to_id
            ]);

            //setting up the time zone
            //it dependes on yourlocation or your pc.settings
            define("TIMEZONE", "Africa/Dakar");

            //define a default time zone
            date_default_timezone_set(TIMEZONE);

            $time = date("h:i:s a");

            $count = $query->rowCount();
            #if there is  no message
            if ($count == 0) {
                #insert the conversation in table conversations
                $query = $con->prepare("INSERT INTO `conversations`( `user_1`, `user_2`)
             VALUES (?,?)");
                $query->execute([$from_id, $to_id]);
            }
            #show the conversation between the user, now
?>
            <!-- user send message right position -->
            <p class="rtext align-self-end
                     border rounded p-2 mb-1">
                <?= $message; ?>
                <small class="d-block"><?= $time;?></small>
            </p>
<?php
        }
    } else {
        #to do for no message send or empty
    }
} else {
    header("Location: ../../index.php");
    exit();
}
