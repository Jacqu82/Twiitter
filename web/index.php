<?php

require_once '../src/lib.php';
require_once '../src/connection.php';
require_once '../src/User.php';

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
<h1>Witaj na Twiterze!</h1>
<p>
    <a href="loginForm.php">Zaloguj się na swoje konto</a>
</p>
<p>
    <a href="registerForm.php">Utwórz nowe konto</a>
</p>
</body>
</html>
