<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/Database.php';


class User
{
    public static function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE id = $id";
        return pg_fetch_all(pg_query(Database::getConnection(), $query));
    }

    public static function getAll()
    {
        $query = "SELECT * FROM users ";
        return pg_fetch_all(pg_query(Database::getConnection(), $query));
    }

    public static function createUser($params): string
    {
        if (pg_insert(Database::getConnection(), 'users', $params) != false) {
            Logger::write('user create => ' . implode(' | ', $params));
            return '200';
        } else return '501';
    }

    public static function updateUser($id, $newUserData, $userData): string
    {
        if (pg_update(Database::getConnection(), 'users', $newUserData, $userData) != false) {
            Logger::write('user update => ' . (string)"$id " . implode(' | ', $newUserData));
            return '200';
        } else return '501';
    }

    public static function deleteUser($userData)
    {
        return pg_delete(Database::getConnection(), 'users', $userData);
    }
}