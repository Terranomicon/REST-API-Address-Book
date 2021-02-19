<?php

require_once 'Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/Entities/User.php";


class UserController extends Controller
{
    public function getUsers($id = null)
    {
        if (isset($id)) {
            $result = User::getUserById($id);
        } else {
            $result = User::getAll();
        }
        $this->response($result, 200);
    }

    public function createUser($full_name, $birthdate, $address, $gender)
    {
        $result = User::createUser($full_name, $birthdate, $address, $gender);
        $this->response($result, 200);
    }

    public function updateUser($id, $params)
    {
        $userData = User::getUserById($id);
        $newUserData = [];
        if (isset($params['full_name'])) {
            $newUserData['full_name'] = $params['full_name'];
        }

        if (isset($params['birthdate'])) {
            $newUserData['birthdate'] = $params['birthdate'];
        }

        if (isset($params['address'])) {
            $newUserData['address'] = $params['address'];
        }

        if (isset($params['gender'])) {
            $newUserData['gender'] = $params['gender'];
        }
        var_dump($userData);
        var_dump($newUserData);
        $result = User::updateUser($newUserData, $userData[0]);
        $this->response($result, 200);
    }
}