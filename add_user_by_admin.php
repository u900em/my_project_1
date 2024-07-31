<?php
    session_start();
    require "functions.php";

    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'user';
    $username = $_POST['username'];
    $job_title = $_POST['job_title'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $status = $_POST['status'];
    $photo = $_FILES['image'];
    $vkontakte = $_POST['vk'];
    $telegram = $_POST['telega'];
    $instagram = $_POST['insta'];

    $user = get_user_by_email($email);

    if(!empty($user)) {
        set_flash_message('danger', 'Пользователь с таким эл.адресом уже зарегистрирован.');
        redirect_to('create_user.php');
    }

    $user_creation_by_admin = add_user($email, $password, $role);
    edit_information($username, $job_title, $phone, $address, $email, $user_creation_by_admin);
    set_status($status, $user_creation_by_admin);
    upload_avatar($photo['name'], $photo['tmp_name'], $user_creation_by_admin);
    add_social_links($vkontakte, $telegram, $instagram, $user_creation_by_admin);
    set_flash_message('success', 'Пользователь успешно добавлен.');
    redirect_to('create_user.php');

?>