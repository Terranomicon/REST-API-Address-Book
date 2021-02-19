<?php

require_once 'Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/Entities/Phones.php";


class PhonesController extends Controller
{
    public function getPhones($id = null)
    {
        if (isset($id)) {
            $result = Phones::getPhoneByUserId($id);
        } else {
            $result = Phones::getAll();
        }
        $this->response($result, 200);
    }

    /**
     * @param $params
     * @throws Exception
     */
    public function createPhoneByUserId($params)
    {
        $userData = Phones::getPhoneByUserId($params['user_id']);
        if ($userData) {
            throw new Exception('User id already in use');
        }
        $result = Phones::createPhone($params);
        $this->response($result, 200);
    }

    /**
     * @param $params
     * @throws Exception
     */
    public function updatePhone($params)
    {
        $newUserData = [];
        $userData = Phones::getPhoneByUserId($params['user_id']);
        if (!$userData) {
            throw new Exception('User not found');
        }
        if (isset($params['number_type'])) {
            $newUserData['number_type'] = $params['number_type'];
        }

        if (isset($params['number'])) {
            $newUserData['number'] = $params['number'];
        }
        $result = Phones::updatePhone($newUserData, $userData[0]);
        $this->response($result, 200);
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function deletePhone($id)
    {
        $userData = Phones::getPhoneByUserId($id);
        if (!$userData) {
            throw new Exception('User not found');
        }
        $result = Phones::deletePhone($userData[0]);
        $this->response($result, 200);
    }
}