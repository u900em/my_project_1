<?php
    session_start();
    require "functions.php";
    
    $user_id = get_user_by_id($_GET['id']);
    unlink('img/demo/avatars/'.$user_id['image']);
    delete($user_id['id']);
    
    if($_SESSION['user']['id'] === $_GET['id']) {
        unset($_SESSION['user']);
        set_flash_message('success', 'Пользователь удалён.');
        redirect_to('page_register.php');
    }

    set_flash_message('success', 'Пользователь удалён.');
    redirect_to('users.php');
?>