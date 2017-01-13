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
  header("Location: " . $rootPath . "/account/login/?ref=" . $rootPath . "/" . $_SERVER["REQUEST_URI"]);
  die();
}

if(isset($_GET["server"]))
{
  $_SESSION["userData"]["server"] = $_SESSION["serverList"][$_GET["server"]];
}

if(!isset($_SESSION["userData"]["server"]))
{
  header("Location: " . $rootPath . "/server/select/");
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

    <script src="<?php echo $rootPath; ?>/assets/vendors/jquery/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $rootPath; ?>/assets/vendors/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $rootPath; ?>/assets/vendors/fontawesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $rootPath; ?>/assets/css/style.min.css">
    <link rel="stylesheet" href="<?php echo $rootPath; ?>/assets/css/skinstyle.min.css">
    <link rel="stylesheet" href="<?php echo $rootPath; ?>/assets/vendors/sweetalert/sweetalert.min.css" />

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
        <a href="<?php echo $rootPath; ?>/" class="logo">
          <span class="logo-mini">WU<b>A</b></span>
          <span class="logo-lg">WU<b>Admin</b></span>
        </a>
        <nav class="navbar navbar-static-top" role="navigation">
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li style="font-size: 1.5em;padding: 10px 10px 0 0;"><?php echo $_SESSION["userData"]["server"]["name"]; ?></li>
            </ul>
          </div>
        </nav>
      </header>
      <aside class="main-sidebar">
        <section class="sidebar">
          <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $rootPath; ?>/assets/images/avatars/avatar_<?php echo strtolower($userData['username'][0]); ?>_120.png" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $userData["username"]; ?></p>
              <?php echo $userData["user_friendly_level"]; ?>
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
                <li><a href="<?php echo $rootPath; ?>/account/changepassword/"><i class="fa fa-lock"></i> Change password</a></li>
                <li><a href="<?php echo $rootPath; ?>/account/logout/"><i class="fa fa-sign-out"></i> Logout</a></li>
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
                <li><a href="<?php echo $rootPath; ?>/admin/add/"><i class="fa fa-user-plus"></i> Add user</a></li>
                <li><a href="<?php echo $rootPath; ?>/admin/users/"><i class="fa fa-users"></i> Users</a></li>
              </ul>
            </li>
            <li class="<?php echo $page == 'server' ? 'active' : ''; ?>">
              <a href="<?php echo $rootPath; ?>/server/">
                <i class="fa fa-server"></i>
                <span> Server</span>
              </a>
            </li>
            <?php } ?>
            <li class="<?php echo $page == 'player' ? 'active' : ''; ?>">
              <a href="<?php echo $rootPath; ?>/players/">
                <i class="fa fa-users"></i>
                <span> Players</span>
              </a>
            </li>
            <li class="<?php echo $page == 'ticket' ? 'active' : ''; ?>">
              <a href="<?php echo $rootPath; ?>/tickets/">
                <i class="fa fa-ticket"></i>
                <span> Tickets</span>
              </a>
            </li>
            <li class="<?php echo $page == 'village' ? 'active' : ''; ?>">
              <a href="<?php echo $rootPath; ?>/villages/">
                <i class="fa fa-home"></i>
                <span> Villages</span>
              </a>
            </li>
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>