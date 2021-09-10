<?php
session_start();

if (isset($_SESSION["username"])) {
    require_once "db/db.php";
    $db = new DB();
    $con = $db->connect();

    #chek if there is a user choose to conversate
    if (!isset($_GET["user"])) {
        header("Location: home.php");
        exit();
    }
    #include the function for call user
    include_once "app/helpers/user.php";

    #include the function for call user
    include_once "app/helpers/opened.php";

    #include the function for call all chat between two user
    include_once "app/helpers/chat.php";


    #store data for user and get it
    $chatWith = getUser($_GET["user"], $con);
    #include the function for when the user was connected
    include_once "app/helpers/timeAgo.php";


    #check if the user that we want t chat exist or restult is  not empty
    if (empty($chatWith)) {
        header("Location: home.php");
        exit();
    }

    #get all chats
    $chats = getChats($_SESSION["user_id"], $chatWith["user_id"], $con);
    //print_r($chats);
    #get response if the message is opened
    $opened = opened($chatWith["user_id"], $con, $chats);
    //print_r($opened);
} else {
    header("Location: ../../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/logo.png">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <title>Chat - Messages</title>
</head>

<body class="d-flex
            justify-content-center
            align-items-center
            vh-100">
    <div class="w-400 shadow p-4 rounded">
        <!-- &#8592 represent unicode for the arrow to go back -->
        <a href="home.php" class="text-dark"><i class="fas fa-arrow-left"></i></a>

        <!-- head online user -->
        <div class="d-flex align-items-center">
            <img src="upload/<?= $chatWith["profile_p"]; ?>" class="w-15 rounded-circle">
            <h3 class="display-4 fs-sm m-2"><?= $chatWith["name"]; ?> <br>
                <div class="d-flex align-items-center" title="online">
                    <?php if (lastSeen($chatWith["last_seen"]) == "Active") { ?>
                        <div class="online"></div>
                        <small class="d-block p-1">&nbsp;Online</small>
                    <?php } else { ?>
                        <small class="d-block p-1">Last seen:&nbsp;<?= lastSeen($chatWith["last_seen"]); ?></small>
                    <?php } ?>
                </div>
            </h3>
        </div>
        <!-- message between user -->
        <div class="shadow p-4 rounded d-flex flex-column mt-2 chat-box" id="chatBox">
            <!-- make a loop to retrieve message between them(users) -->
            <?php if (!empty($chats)) {
                foreach ($chats as $chat) {
                    if ($chat['from_id'] == $_SESSION["user_id"]) { ?>
                        <!-- user send message right position -->
                        <p class="rtext align-self-end
                     border rounded p-2 mb-1">
                            <?= $chat["message"]; ?>
                            <small class="d-block"><?= $chat["create_at"]; ?> </small>
                        </p>
                    <?php } else { ?>
                        <!-- user receive message left position -->
                        <p class="ltext  border rounded p-2 mb-1">
                            <?= $chat["message"]; ?>
                            <small class="d-block"><?= $chat["create_at"]; ?></small>
                        </p>
                <?php }
                }
                ?>

            <?php } else { ?>
                <div class="alert alert-info text-center" role="alert">
                    <i class="fa fa-comments d-block fs-big"></i>
                    No messages yet, Start the conversation
                </div>
            <?php } ?>

        </div>

        <!-- write a message to someone else-->
        <div class="input-group mb-3">
            <textarea class="form-control" id="message" cols="3">

            </textarea>
            <button class="btn btn-primary" id="sendBtn">
                <i class="fa fa-paper-plane"></i>
            </button>
        </div>
    </div>


    <script src="js/jquery-3.5.1.min.js"></script>
    <script>
        var scrollDown = function() {
            let chatBox = document.getElementById("chatBox");
            /*get the height of scroll bar*/
            chatBox.scrollTop = chatBox.scrollHeight;
        }
        scrollDown();

        $(document).ready(function() {
            $("#sendBtn").on("click", function() {
                message = $("#message").val();
                if (message == "") return false;
                $.post("app/ajax/insert.php", {
                        message: message,
                        to_id: <?= $chatWith["user_id"]; ?>
                    },
                    function(data, status) {
                        $("#message").val("");
                        /*put the message sent to chat box automaticaly */
                        $("#chatBox").append(data);
                        /*call the scroll down fo see the last message */
                        scrollDown();
                    });
            });

            /* auto update last seen for logged in user */
            let lastSeenUpdate = function() {
                $.get("app/ajax/updateLastSeen.php");
            };
            lastSeenUpdate();
            /* auto update last seen every 10 second **/
            setInterval(lastSeenUpdate, 10000);


            /* auto refresh */
            let fetchData = function() {
                $.post("app/ajax/getMessage.php", {
                        id_2: <?= $chatWith["user_id"]; ?>
                    },
                    function(data, status) {
                        /*put the message sent to chat box automaticaly */
                        $("#chatBox").append(data);
                        if (data != "") scrollDown();
                    });
            }

            fetchData();
            /* auto get message  every 0.5 second **/
            setInterval(fetchData, 500);

        });
    </script>
</body>

</html>