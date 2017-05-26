<?php

require_once '../src/lib.php';
require_once '../src/connection.php';
require_once '../src/User.php';
require_once '../src/Message.php';

session_start();

$user = loggedUser($connection);

if (isset($_SESSION['user'])) { ?>
    <!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>MessageSite</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-3 row1">
                <a href="createMessageSite.php" class="btn btn-primary btn-block">Napisz wiadomość</a>
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
            <a href="messageSite.php"><h1>Witaj na Twiterze!</h1></a>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?php
                $receive = Message::loadAllReceivedMessagesByUserId($connection, $_SESSION['user']);
                echo "<h3>Skrzynka odbiorcza:</h3>";
                foreach ($receive as $value) {
                    echo "Od " . $value['sender'] . "<br/>";
                    echo $value['text'] . "<br/>";
                    echo $value['date'] . "<br/>";
                    echo "<hr/>";
                }
                echo "</div>";
                echo "<div class='col-md-6'>";
                $receive = Message::loadAllSendMessagesByUserId($connection, $_SESSION['user']);
                echo "<h3>Skrzynka nadawcza:</h3>";
                foreach ($receive as $value) {
                    echo "Do " . $value['receiver'] . "<br/>";
                    echo $value['text'] . "<br/>";
                    echo $value['date']."<br/>";
                    echo "<hr/>";
                }
                ?>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    </body>
    </html>
    <?php
} else {
    header('Location: index.php');
}