<?php

require_once '../src/lib.php';
require_once '../src/connection.php';
require_once '../src/User.php';
require_once '../src/Tweet.php';

session_start();

$user = loggedUser($connection);

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div id="footer">
    <div id="message"><a href="../src/Message.php">Wiadomości</a> |</div>
    <div id="user">| <a href="mainPage.php">Strona główna</a></div>
    <div id="login"><?php if ($user) { ?><span id="logged">Jesteś zalogowany
            jako: <?php echo $user->getUsername() ?></span>
            <a href='logout.php'>Wyloguj się</a> <?php } ?> </div>
</div>
<h1>Witaj na Twitterze!</h1>

<h3>Wszystkie twoje tweety:</h3>

<?php

$myTweets = Tweet::loadTweetByUserId($connection, $_SESSION['user']);
foreach ($myTweets as $row) {
    echo $row['text'] . "<br/>";
    echo $row['date'] . "<br/>";
}
