<?php
    session_start();
    require "functions.php";

    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $user = get_user_by_email($email);
    $user_id = get_user_by_id($_GET['id']);

    if($email == $user_id['email']) {
        true;
    } else {
        if(!empty($user)) {
            set_flash_message('danger', 'Адрес электронной почты уже занят.');
            redirect_to('security.php?id=' . $_GET['id']);
        }
    }

    edit_credentials($email, $password, $_GET['id']);
    edit_credentials_from_data_base_all_users($email, $_GET['id']);
    set_flash_message('success', 'Учётные данные успешно изменены.');
    redirect_to('users.php');


    






?>