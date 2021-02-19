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

    /**
     * @param $params
     */
    public function createUser($params)
    {
        $result = User::createUser($params);
        $this->response($result, 200);
    }

    /**
     * @param $id
     * @param $params
     * @throws Exception
     */
    public function updateUser($id, $params)
    {
        $newUserData = [];
        $userData = User::getUserById($id);
        if (!$userData) {
            throw new Exception('User not found');
        }
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
        $result = User::updateUser($id, $newUserData, $userData[0]);
        $this->response($result, 200);
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function deleteUser($id)
    {
        $userData = User::getUserById($id);
        if (!$userData) {
            throw new Exception('User not found');
        }
        $result = User::deleteUser($userData[0]);
        $this->response($result, 200);
    }
}