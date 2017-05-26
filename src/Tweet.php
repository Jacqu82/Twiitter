<?php


class Tweet
{
    private $id;
    private $userId;
    private $tweetText;
    private $creationDate;

    public function __construct()
    {
        $this->id = -1;
        $this->userId = '';
        $this->tweetText = '';
        $this->creationDate = '';
    }


    public function getId()
    {
        return $this->id;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
    }


    public function getTweetText()
    {
        return $this->tweetText;
    }

    public function setTweetText($tweetText)
    {
        $this->tweetText = $tweetText;
    }

    public function getCreationDate()
    {
        return $this->creationDate;
    }

    public function setCreationDate()
    {
        $this->creationDate = date('Y-m-d H:i:s');
        return $this;
    }


    static public function loadTweetById(mysqli $connection, $id)
    {
        $sql = /** @lang text */
            "SELECT * FROM tweet WHERE id = $id";
        $result = $connection->query($sql);
        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $tweet = new Tweet();
            $tweet->id = $row['id'];
            $tweet->userId = $row['userId'];
            $tweet->tweetText = $row['tweetText'];
            $tweet->creationDate = $row['creationDate'];

            return $tweet;
        }
        return null;
    }

    static public function loadAllTweets(mysqli $connection)
    {
        $sql = /** @lang text */
            "SELECT tweet.id as id, user.username as username,tweet.tweetText as text,tweet.creationDate as date FROM tweet JOIN user ON tweet.userId = user.id ORDER BY creationDate DESC";

        $result = $connection->query($sql);

        if ($result == false) {
            die("Connection Error" . $connection->error);
        }
        return $result;
    }

    static public function loadTweetByUserId(mysqli $connection, $userId)
    {
        $sql = /** @lang text */
            "SELECT tweet.id as id,tweet.tweetText as text,tweet.creationDate as date FROM tweet JOIN user ON tweet.userId = user.id WHERE tweet.userId = $userId ORDER BY creationDate DESC";

        $result = $connection->query($sql);

        if ($result == false) {
            die("Connection Error" . $connection->error);
        }
        return $result;
    }

    public function saveToDB(mysqli $connection)
    {
        if ($this->id == -1) {
            $sql = /** @lang text */
                "INSERT INTO tweet (userId, tweetText, creationDate) VALUES ('$this->userId', '$this->tweetText','$this->creationDate')";

            $result = $connection->query($sql);

            if ($result) {
                $this->id = $connection->insert_id;
            } else {
                die("Tweet not saved! " . $connection->connect_error);
            }
        } else {
            $sql = /** @lang text */
                "UPDATE tweet SET tweetText = '$this->tweetText', creationDate = '$this->creationDate' WHERE id = $this->id";

            $result = $connection->query($sql);
            if ($result) {
                return true;
            }
        }
        return false;
    }
}
