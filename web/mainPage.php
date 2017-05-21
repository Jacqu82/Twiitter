<?php

require_once '../src/lib.php';
require_once '../src/connection.php';
require_once '../src/User.php';
require_once '../src/Tweet.php';
require_once '../src/Comment.php';

session_start();

$user = loggedUser($connection);

?>
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
    <div id="footer">
        <div id="message"><a href="../src/Message.php">Wiadomości</a> |</div>
        <div id="user">| <a href="userSite.php">Twoja strona</a></div>
        <div id="login"><?php if ($user) { ?><span id="logged">Jesteś zalogowany
                jako: <?php echo $user->getUsername() ?></span>
                <a href='logout.php'>Wyloguj się</a> <?php } ?> </div>
    </div>
    <h1>Witaj na Twitterze!</h1>
    <div class="container">
    <form action="" method="POST">
        <h2>Napisz tweeta: </h2>
        <textarea name="tweetText" cols="64" rows="5" placeholder="Napisz tweeta" maxlength="140"></textarea><br/>
        <input type="submit" value="Tweetnij"/><hr/>
    </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"
            integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
            crossorigin="anonymous"></script>
    <script src="../js/bootstrap.js"></script>
    </body>
    </html>

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
            //$newTweet->saveToDB($connection);
        }
    }
}

$myTweets = Tweet::loadAllTweets($connection);
foreach ($myTweets as $row) {
    //var_dump($row['id']);
    //echo "Id tweeta ".$row['id']."<br/>";
    echo "<div class='container'>";
    echo "W dniu ".$row['date']." użytkownik ".$row['username']." napisał: <br/>";
    echo $row['text'] . "<br/>";
    echo "<form action='' method='POST'>";
    echo "<textarea name='commentText' cols='64' rows='2' placeholder='Dodaj swój komentarz' maxlength='60'></textarea><br/>";
    echo "<input type='submit' value='Dodaj komentarz'/>";
    echo "<input type='hidden' name='tweetId' value='".$row['id']."'/>";
    echo "</form>";
    echo "</div>";
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



$connection->close();

//$myTweets = Tweet::loadLastTweetByUserId($connection, $_SESSION['user']);
//foreach ($myTweets as $row) {
//    echo $row['text'] . "<br/>";
//    echo $row['date'] . "<br/>";
//}

