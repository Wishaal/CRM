<?php
//set online users
require_once(PHP_PATH.'config/online_users.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo APP_TITLE;?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo BASE_HREF;?>/assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo BASE_HREF;?>/assets/plugins/datatables/dataTables.bootstrap.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo BASE_HREF;?>/assets/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skinsc
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?php echo BASE_HREF;?>/assets/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo BASE_HREF;?>/assets/css/sticky-footer-navbar.css">
<!--	<link rel="stylesheet" href="--><?php //echo BASE_HREF;?><!--/assets/plugins/typeahead/typeahead.css">-->
    <link rel="stylesheet" href="<?php echo BASE_HREF;?>/assets/plugins/bootstrap-select-master/css/bootstrap-select.css">

    <!-- datepicker -->
    <link rel="stylesheet" href="<?php echo BASE_HREF;?>/assets/plugins/datepicker/datepicker3.css">
	
    <style>

        #topmenu {
            float: right;
            font-size: 20px;
            margin-top: 5px;
        }
        .topmenuLink {
            color: #fff;
        }
        #menuarea {
            height: 60px;
            background-image: url('<?php echo BASE_HREF;?>assets/img/crm_banner.png');
        }
        #bottombanner {
            height: 60px;
            width: 100%;
            background-image: url('<?php echo BASE_HREF;?>assets/img/crm_footer.png');
        }
        a#logo {
            float: left;
            height: 60px;
            width: 275px;
            background-image: url('<?php echo BASE_HREF;?>assets/img/crm_logo.png');
        }
        .titlehr {
            border: none;
            height: 1px;
            color: #ffdd01;
            background-color: #ffdd01;
            margin-bottom: 30px;
        }
    </style>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
    <div id="top">
        <div id="menuarea">
            <div class="container">
                <div id="menucenter">
                    <a href="/" id="logo"></a>
                    <div id="searchbox">
					
                    </div>

                    <div class="topMenu ieStackFix">

                    </div>
                </div>
                <div id="topmenu">
                    <ul class="nav navbar-nav">
                        <?php if (!empty($_SESSION['app']['user'])){ ?>
                        <li><a class="topmenuLink">MijnTelesur</a></li>
                        <li><a class="topmenuLink">SCP</a></li>
                        <li><a class="topmenuLink">Mijn Actiepunten</a></li>
                        <li><a class="topmenuLink">Systeem</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<div class="wrapper">