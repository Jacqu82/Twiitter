<?php


class Message
{
    private $id;
    private $senderId;
    private $receiverId;
    private $messageText;
    private $creationDate;
    private $messageStatus;


    public function __construct()
    {
        $this->id = -1;
        $this->senderId = '';
        $this->receiverId = '';
        $this->messageText = '';
        $this->creationDate = '';
        $this->messageStatus = 0;
    }

    public function getId()
    {
        return $this->id;
    }


    public function getSenderId()
    {
        return $this->senderId;
    }


    public function setSenderId($senderId)
    {
        $this->senderId = $senderId;
    }


    public function getReceiverId()
    {
        return $this->receiverId;
    }


    public function setReceiverId($receiverId)
    {
        $this->receiverId = $receiverId;
    }


    public function getMessageText()
    {
        return $this->messageText;
    }


    public function setMessageText($messageText)
    {
        $this->messageText = $messageText;
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


    public function getMessageStatus()
    {
        return $this->messageStatus;
    }


    public function setMessageStatus($messageStatus)
    {
        $this->messageStatus = $messageStatus;
    }

    public function saveToDB(mysqli $connection)
    {
        if ($this->id == -1) {
            $sql = /** @lang text */
                "INSERT INTO message (senderId, receiverId, messageText, creationDate, messageStatus) VALUES ('$this->senderId', '$this->receiverId','$this->messageText', '$this->creationDate', '$this->messageStatus')";

            $result = $connection->query($sql);

            if ($result) {
                $this->id = $connection->insert_id;
                echo "Wysłałeś wiadomość";
            } else {
                die("Connection Error" . $connection->connect_error);
            }
        } else {
            $sql = /** @lang text */
                "UPDATE message SET messageStatus = '$this->messageStatus' WHERE id = $this->id";

            $result = $connection->query($sql);
            if ($result) {
                return true;
            }
        }
        return false;
    }


}