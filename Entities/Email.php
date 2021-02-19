<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/Database.php';


class Email
{
    public static function getEmailByUserId($id)
    {
        $query = "SELECT * FROM email WHERE user_id = $id";
        return pg_fetch_all(pg_query(Database::getConnection(), $query));
    }

    public static function getAll()
    {
        $query = "SELECT * FROM email";
        return pg_fetch_all(pg_query(Database::getConnection(), $query));
    }

    public static function createEmail($params)
    {
        return pg_insert(Database::getConnection(), 'email', $params);
    }

    public static function updatePhone($newUserData, $userData)
    {
        return pg_update(Database::getConnection(), 'email', $newUserData, $userData);
    }

    public static function deletePhone($userData)
    {
        return pg_delete(Database::getConnection(), 'email', $userData);
    }
}