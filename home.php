<?php
session_start();

if (isset($_SESSION["username"])) {
    require_once "db/db.php";
    $db = new DB();
    $con = $db->connect();
    #include the function for call user
    include_once "app/helpers/user.php";

    #include the function for print a conversation
    include_once "app/helpers/conversations.php";

    #include the function for print a conversation
    include_once "app/helpers/lastChat.php";

    #include the function for when the user was connected
    include_once "app/helpers/timeAgo.php";

    #store data for user and get it
    $user = getUser($_SESSION["username"], $con);

    #store data for all conversation and get it
    $conversations = getConversation($user["user_id"], $con);

    #store last seen and get it
    $timeago = lastSeen($user["last_seen"]);
    //print_r($timeago);
} else {

    header("Location: index.php");
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

    <title>Chat App - Home</title>
</head>

<body class="d-flex
            justify-content-center
            align-items-center
            vh-100">
    <div class="p-2 w-400 rounded shadow">
        <div>
            <div class="d-flex 
                        mb-3 p-3 bg-light
                        justify-content-between align-items-center">
                <div class="d-flex align-items-center
                        ">
                    <img src="upload/<?= $user["profile_p"]; ?>" class="w-25 rounded-circle">
                    <h3 class="fs-xs m-2"><?= $user["user_name"]; ?></h3>
                </div>
                <a href="logout.php" class="btn btn-dark">Logout</a>
            </div>

            <div class="input-group mb-3">
                <input type="text" placeholder="search...." id="searchText" class="form-control">
                <button class="btn btn-primary" id="searchBtn">
                    <i class="fa fa-search"></i>
                </button>
            </div>
            <!-- show all user -->
            <ul id="chatList" class="list-group mvh-50 overflow-auto">
                <?php if (!empty($conversations)) { ?>
                    <?php foreach ($conversations as $conversation) : ?>
                        <li class="list-group-item">
                            <a href="chat.php?user=<?= $conversation["user_name"]; ?>" class="d-flex justify-content-between
                              align-items-center p-2">
                                <div class="d-flex align-items-center">
                                    <img src="upload/<?= $conversation["profile_p"]; ?>" class="w-10  rounded-circle">
                                    <h3 class="fs-xs m-2"><?= $conversation["name"]; ?>
                                        <br>
                                        <small><?= lastChat($_SESSION["user_id"], $conversation["user_id"], $con); ?></small>
                                    </h3>
                                </div>
                                <?php if (lastSeen($conversation["last_seen"]) == "Active") { ?>
                                    <!--show user online -->
                                    <div title="online">
                                        <div class="online"></div>
                                    </div>
                                <?php } else { ?>
                                    <div class="d-flex align-items-center w-auto">
                                        <small class=""><?= lastSeen($conversation["last_seen"]); ?></small>
                                    </div>
                                <?php } ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php } else { ?>

                    <div class="alert alert-info text-center" role="alert">
                        <i class="fa fa-comments d-block fs-big"></i>
                        No messages yet, Start the conversation
                    </div>

                <?php } ?>
            </ul>
        </div>
    </div>

    <script src="js/jquery-3.5.1.min.js"></script>
    <script>
        $(document).ready(function() {
            /* auto update last seen for logged in user */
            let lastSeenUpdate = function() {
                $.get("app/ajax/updateLastSeen.php");
            };
            lastSeenUpdate();
            /* auto update last seen every 10 second **/
            setInterval(lastSeenUpdate, 10000);

            //serach text fast input, he the curent sentence in the input field
            $("#searchText").on("input", function() {
                let searchText = $(this).val();
                //console.log(searchText);
                if (searchText == "") return false;
                $.post("app/ajax/search.php", {
                        key: searchText
                    },
                    function(data, status) {
                        $("#chatList").html(data);
                    }
                );
            });

            //serach using button
            $("#searchBtn").on("click", function() {
                let searchText = $("#searchText").val();
                //console.log(searchText);
                if (searchText == "") return false;
                $.post("app/ajax/search.php", {
                        key: searchText
                    },
                    function(data, status) {
                        $("#chatList").html(data);
                    }
                );
            });
        })
    </script>
</body>

</html>