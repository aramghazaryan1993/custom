<?php

class UserModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function createUser($username, $password,$name) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (username, password, name) VALUES ('$username', '$hashedPassword', '$name')";
        return $this->conn->query($sql);
    }

    public function getUserByUsername($username) {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $this->conn->query($sql);
        return $result->fetch_assoc();
    }

    public function getData() {

        $sql = "SELECT * FROM users
                JOIN user_info ON users.id = user_info.user_id";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            // Fetch data as an associative array
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            return $data;
        } else {
            return false;
        }

    }

    public function deleteData($id)
    {
        $sqlDeleteUser = "DELETE FROM users WHERE id = $id";
        return $this->conn->query($sqlDeleteUser);
    }

    public function addData($username, $password, $name, $age, $address, $phone)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, password, name) VALUES ('$username', '$hashedPassword', '$name')";

        if ( $this->conn->query($sql) === TRUE) {
            // Retrieve the inserted data
            $insertedId =  $this->conn->insert_id; // Get the ID of the last inserted row

            $sql2 = "INSERT INTO user_info (age, address, phone, user_id ) VALUES ('$age', '$address', '$address', '$insertedId')";
            $this->conn->query($sql2);

            $sql = "SELECT * FROM users
                JOIN user_info ON users.id = user_info.user_id WHERE users.id = $insertedId";
            $result =  $this->conn->query($sql);

            if ($result->num_rows > 0) {

                 $insertedData = $result->fetch_assoc();

                echo json_encode($insertedData);
            } else {
                echo "No data found";
            }
        } else {
            echo "Error: " . $sql . "<br>" .  $this->conn->error;
        }
    }

    public function editData($username, $password, $name,$age,$address,$phone,$id)
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sqlUsers = "UPDATE users SET name='$name', username='$username', password='$hashedPassword' WHERE id=$id";
        $sqlUserInfo = "UPDATE user_info SET address='$address', phone='$phone', age='$age' WHERE user_id='$id'";

        if ( $this->conn->query($sqlUsers) === TRUE && $this->conn->query($sqlUserInfo) === TRUE) {

            $sql = "SELECT * FROM users
                JOIN user_info ON users.id = user_info.user_id WHERE users.id = $id";
            $result =  $this->conn->query($sql);

            if ($result->num_rows > 0) {

                $insertedData = $result->fetch_assoc();

                echo json_encode($insertedData);
            } else {
                echo "No data found";
            }
        } else {
            echo "Error: " . $sqlUsers . "<br>" .  $this->conn->error;
        }
    }


}
