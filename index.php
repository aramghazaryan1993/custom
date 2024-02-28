<?php

session_start();

require_once 'db.php';
require_once 'controller/UserController.php';


  $userModel = new UserModel($conn);
  $userController = new UserController($userModel);

  $action = $_GET['action'] ?? null;

 switch ($action) {
    case 'register':
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $name     = $_POST['name'] ?? null;

        if ($username && $password && $name) {
            $userController->registerUser($username, $password,$name);
        } else {
            echo "Username and password are required";
        }
        break;

    case 'login':
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        if ($username && $password) {
            $userController->loginUser($username, $password);
        } else {
            echo "Username and password are required";
        }
        break;

    case 'add':
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $name     = $_POST['name'] ?? null;
        $age      = $_POST['age'] ?? null;
        $address  = $_POST['address'] ?? null;
        $phone    = $_POST['phone'] ?? null;

        if ($username && $password && $name) {
           echo $userController->addData($username, $password, $name,$age,$address,$phone);
        } else {
            echo "Username, password, and name are required";
        }
        break;

    case 'edit':
        $username = $_POST['username'] ?? null;
        $password = $_POST['password'] ?? null;
        $name     = $_POST['name'] ?? null;
        $age      = $_POST['age'] ?? null;
        $address  = $_POST['address'] ?? null;
        $phone    = $_POST['phone'] ?? null;
        $id    = $_POST['id'] ?? null;

        if ($username && $name) {
            echo $userController->editData($username, $password, $name,$age,$address,$phone, $id);
        } else {
            echo "Username, password, and name are required";
        }
        break;

    case 'delete':
        $id = $_POST['id'] ?? null;
        $userController->deleteData($id);
        if ($userController) {
            echo "success";
        } else {
            echo "error";
        }
        break;
}




