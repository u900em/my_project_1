<?php
session_start();
require "functions.php";

$email = $_POST['email'];
$password = $_POST['password'];
$user = get_user_by_email($email);

if(empty($user)) {
    set_flash_message('danger', 'Такой пользователь не зарегистрирован.');
    redirect_to('page_login.php');
}

if(!password_verify($password, $user['password'])) {
    set_flash_message('danger', 'Неправильный пароль.');
    redirect_to('page_login.php');
}

$_SESSION['user'] = ['id' => $user['id'], 'email' => $user['email'], 'role' => $user['role']];
redirect_to('users.php');
?>