<?php

require_once 'User.php';
require_once 'Tweet.php';

function loggedUser($connection)
{
    if (isset($_SESSION['user'])) {
        return  User::loadUserById($connection, $_SESSION['user']);
    }

    return false;
}

//function tweetId($connection)
//{
//    if (isset($_SESSION['tweet'])) {
//        return Tweet::loadTweetById($connection, $_SESSION['tweetId']);
//    }
//    return false;
//}
