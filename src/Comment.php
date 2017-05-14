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
                echo "Dodałeś komentarz";
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

}