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

    public static function createUser($params)
    {
        return pg_insert(Database::getConnection(), 'users', $params);
    }

    public static function updateUser($newUserData, $userData)
    {
        return pg_update(Database::getConnection(), 'users', $newUserData, $userData);
    }

    public static function deleteUser($userData)
    {
        return pg_delete(Database::getConnection(), 'users', $userData);
    }
}