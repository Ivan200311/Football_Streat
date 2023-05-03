<?php

session_start();

use App\models\User;

require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';

$surname = '';
$name = '';
$middle_name = '';
$phone = '';
$password = '';
if (isset($_POST['btn'])) {
    if ($_POST['surname'] != '') {
        if (!preg_match('/^[А-ЯЁ][а-яё]+$/u', $_POST['surname']))
            $_SESSION['error']['surname'] = 'Имя некорректно';
        else
            $name = $_POST['surname'];
        $_SESSION['save']['surname'] = $_POST['surname'];
    } else $_SESSION['error']['surname'] = 'Поле обязательно для заполнения';

    if ($_POST['name'] != '') {
        if (!preg_match('/^[А-ЯЁ][а-яё]+$/u', $_POST['name']))
            $_SESSION['error']['name'] = 'Имя некорректно';
        else
            $name = $_POST['name'];
        $_SESSION['save']['name'] = $_POST['name'];
    } else $_SESSION['error']['name'] = 'Поле обязательно для заполнения';

    if ($_POST['middle_name'] != '') {
        if (!preg_match('/^[А-ЯЁ][а-яё]+$/u', $_POST['middle_name']))
            $_SESSION['error']['middle_name'] = 'Имя некорректно';
        else
            $name = $_POST['middle_name'];
        $_SESSION['save']['middle_name'] = $_POST['middle_name'];
    } else $_SESSION['error']['middle_name'] = 'Поле обязательно для заполнения';

    if ($_POST['phone'] != '') {
        if (!preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$/u', $_POST['phone']))
            $_SESSION['error']['phone'] = 'Номер некорректен';
        else {
            $phone = $_POST['phone'];
        }
        $_SESSION['save']['phone'] = $_POST['phone'];
    } else $_SESSION['error']['phone'] = 'Поле обязательно для заполнения';

    

    if ($_POST['password'] != '') {
        $password = $_POST['password'];
        $_SESSION['save']['password'] = $_POST['password'];
    } else $_SESSION['error']['password'] = 'Поле обязательно для заполнения';

    if ($_POST['password'] != $_POST['password_confirmation']) {
        $_SESSION['error']['repeat_password'] = 'Пароли не совпадают';
    }

    $user = User::getUser($_POST['phone'], $_POST['password']);
    if ($user != null) {
        $_SESSION['error']['exists'] = 'Пользователь уже зарегистрирован';
    }

    if (empty($_SESSION['error'])) {
        unset($_SESSION['save']);
        $user = User::insert($_POST);
        $user = User::getUser($_POST['phone'], $_POST['password']);
        $_SESSION['auth'] = true;
        $_SESSION['id'] = $user->id;
        $_SESSION['profile']['name'] = $user->name;
        header('Location: /app/tables/users/profile.php');
        die();
    } else
        header('Location: /app/tables/users/create.php');
}