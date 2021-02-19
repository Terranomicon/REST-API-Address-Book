<?php

require_once 'vendor/autoload.php';
require_once 'Config.php';


$host = Config::getParam('host');
$dbname = Config::getParam('dbname');
$user = Config::getParam('user');
$password = Config::getParam('password');
$dbconn = pg_connect("host=$host dbname=$dbname user=$user password=$password")
or die('Не удалось соединиться: ' . pg_last_error());

$faker = Faker\Factory::create('ru_RU');

$genderTypes = [0 => 'Мужчина', 1 => 'Женщина'];
$emailTypes = [0 => 'Личный', 1 => 'Рабочий'];
$phoneTypes = [0 => 'Городской', 1 => 'Мобильный'];

$user = [];
$email = [];
$phone = [];
for ($i = 0; $i < 50; $i++) {
    $user['full_name'] = $faker->name;
    $user['birthdate'] = $faker->date($format = 'Y-m-d', $max = 'now');
    $user['address'] = $faker->address;
    $user['gender'] = $genderTypes[array_rand($genderTypes)];
    $res = pg_insert($dbconn, 'users', $user);

    $email['user_id'] = $i + 1;
    $email['type'] = $emailTypes[array_rand($emailTypes)];
    $email['email'] = $faker->email;
    $res = pg_insert($dbconn, 'email', $email);

    $phone['user_id'] = $i + 1;
    $phone['number_type'] = $phoneTypes[array_rand($phoneTypes)];
    $phone['number'] = $faker->phoneNumber;
    $res = pg_insert($dbconn, 'phone_number', $phone);
}