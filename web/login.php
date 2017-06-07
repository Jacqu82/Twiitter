<?php

require_once '../src/connection.php';
require_once '../src/User.php';

session_start();

if ('POST' === $_SERVER['REQUEST_METHOD']) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $user = User::loadUserByUsername($connection, $username);

        if (false === $user) {
            echo '<p style="color: red">Niepoprawny login lub hasło!</p>';
            echo '<a href="loginForm.php">Zaloguj się ponownie</a>';
            exit;
        }

        if (password_verify($password, $user->getPassword())) {
            $_SESSION['user'] = $user->getId();
        } else {
            echo '<p style="color: red">Niepoprawny login lub hasło!</p>';
            echo '<a href="loginForm.php">Zaloguj się ponownie</a>';
            exit;
        }
    }
}

header('Location: mainPage.php');
