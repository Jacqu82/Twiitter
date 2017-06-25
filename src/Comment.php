<?php


class Comment
{
    private $id;
    private $userId;
    private $tweetId;
    private $commentText;
    private $creationDate;


    public function __construct()
    {
        $this->id = -1;
        $this->userId = '';
        $this->tweetId = '';
        $this->commentText = '';
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

    public function getTweetId()
    {
        return $this->tweetId;
    }

    public function setTweetId($tweetId)
    {
        $this->tweetId = $tweetId;
    }

    public function getCommentText()
    {
        return $this->commentText;
    }

    public function setCommentText($commentText)
    {
        $this->commentText = $commentText;
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

    public function saveToDB(mysqli $connection)
    {
        if ($this->id == -1) {
            $sql = /** @lang text */
                "INSERT INTO comment (userId, tweetId, commentText, creationDate) VALUES ('$this->userId', $this->tweetId,'$this->commentText', '$this->creationDate')";

            $result = $connection->query($sql);

            if ($result) {
                $this->id = $connection->insert_id;
            } else {
                die("Connection Error" . $connection->connect_error);
            }
        } else {
            $sql = /** @lang text */
                "UPDATE comment SET commentText = '$this->commentText', creationDate = '$this->creationDate' WHERE id = $this->id";

            $result = $connection->query($sql);
            if ($result) {
                return true;
            }
        }
        return false;
    }

    public static function loadAllCommentsByTweetId(mysqli $connection, $tweetId)
    {
        $sql = /** @lang text */
            "SELECT user.username as username,comment.commentText as text,comment.creationDate as date, user.id FROM comment JOIN user ON userId=user.id WHERE comment.tweetId=" . $tweetId . " ORDER BY creationDate DESC";

        $result = $connection->query($sql);

        if ($result == false) {
            die("Connection Error" . $connection->error);
        }
        return $result;
    }

    public static function loadAllComments(mysqli $connection)
    {
        $sql = /** @lang text */
            "SELECT user.username as username,comment.id as id,comment.commentText as text,comment.creationDate as date FROM comment JOIN user ON userId=user.id JOIN tweet ON comment.tweetId = tweet.id ORDER BY date DESC";

        $result = $connection->query($sql);

        if ($result == false) {
            die("Connection Error" . $connection->error);
        }
        return $result;
    }
}