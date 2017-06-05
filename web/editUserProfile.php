<?php

require_once '../src/lib.php';
require_once '../src/connection.php';
require_once '../src/User.php';

session_start();

$user = loggedUser($connection);

if (isset($_SESSION['user'])) {
    $message = false;
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['nick'])) {
            $nick = $_POST['nick'];

            if (strlen($nick) > 0) {
                $u = User::loadUserById($connection, $_SESSION['user']);
                $u->setUsername($nick);
                $u->saveToDB($connection);
                $message = "Nazwa użytkownika została zmieniona na: $nick";
            }
        }

        if (isset($_POST['password'])) {
            $password = $_POST['password'];

            if (strlen($password) > 0) {
                $pass = User::loadUserById($connection, $_SESSION['user']);
                $pass->setPassword($password);
                $pass->saveToDB($connection);
                $message = "Hasło zostało zmienione";
            }
        }

        if (isset($_POST['delete_account'])) {
            $u = User::loadUserById($connection, $_SESSION['user']);
            if ($u->delete($connection)) {
                if (isset($_SESSION['user'])) {
                    unset($_SESSION['user']);
                }
                header('Location: index1.php');
            }
        }
    }
} else {
    header('Location: index.php');
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
        <div class="col-md-2 col-sm-3 col-xs-5">
            <a href="messageSite.php" class="btn btn-primary btn-block">Wiadomości</a>
        </div>
        <div class="col-md-2 col-sm-3 col-xs-5">
            <a href="userSite.php" class="btn btn-primary btn-block">Twoja strona</a>
        </div>
        <?php if ($user) {
            echo "<span style='font-size: 22px;'>Jesteś zalogowany jako: " . $user->getUsername() . "</span>";
        } ?>
        <div class="col-md-2 col-sm-3 col-xs-5 col-md-push-6">
            <a href='logout.php' class="btn btn-success btn-block">Wyloguj się</a>
        </div>
    </div>
    <div class="row">
        <a href="editUserProfile.php"><h1>Witaj na Twiterze!</h1></a>
    </div>
    <div class="row">
        <div class="col-md-6 col-md-offset-3 user-row">
            <form class="form-horizontal" method="POST">
                <div class="form-group">
                    <label for="nameField" class="col-xs-2">Edytuj nick</label>
                    <div class="col-xs-10">
                        <input type="text" class="form-control" id="nameField" name="nick"
                               placeholder="Edytuj swój nick"/>
                    </div>
                </div>
                <div class="col-xs-10 col-xs-offset-2">
                    <button type="submit" class="btn btn-primary">Wyślij</button>
                    <button type="reset" class="btn btn-default">Wyczyść</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-md-offset-3 user-row">
            <form class="form-horizontal" method="POST">
                <div class="form-group">
                    <label for="nameField" class="col-xs-2">Edytuj hasło</label>
                    <div class="col-xs-10">
                        <input type="password" class="form-control" id="nameField" name="password"
                               placeholder="Edytuj swoje hasło"/>
                    </div>
                </div>
                <div class="col-xs-10 col-xs-offset-2">
                    <button type="submit" class="btn btn-primary">Wyślij</button>
                    <button type="reset" class="btn btn-default">Wyczyść</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 col-md-offset-3 user-row">
            <form class="form-horizontal" method="POST">
                <div class="col-xs-10 col-xs-offset-2">
                    <input type="submit" class="btn btn-danger" name="delete_account" value="Usuń konto"/>
                </div>
            </form>
        </div>

        <div class="col-xs-10 col-md-6 col-xs-offset-2 col-md-offset-3 user-row">
            <?php
            if ($message) {
                echo '<div class="flash-message alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>' . $message . '</strong>
                    </div>';
            }
            ?>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>
<script src="../js/bootstrap.js"></script>
<script src="../js/main.js"></script>
</body>
</html>