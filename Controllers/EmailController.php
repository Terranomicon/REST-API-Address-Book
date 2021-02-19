<?php

require_once 'Controller.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/Entities/Email.php";


class EmailController extends Controller
{
    public function getEmails($id = null)
    {
        if (isset($id)) {
            $result = Email::getEmailByUserId($id);
        } else {
            $result = Email::getAll();
        }
        $this->response($result, 200);
    }

    /**
     * @param $params
     */
    public function createEmailByUserId($params)
    {
        try {
            $userData = Email::getEmailByUserId($params['user_id']);
            if ($userData) {
                throw new Exception('User id already in use');
            }
            $result = Email::createEmail($params);
            $this->response($result, 200);
        } catch (Exception $exception) {
            echo $exception;
        }
    }

    /**
     * @param $params
     * @throws Exception
     */
    public function updateEmail($params)
    {
        $newUserData = [];
        $userData = Email::getEmailByUserId($params['user_id']);
        if (!$userData) {
            throw new Exception('User not found');
        }
        if (isset($params['type'])) {
            $newUserData['type'] = $params['type'];
        }

        if (isset($params['email'])) {
            $newUserData['email'] = $params['email'];
        }
        $result = Email::updatePhone($newUserData, $userData[0]);
        $this->response($result, 200);
    }

    /**
     * @param $id
     * @throws Exception
     */
    public function deleteEmail($id)
    {
        $userData = Email::getEmailByUserId($id);
        if (!$userData) {
            throw new Exception('User not found');
        }
        $result = Email::deletePhone($userData[0]);
        $this->response($result, 200);
    }
}