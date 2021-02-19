<?php

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/UserController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/PhonesController.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Controllers/EmailController.php';

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
            } catch (Exception $exception) {
                echo $exception;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            try {
                if (!isset($_REQUEST['id'])) {
                    throw new InvalidArgumentException('Invalid parameters. Id required', 400);
                }
                $userController->deleteUser($_REQUEST['id']);
            } catch (Exception $exception) {
                echo $exception;
            }
        }
        break;
    case 'phone':
        $phoneController = new PhonesController();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $phoneController->getPhones($_POST['id']);
            }
            $phoneController->getPhones();

        }
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $params = [];
            try {
                if (!isset($_REQUEST['user_id']) || $_REQUEST['user_id'] === '') {
                    throw new InvalidArgumentException('Invalid parameters. User Id required', 400);
                }
                $params['user_id'] = $_REQUEST['user_id'];

                if (!isset($_REQUEST['number_type']) || $_REQUEST['number_type'] === '') {
                    throw new InvalidArgumentException('Invalid parameters. NumberType required', 400);
                }
                if ($_REQUEST['number_type'] !== 'Городской' && $_REQUEST['number_type'] !== 'Мобильный') {
                    throw new InvalidArgumentException('Invalid parameters. NumberType not valid', 400);
                }
                $params['number_type'] = $_REQUEST['number_type'];

                if (!isset($_REQUEST['number']) || $_REQUEST['number'] === '') {
                    throw new InvalidArgumentException('Invalid parameters. Number required', 400);
                }
                $params['number'] = $_REQUEST['number'];
                $phoneController->createPhoneByUserId($params);
            } catch (InvalidArgumentException $exception) {
                echo $exception->getMessage();
            } catch (Exception $exception) {
                echo $exception;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            $params = [];
            try {
                if (!isset($_REQUEST['user_id'])) {
                    throw new InvalidArgumentException('Invalid parameters. User Id required', 400);
                }
                if (isset($_REQUEST['user_id'])) {
                    if ($_REQUEST['user_id'] === '') {
                        throw new InvalidArgumentException('Invalid parameters. User Id required', 400);
                    } else {
                        $params['user_id'] = $_REQUEST['user_id'];
                    }
                }

                if (isset($_REQUEST['number_type'])) {
                    if ($_REQUEST['number_type'] !== 'Городской' && $_REQUEST['number_type'] !== 'Мобильный') {
                        throw new InvalidArgumentException('Invalid parameters. NumberType not valid', 400);
                    }
                    if ($_REQUEST['number_type'] !== '') {
                        $params['number_type'] = $_REQUEST['number_type'];
                    } else {
                        throw new InvalidArgumentException('Invalid parameters. NumberType required', 400);
                    }
                }

                if (isset($_REQUEST['number'])) {
                    if ($_REQUEST['number'] !== '') {
                        $params['number'] = $_REQUEST['number'];
                    } else {
                        throw new InvalidArgumentException('Invalid parameters. Number required', 400);
                    }
                }
                $phoneController->updatePhone($params);
            } catch (InvalidArgumentException $exception) {
                echo $exception->getMessage();
            } catch (Exception $exception) {
                echo $exception;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            try {
                if (!isset($_REQUEST['user_id'])) {
                    throw new InvalidArgumentException('Invalid parameters. User Id required', 400);
                }
                $phoneController->deletePhone($_REQUEST['user_id']);
            } catch (Exception $exception) {
                echo $exception;
            }
        }
        break;
    case 'email':
        $emailController = new EmailController();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (isset($_POST['id'])) {
                $emailController->getEmails($_POST['id']);
            }
            $emailController->getEmails();

        }
        if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
            $params = [];
            try {
                if (!isset($_REQUEST['user_id']) || $_REQUEST['user_id'] === '') {
                    throw new InvalidArgumentException('Invalid parameters. User Id required', 400);
                }
                $params['user_id'] = $_REQUEST['user_id'];

                if (!isset($_REQUEST['type']) || $_REQUEST['type'] === '') {
                    throw new InvalidArgumentException('Invalid parameters. Email type required', 400);
                }
                if ($_REQUEST['type'] !== 'Личный' && $_REQUEST['type'] !== 'Рабочий') {
                    throw new InvalidArgumentException('Invalid parameters. Email type not valid', 400);
                }
                $params['type'] = $_REQUEST['type'];

                if (!isset($_REQUEST['email']) || $_REQUEST['email'] === '') {
                    throw new InvalidArgumentException('Invalid parameters. Email required', 400);
                }
                if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
                    throw new InvalidArgumentException('Invalid parameters. Email specified incorrectly', 400);
                }
                $params['email'] = $_REQUEST['email'];
                $emailController->createEmailByUserId($params);
            } catch (InvalidArgumentException $exception) {
                echo $exception->getMessage();
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'PATCH') {
            $params = [];
            try {
                if (!isset($_REQUEST['user_id'])) {
                    throw new InvalidArgumentException('Invalid parameters. User Id required', 400);
                }
                if (isset($_REQUEST['user_id'])) {
                    if ($_REQUEST['user_id'] === '') {
                        throw new InvalidArgumentException('Invalid parameters. User Id required', 400);
                    } else {
                        $params['user_id'] = $_REQUEST['user_id'];
                    }
                }

                if (isset($_REQUEST['type'])) {
                    if ($_REQUEST['type'] !== 'Личный' && $_REQUEST['type'] !== 'Рабочий') {
                        throw new InvalidArgumentException('Invalid parameters.  Email type not valid', 400);
                    }
                    if ($_REQUEST['type'] !== '') {
                        $params['type'] = $_REQUEST['type'];
                    } else {
                        throw new InvalidArgumentException('Invalid parameters. Email type required', 400);
                    }
                }

                if (isset($_REQUEST['email'])) {
                    if (!filter_var($_REQUEST['email'], FILTER_VALIDATE_EMAIL)) {
                        throw new InvalidArgumentException('Invalid parameters. Email specified incorrectly', 400);
                    }
                    if ($_REQUEST['email'] !== '') {
                        $params['email'] = $_REQUEST['email'];
                    } else {
                        throw new InvalidArgumentException('Invalid parameters. Email required', 400);
                    }
                }

                $emailController->updateEmail($params);
            } catch (InvalidArgumentException $exception) {
                echo $exception->getMessage();
            } catch (Exception $exception) {
                echo $exception;
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
            try {
                if (!isset($_REQUEST['user_id'])) {
                    throw new InvalidArgumentException('Invalid parameters. User Id required', 400);
                }
                $emailController->deleteEmail($_REQUEST['user_id']);
            } catch (Exception $exception) {
                echo $exception;
            }
        }
        break;
}

