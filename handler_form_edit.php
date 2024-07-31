<?php
    session_start();
    require "functions.php";

    $username = $_POST['username'];
    $job_title = $_POST['job_title'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    edit_information2($username, $job_title, $phone, $address, $_GET['id']);
    set_flash_message('success', 'Профиль успешно обновлён.');
    redirect_to('users.php');
?>