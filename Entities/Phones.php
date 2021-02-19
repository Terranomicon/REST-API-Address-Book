<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/Database.php';


class Phones
{
    public static function getPhoneByUserId($id)
    {
        $query = "SELECT * FROM phone_number WHERE user_id = $id";
        return pg_fetch_all(pg_query(Database::getConnection(), $query));
    }

    public static function getAll()
    {
        $query = "SELECT * FROM phone_number ";
        return pg_fetch_all(pg_query(Database::getConnection(), $query));
    }

    public static function createPhone($params): string
    {
        if (pg_insert(Database::getConnection(), 'phone_number', $params) != false) {
            Logger::write('phone create => ' . implode(' | ', $params));
            return '200';
        } else return '501';
    }

    public static function updatePhone($newUserData, $userData): string
    {
        if (pg_update(Database::getConnection(), 'phone_number', $newUserData, $userData) != false) {
            Logger::write('phone update => ' . implode(' | ', $newUserData));
            return '200';
        } else return '501';
    }

    public static function deletePhone($userData)
    {
        return pg_delete(Database::getConnection(), 'phone_number', $userData);
    }
}