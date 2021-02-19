<?php

require_once 'Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/Entities/User.php";


class EmailController extends Controller
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
     */
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
        $result = User::updateUser($newUserData, $userData[0]);
        $this->response($result, 200);
    }

    /**
     * @param $id
     */
    public function deleteUser($id)
    {
        $userData = User::getUserById($id);
        $result = User::deleteUser($userData[0]);
        $this->response($result, 200);
    }
}