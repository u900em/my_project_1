<?php
    session_start();
    require "functions.php";

    $user = $_SESSION['user'];
    if(!is_logged_in() && !is_admin($user)) {
        redirect_to('page_login.php');
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Document</title>
        <meta name="description" content="Chartist.html">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-solid.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-brands.css">
        <link rel="stylesheet" media="screen, print" href="css/fa-regular.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary bg-primary-gradient">
            <a class="navbar-brand d-flex align-items-center fw-500" href="users.php"><img alt="logo" class="d-inline-block align-top mr-2" src="img/logo.png"> Учебный проект</a> <button aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation" class="navbar-toggler" data-target="#navbarColor02" data-toggle="collapse" type="button"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="users.php?logout <?php logout(); ?>">Выйти</a>
                    </li>
                </ul>
            </div>
        </nav>
        <main id="js-page-content" role="main" class="page-content mt-3">
            <?php show_flash_message('danger'); ?>
            <?php show_flash_message('success'); ?>
            <div class="subheader">
                <h1 class="subheader-title">
                    <i class='subheader-icon fal fa-plus-circle'></i> Добавить пользователя
                </h1>
            </div>
            <form action="add_user_by_admin.php" enctype="multipart/form-data" method="post">
                <div class="row">
                    <div class="col-xl-6">
                        <div id="panel-1" class="panel">
                            <div class="panel-container">
                                <div class="panel-hdr">
                                    <h2>Общая информация</h2>
                                </div>
                                <div class="panel-content">
                                    <!-- username -->
                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput">Имя</label>
                                        <input type="text" name="username" id="simpleinput" class="form-control">
                                    </div>

                                    <!-- job_title -->
                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput">Место работы</label>
                                        <input type="text" name="job_title" id="simpleinput" class="form-control">
                                    </div>

                                    <!-- phone -->
                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput">Номер телефона</label>
                                        <input type="text" name="phone" id="simpleinput" class="form-control">
                                    </div>

                                    <!-- address -->
                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput">Адрес</label>
                                        <input type="text" name="address" id="simpleinput" class="form-control">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div id="panel-1" class="panel">
                            <div class="panel-container">
                                <div class="panel-hdr">
                                    <h2>Безопасность и Медиа</h2>
                                </div>
                                <div class="panel-content">
                                    <!-- email -->
                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput">Email</label>
                                        <input type="text" name="email" id="simpleinput" class="form-control">
                                    </div>

                                    <!-- password -->
                                    <div class="form-group">
                                        <label class="form-label" for="simpleinput">Пароль</label>
                                        <input type="password" name="password" id="simpleinput" class="form-control">
                                    </div>

                                    <!-- status -->
                                    <div class="form-group">
                                        <label class="form-label" for="example-select">Выберите статус</label>
                                        <select option="selected" name="status" class="form-control" id="example-select">
                                            <?php
                                                $statuses = [
                                                    'success' => 'Онлайн',
                                                    'offline' => 'Отошел',
                                                    'danger' => 'Не беспокоить'
                                                ];
                                            ?>
                                            <?php foreach($statuses as $key=>$status): ?>
                                                <option value="<?php echo $key; ?>"><?php echo $status; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label" for="example-fileinput">Загрузить аватар</label>
                                        <input type="file" name="image" id="example-fileinput" class="form-control-file">
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div id="panel-1" class="panel">
                            <div class="panel-container">
                                <div class="panel-hdr">
                                    <h2>Социальные сети</h2>
                                </div>
                                <div class="panel-content">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <!-- vk -->
                                            <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                        <span class="icon-stack fs-xxl">
                                                            <i class="base-7 icon-stack-3x" style="color:#4680C2"></i>
                                                            <i class="fab fa-vk icon-stack-1x text-white"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="text" name="vk" class="form-control border-left-0 bg-transparent pl-0">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <!-- telegram -->
                                            <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                        <span class="icon-stack fs-xxl">
                                                            <i class="base-7 icon-stack-3x" style="color:#38A1F3"></i>
                                                            <i class="fab fa-telegram icon-stack-1x text-white"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="text" name="telega" class="form-control border-left-0 bg-transparent pl-0">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <!-- instagram -->
                                            <div class="input-group input-group-lg bg-white shadow-inset-2 mb-2">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-transparent border-right-0 py-1 px-3">
                                                        <span class="icon-stack fs-xxl">
                                                            <i class="base-7 icon-stack-3x" style="color:#E1306C"></i>
                                                            <i class="fab fa-instagram icon-stack-1x text-white"></i>
                                                        </span>
                                                    </span>
                                                </div>
                                                <input type="text" name="insta" class="form-control border-left-0 bg-transparent pl-0">
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-3 d-flex flex-row-reverse">
                                            <button class="btn btn-success">Добавить</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </form>
        </main>

        <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
        <script>
            $(document).ready(function()
            {
            });
        </script>
    </body>
</html>