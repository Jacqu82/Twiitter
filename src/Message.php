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

    public function setId($id)
    {
        $this->id = $id;
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


    public function _setMessageStatus($messageStatus)
    {
        $this->messageStatus = $messageStatus;
    }

    public function saveToDB(mysqli $connection)
    {
        if ($this->id == -1) {
            $sql = /** @lang text */
                "INSERT INTO message (senderId, receiverId, messageText, creationDate, messageStatus) 
                VALUES ('$this->senderId', '$this->receiverId','$this->messageText', '$this->creationDate', '$this->messageStatus')";

            $result = $connection->query($sql);

            if ($result) {
                $this->id = $connection->insert_id;
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

    public static function loadAllSendMessagesByUserId(mysqli $connection, $userId)
    {
        $sql = /** @lang text */
            "SELECT user.username,
            message.id,
            message.messageText as text,
            message.creationDate as date 
            FROM message 
            JOIN user ON message.receiverId = user.id 
            WHERE message.senderId = $userId 
            ORDER BY creationDate DESC";

        $result = $connection->query($sql);

        if ($result == false) {
            die("Connection Error" . $connection->error);
        }
        return $result;
    }

    public static function setMessageStatus(mysqli $connection, $messageId, $status)
    {
        $sql = /** @lang text */
            "UPDATE message SET messageStatus = '$status' WHERE id = $messageId";

        $result = $connection->query($sql);

        if ($result == false) {
            die("Connection Error" . $connection->error);
        }
        return true;
    }

    public static function loadAllReceivedMessagesByUserId(mysqli $connection, $userId)
    {
        $sql = /** @lang text */
            "SELECT user.username,
            message.id, 
            message.messageStatus as status,
            message.messageText as text,
            message.senderId as sender,
            message.creationDate as date 
            FROM message 
            JOIN user ON message.senderId = user.id 
            WHERE message.receiverId = $userId 
            ORDER BY creationDate DESC";

        $result = $connection->query($sql);

        if ($result == false) {
            die("Connection Error" . $connection->error);
        }
        return $result;
    }

    public static function loadLastSendMessageByUserId(mysqli $connection, $userId)
    {
        $sql = /** @lang text */
            "SELECT user.username,
            message.messageText as text,
            message.creationDate as date 
            FROM message 
            JOIN user ON message.receiverId = user.id 
            WHERE message.senderId = $userId 
            ORDER BY creationDate DESC LIMIT 1";

        $result = $connection->query($sql);

        if ($result == false) {
            die("Connection Error" . $connection->error);
        }
        return $result;
    }

    public static function loadMessageById(mysqli $connection, $id)
    {
        $id = $connection->real_escape_string($id);

        $sql = /** @lang text */
            "SELECT * FROM `message` WHERE `id` = $id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $message = new Message();
            $message->setId($row['id']);
            $message->setReceiverId($row['receiverId']);
            $message->setSenderId($row['senderId']);
            $message->setMessageText($row['messageText']);
            $message->setCreationDate();

            return $message;
        }
        return null;
    }


    public function deleteMessage(mysqli $connection)
    {
        if ($this->id != -1) {
            $sql = /** @lang text */
                "DELETE FROM message WHERE id = $this->id";
            $result = $connection->query($sql);
            if ($result) {
                $this->id = -1;
                return true;
            }
            return false;
        }
        return true;
    }
}
