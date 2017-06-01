<?php

require_once '../src/lib.php';
require_once '../src/connection.php';
require_once '../src/User.php';
require_once '../src/Tweet.php';
require_once '../src/Comment.php';

session_start();

$user = loggedUser($connection);

if (isset($_SESSION['user'])) { ?>
    <!DOCTYPE html>
    <html lang="pl">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Index</title>
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
            <a href="mainPage.php"><h1>Witaj na Twiterze!</h1></a>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-4 col-md-offset-3">
                <form action="" method="POST">
                    <h3>Napisz tweeta: </h3>
                    <textarea name="tweetText" cols="64" rows="5" placeholder="Napisz tweeta"
                              maxlength="140"></textarea><br/>
                    <button class='btn btn-primary' type ='submit'>Tweetnij</button>
                </form>
                <hr/>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-4 col-md-offset-3">

                <?php

                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['tweetText'])) {
                        $tweetText = $_POST['tweetText'];
                        if (strlen($_POST['tweetText']) > 140) {
                            echo "Tweet może mieć maksymalnie 140 znaków!";
                        } else {
                            $newTweet = new Tweet();
                            $newTweet->setUserId($_SESSION['user']);
                            $newTweet->setTweetText($tweetText);
                            $newTweet->setCreationDate();
                            $newTweet->saveToDB($connection);
                        }
                    }
                }

                $myTweets = Tweet::loadAllTweets($connection);
                foreach ($myTweets as $row) {
                    echo "W dniu " . $row['date'] . " użytkownik " . $row['username'] . " napisał: <br/>";
                    echo $row['text'] . "<br/>";
                    echo "<form action='' method='POST'>";
                        echo "<div class='toggle-comment-form'>";
                        echo "<span class='toggle'>Pokaż / ukryj</span>";
                        echo "<textarea class='commentText' name='commentText' cols='64' rows='2' placeholder='Dodaj swój komentarz' maxlength='60'></textarea><br/>";
                        echo "<button class='btn btn-primary' type ='submit'>Dodaj komentarz</button>";
                    echo "</div>";
                    echo "<input type='hidden' name='tweetId' value='" . $row['id'] . "'/>";
                    echo "</form>";
                    $myComments = Comment::loadAllCommentsByTweetId($connection, $row['id']);
                    foreach ($myComments as $rows) {
                        echo "<p style='color:green'>W dniu " . $rows['date'] . " użytkownik " . $rows['username'] . " skomentował tego tweeta: <br/>";
                        echo $rows['text'] . "</p>";
                    }
                    echo "<hr/>";
                }


                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    if (isset($_POST['commentText']) && isset($_POST['tweetId'])) {
                        $commentText = $_POST['commentText'];
                        $tweetId = $_POST['tweetId'];
                        if (strlen($_POST['commentText']) > 60) {
                            echo "Komentarz może mieć maksymalnie 60 znaków!";
                        } else {
                            $newComment = new Comment();
                            $newComment->setUserId($_SESSION['user']);
                            $newComment->setTweetId($tweetId);
                            $newComment->setCommentText($commentText);
                            $newComment->setCreationDate();
                            $newComment->saveToDB($connection);
                        }
                    }
                }
                $connection->close(); ?>
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
    <?php
} else {
    header('Location: index.php');
}
