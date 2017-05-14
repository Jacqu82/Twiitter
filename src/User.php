<?php

class User
{
    private $id;
    private $username;
    private $email;
    private $password;


    public function __construct()
    {
        $this->id = -1;
        $this->username = '';
        $this->email = '';
        $this->password = '';
    }


    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }


    public function setHash($hash)
    {
        $this->password = $hash;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    public function getPassword()
    {
        return $this->password;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }


    public function saveToDB(mysqli $connection)
    {
        if ($this->id == -1) {
            $sql = /** @lang text */
                "INSERT INTO user(email, username, password) VALUES ('$this->email', '$this->username', '$this->password')";

            $result = $connection->query($sql);

            if ($result) {
                $this->id = $connection->insert_id;
                echo "Cieszymy się że tu jesteś, $this->username<br/>";
                echo '<a href="../web/loginForm.php">Zaloguj się na swoje konto</a>';
            } else {
                echo "Wystąpił błąd podczas rejestracji, spróbuj jeszcze raz!";
                die("Connection Error! " . $connection->connect_error);
            }
        } else {
            $sql = /** @lang text */
                "UPDATE user SET email = '$this->email',
                                    username = '$this->username',
                                    password = '$this->password' WHERE id = $this->id";

            $result = $connection->query($sql);
            if ($result) {
                return true;
            }
        }
        return false;
    }

    static public function loadUserById(mysqli $connection, $id)
    {
        $id = $connection->real_escape_string($id);

        $sql = /** @lang text */
            "SELECT * FROM `user` WHERE `id` = $id";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $user = new User();
            $user->setid($row['id']);
            $user->setEmail($row['email']);
            $user->setUsername($row['username']);
            $user->setHash($row['password']);

            return $user;
        }
        return null;
    }

    static public function loadUserByUsername(mysqli $connection, $username)
    {
        $username = $connection->real_escape_string($username);

        $sql = /** @lang text */
            "SELECT * FROM `user` WHERE `username` = '$username'";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $user = new User();

            $user->setId($row['id']);
            $user->setEmail($row['email']);
            $user->setUsername($row['username']);
            $user->setHash($row['password']);

            return $user;
        } else {
            return false;
        }
    }

    static public function loadUserByEmail(mysqli $connection, $email)
    {
        $email = $connection->real_escape_string($email);

        $sql = /** @lang text */
            "SELECT * FROM `user` WHERE `email` = '$email'";

        $result = $connection->query($sql);

        if ($result == true && $result->num_rows == 1) {
            $row = $result->fetch_assoc();

            $user = new User();

            $user->setId($row['id']);
            $user->setEmail($row['email']);
            $user->setUsername($row['username']);
            $user->setHash($row['password']);

            return $user;
        } else {
            return false;
        }
    }

    static public function loadAllUsers(mysqli $connection)
    {
        $sql = /** @lang text */
            "SELECT * FROM user";

        $ret = [];

        $result = $connection->query($sql);
        if ($result == true && $result->num_rows != 0) {
            foreach ($result as $row) {
                $user = new User();
                $user->id = $row['id'];
                $user->email = $row['email'];
                $user->username = $row['username'];
                $user->hash = $row['password'];

                $ret[] = $user;
            }
        }
        return $ret;

    }

    public function delete(mysqli $connection)
    {
        if ($this->id != -1) {
            $sql = /** @lang text */
                "DELETE FROM user WHERE id = $this->>id";
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

