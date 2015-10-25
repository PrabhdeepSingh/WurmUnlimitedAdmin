<?php
session_start();
require(dirname(__FILE__) . "/../../includes/config.php");
require(dirname(__FILE__) . "/../../includes/functions.php");
if(isLoggedin())
{
  header( 'Location: ../../' );
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
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo $application["rootPath"]; ?>assets/vendors/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo $application["rootPath"]; ?>assets/vendors/fontawesome/css/font-awesome.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo $application["rootPath"]; ?>assets/css/style.min.css">
    <link rel="stylesheet" href="<?php echo $application["rootPath"]; ?>assets/css/skinstyle.min.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="<?php echo $application["rootPath"]; ?>">WurmUnlimited<b>Admin</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Use your user and password to login</p>
        <div id="response"></div>
        <form role="form" id="formLogin">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Username" id="txtUsername" required />
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Password" id="txtPassword" required />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <div class="col-xs-12">
              <input type="hidden" id="serverRef" value="<?php echo isset($_GET['ref']) ? $_GET['ref'] : ''; ?>" />
              <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
            </div><!-- /.col -->
          </div>
        </form>

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <script src="<?php echo $application["rootPath"]; ?>assets/vendors/jquery/jquery-2.1.4.min.js"></script>
    <script src="<?php echo $application["rootPath"]; ?>assets/vendors/bootstrap/js/bootstrap.min.js"></script>
    <script>
      $(document).ready(function() {
        $('#formLogin').on('submit', function(e) {
          e.preventDefault();

          var username = $('#txtUsername').val();
          var password = $('#txtPassword').val();

          $('#response').html('');

          if(username != '' && password != '') {
            $.ajax({
              type: 'POST',
              url: 'login.php',
              data: {username: username, password: password},
              dataType: 'json',
              success: function(response) {
                console.log(response);
                if(response.success) {
                  if($('#serverRef').val() != "") {
                    window.location.href = $('#serverRef').val();
                  }
                  else {
                    window.location.href = '../../';
                  }
                }
                else {
                  switch(response.message) {
                    case 'Incorrect':
                      $('#response').html('<div class="alert alert-danger" role="alert"> The username or password is incorrect. </div>');
                      break;
                    case 'Invalid':
                      $('#response').html('<div class="alert alert-danger" role="alert"> The username or password is incorrect. </div>');
                      break;
                    default:
                      $('#response').html('<div class="alert alert-danger" role="alert"> Something went wrong </div>');
                      break;
                  }
                }
              }
            });
          }
          else {
            $('#response').html('<div class="alert alert-danger" role="alert"> You left something blank! </div>');
          }

          return false;
        });
      });
    </script>
  </body>
</html>