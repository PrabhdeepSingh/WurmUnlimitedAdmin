<?php
session_start();
unset($_SESSION['userData']);
unset($_SESSION['accountLoggedinTime']);

header( 'Location: ../login/' );
?>