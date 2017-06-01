<?php

require_once 'User.php';

function loggedUser($connection)
{
    if (isset($_SESSION['user'])) {
        return  User::loadUserById($connection, $_SESSION['user']);
    }

    return false;
}
