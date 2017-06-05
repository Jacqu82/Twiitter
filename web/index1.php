<?php

require_once '../src/lib.php';
require_once '../src/connection.php';
require_once '../src/User.php';

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
<h1>Witaj na Twiterze!</h1>
<div class="container">
    <h3><a href="loginForm.php" class="btn btn-primary">Zaloguj się na swoje konto</a></h3>

    <h3><a href="registerForm.php" class="btn btn-primary">Utwórz nowe konto</a></h3>
    <div class="col-xs-10 col-md-6 col-xs-offset-2 col-md-offset-3 user-row">
        <div class="flash-message alert alert-success alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <strong>Twoje konto zostało pomyślnie usunięte!</strong>
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
