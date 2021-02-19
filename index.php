<?php

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/UserController.php';

switch ($_REQUEST['entity']) {
    case 'user':
        $userController = new UserController();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $userController->getUsers($_POST['id']);
            }
            $userController->getUsers();

        }
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            var_dump($_REQUEST);
//            var_dump($_REQUEST['full_name']);
            $userController->createUser($_REQUEST['full_name'], $_REQUEST['birthdate'], $_REQUEST['address'], $_REQUEST['gender']);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            $params = [];
            if (isset($_REQUEST['full_name'])) {
                $params['full_name'] = $_REQUEST['full_name'];
            }
            if (isset($_REQUEST['birthdate'])) {
                $params['birthdate'] = $_REQUEST['birthdate'];
            }
            if (isset($_REQUEST['address'])) {
                $params['address'] = $_REQUEST['address'];
            }
            if (isset($_REQUEST['gender'])) {
                $params['gender'] = $_REQUEST['gender'];
            }
//            var_dump($_REQUEST);
//            var_dump($_REQUEST['full_name']);
            $userController->updateUser($_REQUEST['id'], $params);
        }
        break;
    case 'phone':
        break;
    case 'email':
        break;

}

