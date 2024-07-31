<?php
    session_start();
    require "functions.php";

    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';

    $user = get_user_by_email($email);

    if(!empty($user)) {
        set_flash_message('danger', 'Такой эл.адрес уже зарегистрирован.');
        redirect_to('page_register.php');
    }

    $user_id = add_user($email, $password, $role);
    edit_information('', '', '', '', $email, $user_id);
    set_flash_message('success', 'Вы успешно зарегистрировались.');
    redirect_to('page_login.php');
?>



