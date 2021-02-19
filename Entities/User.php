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

    public static function createUser($full_name, $birthdate, $address, $gender)
    {
        $user['full_name'] = $full_name;
        $user['birthdate'] = $birthdate;
        $user['address'] = $address;
        $user['gender'] = $gender;
        return pg_insert(Database::getConnection(), 'users', $user);
    }

    public static function updateUser($newUserData, $userData)
    {
        return pg_update(Database::getConnection(), 'users', $newUserData, $userData);
    }
}