<?php
session_start();

#chek if the user is logged in
if (isset($_SESSION["username"])) {
    #check if the key is submitted
    if (isset($_POST["key"])) {
        #database connection file
        require_once "../../db/db.php";
        $db = new DB();
        $con = $db->connect();

        #search a username in the sentences
        $key = "%{$_POST['key']}%";

        #get the id from the user who is logged now
        $query = $con->prepare("SELECT * FROM `users`
                 WHERE `user_name` 
                 LIKE ? OR `name` LIKE ? ");
        $query->execute([$key, $key]);
        $count = $query->rowCount();

        if ($count > 0) {
            $users = $query->fetchAll();
            foreach ($users as $user) {
                if($user['user_id'] == $_SESSION["user_id"]) continue;
          
?>
                <li class="list-group-item">
                    <a href="chat.php?user=<?= $user["user_name"]; ?>" class="d-flex justify-content-between
                              align-items-center p-2">
                        <div class="d-flex align-items-center">
                            <img src="upload/<?= $user["profile_p"]; ?>" class="w-10  rounded-circle">
                            <h3 class="fs-xs m-2"><?= $user["user_name"]; ?></h3>
                        </div>
                    </a>
                </li>
            <?php } ?>
        <?php
        } else { ?>
            <div class="alert alert-info text-center" role="alert">
                <i class="fa fa-comments d-block fs-big"></i>
                The User "<?= htmlspecialchars($_POST['key']); ?>"
                Is not Found.
            </div>
<?php }
    }
} else {
    header("Location: ../../index.php");
    exit();
}
