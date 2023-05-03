<?php
use App\models\User;
require_once $_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php';
if (isset($_POST['btnVhod'])) {
    if ($_POST['phone'] == '') {
        $_SESSION['error']['phone'] = 'Поле обязательно для заполнения';
    }
    else{
        $_SESSION['save'] = $_POST['phone'];
    }
    if ($_POST['password'] == '') {
        $_SESSION['error']['password'] = 'Поле обязательно для заполнения';
    }

    if(!empty($_SESSION['error'])){
        header('Location: /app/tables/users/auth.php');
    }
    else {
        $user = User::getUser($_POST['phone'], $_POST['password']);
        if ($user == null) {
            $_SESSION['error']['null'] = 'Тебя нет в базе';
            $_SESSION['auth'] = false;
            header('Location: /app/tables/users/auth.php');
            die();
        } else {
            $_SESSION['auth'] = true;
            $_SESSION['id'] = $user->id;
            $_SESSION['profile']['name'] = $user->name;
            header('Location: /app/tables/users/profile.php');
        }
    }
}