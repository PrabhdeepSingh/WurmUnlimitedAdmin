<?php
session_start();
require(dirname(__FILE__) . "/includes/config.php");
require(dirname(__FILE__) . "/includes/functions.php");

if($application["mode"] == DEVELOPMENT)
{
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
}

if(isLoggedin())
{
  $userData = $_SESSION["userData"];
}
else
{
  header("Location: ".$application["rootPath"]."account/login/?ref=//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."");
  die();
}

if(time() - $_SESSION['accountLoggedinTime'] > 3600) {
  unset($_SESSION['userData']);
  unset($_SESSION['accountLoggedinTime']);
  header("Location: ".$application["rootPath"]."account/login/?ref=//".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."");
  die();
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Wurm Unlimited Admin</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <script src="<?php echo $application["rootPath"]; ?>assets/vendors/jquery/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $application["rootPath"]; ?>assets/vendors/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $application["rootPath"]; ?>assets/vendors/fontawesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $application["rootPath"]; ?>assets/css/style.min.css">
    <link rel="stylesheet" href="<?php echo $application["rootPath"]; ?>assets/css/skinstyle.min.css">

    <link rel="stylesheet" href="<?php echo $application["rootPath"]; ?>assets/vendors/sweetalert/sweetalert.min.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-black sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <a href="<?php echo $application["rootPath"]; ?>" class="logo">
          <span class="logo-mini">WU<b>A</b></span>
          <span class="logo-lg">WU<b>Admin</b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $application["rootPath"]; ?>assets/images/avatars/avatar_<?php echo strtolower($userData['username'][0]); ?>_120.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $userData["username"]; ?></p>
              Admin level: <?php echo $userData["level"]; ?>
            </div>
          </div>

          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <!--
              - This nav will be generated through sql database
              -->
            <li class="treeview <?php echo $page == 'account' ? 'active' : ''; ?>">
              <a href="#">
                <i class="fa fa-desktop"></i>
                <span> Account</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $application["rootPath"]; ?>account/changepassword/"><i class="fa fa-lock"></i> Change password</a></li>
                <li><a href="<?php echo $application["rootPath"]; ?>account/logout/"><i class="fa fa-sign-out"></i> Logout</a></li>
              </ul>
            </li>
            <?php
            if($userData["level"] >= $application["minAdminLevel"])
            {
            ?>
            <li class="treeview <?php echo $page == 'admin' ? 'active' : ''; ?>">
              <a href="#">
                <i class="fa fa-bank"></i>
                <span> Admin</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo $application["rootPath"]; ?>admin/add/"><i class="fa fa-user-plus"></i> Add user</a></li>
                <li><a href="<?php echo $application["rootPath"]; ?>admin/users/"><i class="fa fa-users"></i> Users</a></li>
              </ul>
            </li>
            <li class="<?php echo $page == 'server' ? 'active' : ''; ?>">
              <a href="<?php echo $application["rootPath"]; ?>servers/">
                <i class="fa fa-server"></i>
                <span> Servers</span>
              </a>
            </li>
            <?php } ?>
            <li class="treeview <?php echo $page == 'player' ? 'active' : ''; ?>">
              <a href="#">
                <i class="fa fa-user"></i>
                <span> Player</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-power-off"></i> Players online</a></li>
                <li><a href="<?php echo $application["rootPath"]; ?>players/"><i class="fa fa-users"></i> All players</a></li>
              </ul>
            </li>
            <li class="treeview <?php echo $page == 'village' ? 'active' : ''; ?>">
              <a href="#">
                <i class="fa fa-home"></i>
                <span> Village</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-list"></i> View all villages</a></li>
              </ul>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>