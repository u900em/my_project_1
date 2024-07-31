<?php
    session_start();
    require "functions.php";

    $status = $_POST['status'];

    set_status($status, $_GET['id']);
    set_flash_message('success', 'Статус успешно обновлён.');
    redirect_to('users.php');
?>