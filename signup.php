<?php
session_start();
if (isset($_SESSION["username"])) {
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo.png">
    <title>Chat PHP Sign Up</title>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="w-400 p-5 rounded shadow">
        <form method="post" action="app/http/signup.php" enctype="multipart/form-data">

            <div class="d-flex 
                        justify-content-center
                        align-items-center 
                        flex-column">
                <img src="img/logo.png" class="w-25">
                <h3 class="display-4 fs-1 text-center">
                    Sign Up
                </h3>
            </div>
            <?php if (isset($_GET['error'])) : ?>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <?= htmlspecialchars($_GET["error"]); ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>

            <?php
            if (isset($_GET["name"])) {
                $name = $_GET["name"];
            } else {
                $name = "";
            }
            if (isset($_GET["username"])) {
                $username = $_GET["username"];
            } else {
                $username = "";
            }
            ?>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" value="<?= $name; ?>">
            </div>

            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" class="form-control" name="username" value="<?= $username; ?>">
            </div>

            <div class="form-group">
                <label for="pw">Password</label>
                <input type="password" class="form-control" name="pw">
            </div>

            <div class="form-group">
                <label for="profile">Profile Picture</label>
                <input type="file" class="form-control-file" name="profile">
            </div>

            <button type="submit" class="btn btn-primary">Sign Up</button>

            <a href="index.php">LOGIN</a>
        </form>
    </div>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>