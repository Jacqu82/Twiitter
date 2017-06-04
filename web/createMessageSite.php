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
        <title>Index</title>
        <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
        <link rel="stylesheet" href="../css/style.css">
    </head>
    <body>
    <div class="container">
        <div class="row">
            <div class="col-md-2 col-sm-3 col-xs-3 row1">
                <a href="messageSite.php" class="btn btn-primary btn-block">Twoje wiadomości</a>
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
            <a href="createMessageSite.php"><h1>Witaj na Twiterze!</h1></a>
        </div>
        <div class="row">
            <div class="col-md-6 col-sm-6 col-xs-4 col-md-offset-3">
                <form action="" method="POST">
                    <h3>Napisz wiadomość: </h3>
                    <?php
                    $user = User::loadAllUsersExcerptMe($connection, $_SESSION['user']);
                    //var_dump($user);
                    echo "Wybierz użytkownika: <br/>";
                    echo "<select name='receiverId'>";
                    foreach ($user as $value) {
                        echo "<option value='".$value['id']."'>".$value['username']."</option><br/>";
                    }
                    echo "</select>";
                    ?>
                    <textarea name="messageText" cols="64" rows="5" placeholder="Napisz wiadomość"
                              maxlength="140"></textarea><br/>
                    <button class='btn btn-primary' type ='submit'>Wyślij</button>
                </form>
            </div>
        </div>
        <div class="col-xs-10 col-md-6 col-xs-offset-2 col-md-offset-3 user-row">
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['receiverId']) && isset($_POST['messageText'])) {
                $receiverId = $_POST['receiverId'];
                $messageText = $_POST['messageText'];

                $message = new Message();
                $message->setSenderId($_SESSION['user']);
                $message->setReceiverId($receiverId);
                $message->setMessageText($messageText);
                $message->setCreationDate();
                $message->setMessageStatus($connection, $message->getId(), 0);
                $message->saveToDB($connection);
                $send = Message::loadLastSendMessageByUserId($connection, $_SESSION['user']);
                foreach ($send as $value) {
                    echo '<div class="flash-message alert alert-success alert-dismissible" role="alert">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <strong>Wysłałeś wiadomość do '. $value["username"] . '</strong>
                    </div>';
                }
            }
        }
        $connection->close();
        ?>
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