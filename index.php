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
    <title>Chat PHP LOGIN</title>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="w-400 p-5 rounded shadow">
        <form method="post" action="app/http/auth.php">

            <div class="d-flex 
                        justify-content-center
                        align-items-center 
                        flex-column">
                <img src="img/logo.png" class="w-25">
                <h3 class="display-4 fs-1 text-center">
                    LOGIN
                </h3>

                <!-- message alert -->
                <?php if (isset($_GET['error'])) : ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($_GET["error"]); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_GET['success'])) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= htmlspecialchars($_GET["success"]); ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php endif; ?>
            </div>

            <div class="form-group">
                <label for="username">User Name</label>
                <input type="text" class="form-control" name="username">
            </div>

            <div class="form-group">
                <label for="pw">Password</label>
                <input type="password" class="form-control" name="pw">
            </div>

            <button type="submit" class="btn btn-primary">LOGIN</button>

            <a href="signup.php">Sign Up</a>
        </form>
    </div>
    <script src="js/jquery-3.5.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>

</html>