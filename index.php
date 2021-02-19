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
            $params = [];
            try {
                if (!isset($_REQUEST['full_name']) || $_REQUEST['full_name'] === '') {
                    throw new InvalidArgumentException('Invalid parameters. Name required', 400);
                }
                $params['full_name'] = $_REQUEST['full_name'];

                if (!isset($_REQUEST['birthdate']) || $_REQUEST['birthdate'] === '') {
                    throw new InvalidArgumentException('Invalid parameters. Birthdate required', 400);
                }
                $formatDate = date("d-m-Y", strtotime($_REQUEST['birthdate']));
                $dataArr = explode('-', $formatDate);
                if (!@checkdate($dataArr[1], $dataArr[0], $dataArr[2])) {
                    throw new InvalidArgumentException('Invalid parameters. Birthdate must by yyyy-mm-dd format', 400);
                }
                $params['birthdate'] = $_REQUEST['birthdate'];

                if (!isset($_REQUEST['address']) || $_REQUEST['address'] === '') {
                    throw new InvalidArgumentException('Invalid parameters. Address required', 400);
                }
                $params['address'] = $_REQUEST['address'];

                if (!isset($_REQUEST['gender']) || $_REQUEST['gender'] === '') {
                    throw new InvalidArgumentException('Invalid parameters. Gender required', 400);
                }
                $params['gender'] = $_REQUEST['gender'];
                $userController->createUser($params);
            } catch (InvalidArgumentException $exception) {
                echo $exception->getMessage();
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            $params = [];
            try {
                if (isset($_REQUEST['full_name'])) {
                    if ($_REQUEST['full_name'] === '') {
                        throw new InvalidArgumentException('Invalid parameters. Name required', 400);
                    } else {
                        $params['full_name'] = $_REQUEST['full_name'];
                    }
                }

                if (isset($_REQUEST['birthdate'])) {
                    $formatDate = date("d-m-Y", strtotime($_REQUEST['birthdate']));
                    $dataArr = explode('-', $formatDate);
                    if ($_REQUEST['birthdate'] !== '' && @checkdate($dataArr[1], $dataArr[0], $dataArr[2])) {
                        $params['birthdate'] = $_REQUEST['birthdate'];
                    } else {
                        throw new InvalidArgumentException('Invalid parameters. Birthdate required, format must be yyyy-mm-dd)', 400);
                    }
                }

                if (isset($_REQUEST['address'])) {
                    if ($_REQUEST['address'] !== '') {
                        $params['address'] = $_REQUEST['address'];
                    } else {
                        throw new InvalidArgumentException('Invalid parameters. Address required', 400);
                    }
                }

                if (isset($_REQUEST['gender'])) {
                    if ($_REQUEST['gender'] !== '') {
                        $params['gender'] = $_REQUEST['gender'];
                    } else {
                        throw new InvalidArgumentException('Invalid parameters. Gender required', 400);
                    }
                }

                if (!isset($_REQUEST['id'])) {
                    throw new InvalidArgumentException('Invalid parameters. Id required', 400);
                }
                $userController->updateUser($_REQUEST['id'], $params);
            } catch (InvalidArgumentException $exception) {
                echo $exception->getMessage();
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            if (!isset($_REQUEST['id'])) {
                throw new InvalidArgumentException('Invalid parameters. Id required', 400);
            }
            $userController->deleteUser($_REQUEST['id']);
        }
        break;
    case 'phone':
        break;
    case 'email':
        break;

}

