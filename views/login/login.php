<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Home</title>
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/styles/style.min.css">

    <!-- Waves Effect -->
    <link rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/plugin/waves/waves.min.css">
    <link id="custom-color-themes" rel="stylesheet" href="<?php echo constant('URL') ?>public/assets/styles/color/light-blue.min.css">

</head>

<body>

    <div id="single-wrapper">
        <form action="" method="POST" class="frm-single">
            <div class="inside">
                <!-- <div class="title"> <img src="<?php echo constant('URL') ?>public/assets/images/compulogo.png" alt="">
                </div> -->

                <h1>Iniciar sesion</h1>
                <!-- /.title -->
                <div class="frm-title">Login</div>
                <!-- /.frm-title -->
                <div class="frm-input"><input name="emailCm" type="text" placeholder="Email" class="frm-inp"><i class="fa fa-user frm-ico"></i></div>
                <!-- /.frm-input -->
                <div class="frm-input"><input name="passCm" type="password" placeholder="Contraseña" class="frm-inp"><i class="fa fa-lock frm-ico"></i></div>
                <!-- /.frm-input -->
                <div class="clearfix margin-bottom-20">
                    <div class="form-group">
                        <?php
                        if (isset($errorlogin)) {
                            echo '<div class="alert alert-danger">';
                            echo $errorlogin . "<br>";
                            echo ' </div>';
                        }
                        ?>
                    </div>
                    <!-- /.pull-left -->
                    <!-- <div class="pull-right"><a href="page-recoverpw.html" class="a-link"><i class="fa fa-unlock-alt"></i>Forgot password?</a></div>
				<!-- /.pull-right -->
                </div>
                <!-- /.clearfix -->
                <button name="Btnlog" type="submit" class="frm-submit">Login<i class="fa fa-arrow-circle-right"></i></button>

                <!-- /.row -->
                <!-- <div class="frm-footer">Computron © 2021.</div> -->
                <!-- /.footer -->
            </div>
            <!-- .inside -->
        </form>
        <!-- /.frm-single -->
    </div>
    <!--/#single-wrapper -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
		<script src="assets/script/html5shiv.min.js"></script>
		<script src="assets/script/respond.min.js"></script>
	<![endif]-->
    <!-- 
	================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="assets/scripts/jquery.min.js"></script>
    <script src="assets/scripts/modernizr.min.js"></script>
    <script src="assets/plugin/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugin/nprogress/nprogress.js"></script>
    <script src="assets/plugin/waves/waves.min.js"></script>

    <script src="assets/scripts/main.min.js"></script>
</body>

</html>