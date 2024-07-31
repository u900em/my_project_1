<?php
    session_start();
    require "functions.php";

    $photo = $_FILES['image'];
    upload_avatar($photo['name'], $photo['tmp_name'], $_GET['id']);
    set_flash_message('success', 'Аватарка успешно отредактирована.');
    redirect_to('users.php');
?>