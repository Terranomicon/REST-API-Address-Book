<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/Database.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/Service/Logger.php';


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

    public static function createEmail($params): string
    {
        if (pg_insert(Database::getConnection(), 'email', $params) != false) {
            Logger::write('email create => ' . implode(' | ', $params));
            return '200';
        } else return '501';
    }

    public static function updatePhone($newUserData, $userData): string
    {
        if (pg_update(Database::getConnection(), 'email', $newUserData, $userData) != false) {
            Logger::write('email update => ' . implode(' | ', $newUserData));
            return '200';
        } else return '501';
    }

    public static function deletePhone($userData)
    {
        return pg_delete(Database::getConnection(), 'email', $userData);
    }
}