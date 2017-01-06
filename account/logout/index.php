<?php
session_start();
unset($_SESSION['userData']);
unset($_SESSION['serverList']);

header( 'Location: ../login/' );
?>