<?php

    function get_user_by_email($email) {
        $pdo = new PDO("mysql:host=localhost; dbname=my_project", "root", "root");
        $sql = "SELECT * FROM users WHERE email=:_email";
        $statement = $pdo->prepare($sql);
        $statement->execute(['_email' => $email]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    function set_flash_message($name, $message) {
        $_SESSION[$name] = $message;
    }

    function redirect_to($path) {
        header("Location: /$path");
        exit;
    }

    function add_user($email, $password, $role) {
        $pdo = new PDO("mysql:host=localhost; dbname=my_project", "root", "root");
        $sql = "INSERT INTO users (email, password, role) VALUES (:_email, :_password, :_role)";
        $statement = $pdo->prepare($sql);
        $statement->execute(['_email' => $email, '_password' => $password, '_role' => $role]);
        $statement->fetchAll(PDO::FETCH_ASSOC);
        return $pdo->lastInsertId();
    }

    function show_flash_message($name) {
        if(isset($_SESSION[$name])) {
            echo "<div class=\"alert alert-{$name}\">{$_SESSION[$name]}</div>";
            unset($_SESSION[$name]);
        }
    }

    function is_logged_in() {
        if(isset($_SESSION['user'])) {
            return true;
        }
        return false;
    }

    function get_users() {
        $pdo = new PDO("mysql:host=localhost; dbname=my_project", "root", "root");
        $statement = $pdo->query("SELECT * FROM all_users");
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    function get_authorized_user() {
        if(is_logged_in()) {
            return $_SESSION['user'];
        }
        return false;
    }

    function is_admin($user) {
        if(is_logged_in()) {
            if($user['role'] === 'admin') {
                return true;
            }
            return false;
        }
    }

    function is_equal($user, $current_user) {
        if($user['id'] == $current_user['id']) {
            return true;
        }
        return false;
    }

    function edit_information($username, $job_title, $phone, $address, $email, $user_id) {
        $pdo = new PDO("mysql:host=localhost; dbname=my_project", "root", "root");
        $sql = "INSERT INTO all_users (username, job_title, phone, address, email, id, status, image, vk, telegram, instagram)
        VALUES (:_username, :_job_title, :_phone, :_address, :_email, :_id, :_status, :_image, :_vk, :_telegram, :_instagram)";
        $statement = $pdo->prepare($sql);
        $statement->execute(['_username' => $username,
                            '_job_title' => $job_title,
                            '_phone' => $phone,
                            '_address' => $address,
                            '_email' => $email,
                            '_id' => $user_id,
                            '_status' => '',
                            '_image' => '',
                            '_vk' => '',
                            '_telegram' => '',
                            '_instagram' => '']);
    }

    function set_status($status, $user_id) {
        $pdo = new PDO("mysql:host=localhost; dbname=my_project", "root", "root");
        $sql = "UPDATE all_users SET status=:_status WHERE id=:_id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['_status' => $status, '_id' => $user_id]);
    }

    function upload_avatar($my_img, $image_tmp, $user_id) {
        $originalExtension = pathinfo($my_img)['extension'];
        $newExtension = 'png';
        $file_name = uniqid() .".". $originalExtension;
        $newFileWithExtension = str_replace($originalExtension, $newExtension, $file_name);
        move_uploaded_file($image_tmp, "img/demo/avatars/" . $newFileWithExtension);
        
        $pdo = new PDO("mysql:host=localhost; dbname=my_project", "root", "root");
        $sql = "UPDATE all_users SET image=:_image WHERE id=:_id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['_image' => $newFileWithExtension, '_id' => $user_id]);
    }

    function add_social_links($vk, $telega, $insta, $user_id) {
        $pdo = new PDO("mysql:host=localhost; dbname=my_project", "root", "root");
        $sql = "UPDATE all_users SET vk=:_vk, telegram=:_telega, instagram=:_insta WHERE id=:_id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['_vk' => $vk, '_telega' => $telega, '_insta' => $insta, '_id' => $user_id]);
    }

    function get_user_by_id($id) {
        $pdo = new PDO("mysql:host=localhost; dbname=my_project", "root", "root");
        $sql = "SELECT * FROM all_users WHERE id=:_id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['_id' => $id]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    function edit_information2($username, $job_title, $phone, $address, $user_id) {
        $pdo = new PDO("mysql:host=localhost; dbname=my_project", "root", "root");
        $sql = "UPDATE all_users SET username=:_username, job_title=:_job_title, phone=:_phone, address=:_address WHERE id=:_id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['_username' => $username,
                            '_job_title' => $job_title,
                            '_phone' => $phone,
                            '_address' => $address,
                            '_id' => $user_id]);
    }

    function edit_credentials($email, $password, $user_id) {
        $pdo = new PDO("mysql:host=localhost; dbname=my_project", "root", "root");
        $sql = "UPDATE users SET email=:_email, password=:_password WHERE id=:_id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['_email' => $email, '_password' => $password, '_id' => $user_id]);
    }

    function edit_credentials_from_data_base_all_users($email, $user_id) {
        $pdo = new PDO("mysql:host=localhost; dbname=my_project", "root", "root");
        $sql = "UPDATE all_users SET email=:_email WHERE id=:_id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['_email' => $email, '_id' => $user_id]);
    }

    function delete($user_id) {
        $pdo = new PDO("mysql:host=localhost; dbname=my_project", "root", "root");
        $sql = "DELETE FROM all_users WHERE id=:_id; DELETE FROM users WHERE id=:_id";
        $statement = $pdo->prepare($sql);
        $statement->execute(['_id' => $user_id]);
    }

    function logout() {
        if(isset($_GET['logout'])) {
            session_start();
            unset($_SESSION['user']);
            session_unset();
            session_destroy();
            redirect_to('page_login.php');
        }
    }
?>