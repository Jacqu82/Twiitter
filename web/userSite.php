<?php

require_once '../src/lib.php';
require_once '../src/connection.php';
require_once '../src/User.php';
require_once '../src/Tweet.php';
require_once '../src/Comment.php';

session_start();

$user = loggedUser($connection);

if (isset($_SESSION['user'])) {
    ?>

    <!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>User Site</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
    <div class="container">
        <div class="col-md-12">
            <div class="col-md-2 col-sm-3 col-xs-3 row1">
                <a href="messageSite.php" class="btn btn-primary btn-block">Wiadomości</a>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-3 row1">
                <a href="mainPage.php" class="btn btn-primary btn-block">Strona główna</a>
            </div>
            <div class="col-md-4 col-sm-3 col-xs-3 row1">
                <?php if ($user) {
                    echo "<span style='font-size: 23px;'>Jesteś zalogowany jako: " . $user->getUsername() . "</span>";
                } ?>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-3 row1">
                <a href="editUserProfile.php" class="btn btn-primary btn-block">Edytuj profil</a>
            </div>
            <div class="col-md-2 col-sm-3 col-xs-3 row1">
                <a href='logout.php' class="btn btn-success btn-block">Wyloguj się</a>
            </div>
        </div>
        <br/><br/>
        <div class="row">
            <a href="userSite.php"><h1>Witaj na Twiterze!</h1></a>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-4 col-md-offset-3">
                <h3>Wszystkie twoje tweety:</h3>

                <?php

                $myTweets = Tweet::loadTweetByUserId($connection, $_SESSION['user']);
                foreach ($myTweets as $row) {
                    echo "<p>" . $row['text'] . "<br/>";
                    echo $row['date'] . "</p>";
                    $myComments = Comment::loadAllCommentsByTweetId($connection, $row['id']);
                    foreach ($myComments as $rows) {
                        echo "<p style='color:green'>W dniu " . $rows['date'] . " użytkownik " . $rows['username'] . " skomentował twojego tweeta: <br/>";
                        echo $rows['text'] . "</p>";
                    }
                    echo "<hr/>";
                } ?>
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
