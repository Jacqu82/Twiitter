<?php

require_once '../src/lib.php';
require_once '../src/connection.php';
require_once '../src/User.php';

session_start();

$user = loggedUser($connection);

if (isset($_SESSION['user'])) {
} else {
    header('Location: book.php');
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit User Profile</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-2 col-sm-3 col-xs-3 row1">
            <a href="messageSite.php" class="btn btn-primary btn-block">Wiadomości</a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-3 row1">
            <a href="userSite.php" class="btn btn-primary btn-block">Twoja strona</a>
        </div>
        <?php if ($user) {
            echo "<span style='font-size: 25px;'>Jesteś zalogowany jako: " . $user->getUsername() . "</span>";
        } ?>
        <div class="col-md-2 col-sm-3 col-xs-3 col-md-push-6 row1">
            <a href='logout.php' class="btn btn-success btn-block">Wyloguj się</a>
        </div>
    </div>
    <div class="row">
        <a href="editUserProfile.php"><h1>Witaj na Twiterze!</h1></a>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal" action="#" method="POST">
                <div class="form-group">
                    <label for="nameField" class="col-xs-2">Edytuj nick</label>
                    <div class="col-xs-10">
                        <input type="text" class="form-control" id="nameField" name="'nick"
                               placeholder="Edytuj swój nick"/>
                    </div>
                </div>
                <div class="col-xs-10 col-xs-offset-2">
                    <button type="submit" class="btn btn-primary">Wyślij</button>
                    <button type="reset" class="btn btn-default">Wyczyść</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-md-offset-3">
            <form class="form-horizontal" action="#" method="POST">
                <div class="form-group">
                    <label for="nameField" class="col-xs-2">Edytuj hasło</label>
                    <div class="col-xs-10">
                        <input type="text" class="form-control" id="nameField" name="password"
                               placeholder="Edytuj swoje hasło"/>
                    </div>
                </div>
                <div class="col-xs-10 col-xs-offset-2">
                    <button type="submit" class="btn btn-primary">Wyślij</button>
                    <button type="reset" class="btn btn-default">Wyczyść</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script src="../js/bootstrap.js"></script>
</body>
</html>