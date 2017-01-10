<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="Application Picker">
		<meta name="author" content="Prabhdeep Singh">

		<title>OneApp</title>

		<!-- Bootstrap Core CSS -->
		<link href="../../assets/vendors/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
		
		<!-- Application Core CSS -->
		<link href="css/style.css" rel="stylesheet" />

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

	</head>

	<body>
		<div class="container">
			<div class="row" id="appList">

			</div>
		</div>

		<!-- jQuery Version 3.1.1 -->
		<script src="../../assets/vendors/jquery/jquery-2.1.4.min.js"></script>

		<!-- Bootstrap Core JavaScript -->
		<script src="../../assets/vendors/bootstrap/js/bootstrap.min.js"></script>
		
		<script tyoe="text/javascript">
			var listOfServers = <?php echo json_encode($_SESSION["serverList"]); ?>
		</script>

		<!-- App Javascript -->
		<script src="js/app.js"></script>

	</body>
</html>
