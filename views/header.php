<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

    <!-- Main Styles -->
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/styles/style.min.css">
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/styles/custom.css">


    <!-- mCustomScrollbar -->
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/plugin/mCustomScrollbar/jquery.mCustomScrollbar.min.css">

    <!-- Waves Effect -->
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/plugin/waves/waves.min.css">

    <!-- Sweet Alert -->

    <!-- Percent Circle -->
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/plugin/percircle/css/percircle.css">

    <!-- Chartist Chart -->
    <!-- FullCalendar -->
    <link id="custom-color-themes" rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/styles/color/light-blue.min.css">

    <!-- Color Picker -->
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/color-switcher/color-switcher.min.css">
</head>

<body>
    <div class="main-menu">
        <header class="header">
            <a href="<?php echo constant('URL') ?>" class="logo">Admin</a>

            <button type="button" class="button-close fa fa-times js__menu_close"></button>
            <div class="user">
                <a href="#" class="avatar"><img src="<?php echo constant('URL') ?>public/assets/images/user.png" alt=""><span class="status online"></span></a>
                <h5 class="name"><a href="#"><?php echo  $_SESSION['Usuario'] ?></a></h5>
                <h5 class="position"><?php echo  $_SESSION['Usuario'] ?></h5>
            </div>
            <!-- /.user -->
        </header>
        <!-- /.header -->
        <?php require("sidebar.php") ?>
        <!-- /.content -->
    </div>
    <!-- /.main-menu -->

    <div class="fixed-navbar">
        <div class="pull-left">
            <button type="button" class="menu-mobile-button glyphicon glyphicon-menu-hamburger js__menu_mobile"></button>
            <h1 id="page-title" class="page-title">Dashboard</h1>
            <!-- /.page-title -->
        </div>
        <!-- /.pull-left -->
        <div class="pull-right">

            <!-- /.ico-item -->
            <div class="ico-item fa fa-arrows-alt js__full_screen"></div>
            <!-- /.ico-item fa fa-fa-arrows-alt -->

            <!-- /.ico-item -->
            <a href="<?php echo constant('URL') ?>includes/logout.php" class="ico-item fa fa-power-off"></a>
        </div>
        <!-- /.pull-right -->
    </div>
    <!-- /.fixed-navbar -->



    <div id="wrapper">
        <div class="main-content">