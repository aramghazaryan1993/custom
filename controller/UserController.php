<?php

if($_SERVER['REQUEST_URI'] == '/view/dashboard.php'){
include '../model/UserModel.php';
}else{
    include 'model/UserModel.php';
}

class UserController {
    private $userModel;

    public function __construct($userModel) {
        $this->userModel = $userModel;
    }

    public function registerUser($username, $password, $name) {
        $result = $this->userModel->createUser($username, $password, $name);
        if ($result) {
            header("Location: login.php");
        } else {
            echo "Error registering user";
        }
    }

    public function loginUser($username, $password) {
        $user = $this->userModel->getUserByUsername($username);
        if ($user && password_verify($password, $user['password'])) {

             $_SESSION['username'] = $username; // Set session variable
               header("Location: dashboard.php");
               exit();
            // Proceed with user authentication
        } else {
            echo "Invalid username or password";
        }
    }

    public function getData()
    {
       return $this->userModel->getData();
    }

    public function deleteData($id)
    {
       return  $this->userModel->deleteData($id);
    }

    public function addData($username, $password, $name, $age, $address, $phone)
    {
        return  $this->userModel->addData($username, $password, $name, $age, $address, $phone);
    }

    public function editData($username, $password, $name,$age,$address,$phone, $id)
    {
        return  $this->userModel->editData($username, $password, $name, $age, $address, $phone, $id);
    }
}
