<?php

require_once '../src/lib.php';
require_once '../src/connection.php';
require_once '../src/User.php';
require_once '../src/Message.php';

session_start();

$user = loggedUser($connection);

if (isset($_SESSION['user'])) { ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['set_message_as_read']) && isset($_POST['message_id'])) {
            $id = $_POST['message_id'];
            Message::setMessageStatus($connection, $id, 1);
        } else if (isset($_POST['set_message_as_unread']) && isset($_POST['message_id'])) {
            $id = $_POST['message_id'];
            Message::setMessageStatus($connection, $id, 0);
        }
    }

    ?>
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
                foreach ($receive as $row) {
                    echo "Od " . $row['username'] . "<br/>";
                    if ($row['status'] == 0) {
                        echo "<form method='POST'>";
                        echo "<b>" . $row['text'] . "<br/>" . $row['date'] . "</b><br/>
                            <input type='submit'  name='set_message_as_read' value='Oznacz jako przeczytaną' class='btn btn-success' />
                            <input type='hidden' name='message_id' value='" . $row['id'] . " '>
                        </form>";
                    } else {
                        echo "<form method='POST'>";
                        echo $row['text'] . "<br/>" . $row['date'] . "<br/>
                            <input type='submit'  name='set_message_as_unread' value='Oznacz jako nie przeczytaną' class='btn btn-success' />
                            <input type='hidden' name='message_id' value='" . $row['id'] . " '>
                        </form>";
                    }
                    echo "<hr/>";
                }
                echo "</div>";
                echo "<div class='col-md-6'>";
                $send = Message::loadAllSendMessagesByUserId($connection, $_SESSION['user']);
                echo "<h3>Skrzynka nadawcza:</h3>";
                foreach ($send as $value) {
                    echo "Do " . $value['username'] . "<br/>";
                    echo $value['text'] . "<br/>";
                    echo $value['date'] . "<br/>";
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