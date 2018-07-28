<?php

session_start();

include_once('../includes/connection.php');

if (isset($_SESSION['u_admin'])){
	
	?>

	<html>
		<head>
			<title>Moviewatchers</title>
			<meta charset="utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1" />
			<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
			<link rel="stylesheet" href="../assets/css/main.css" />
			<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
			<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
		</head>
		<body>
			<!-- Wrapper -->
				<div id="wrapper">

					<!-- Header -->
						<header id="header">
							<div class="inner">

								<!-- Nav -->
									<nav>
										<ul>
											<li><a href="#menu">Menu</a></li>
										</ul>
									</nav>

							</div>
						</header>

					<!-- Menu -->
						<nav id="menu">
							<h2>Menu</h2>
							<ul>
								<li><a href="../index.php">Home</a></li>
								<li><a href="../categories.php">Categories</a></li>
								<?php if(isset($_SESSION['u_admin'])){ ?>
									<li><a href="../admin/index.php">Admin</a></li>
								<?php }?>
							
								<?php if(isset($_SESSION['u_id'])) { ?>
									<li><a href="../includes/logout.php">Sign out</a></li>
								<?php } else { ?>
									<li><a href="../login.php">Log in</a></li>
								<?php } ?>
							</ul>
						</nav>

					<!-- Main -->
						<div id="main">
							<div class="inner">
								<h1>Admin panel</h1>
								
								<ol>
								
									<li><a href="add.php">Add movie</a></li>
									<li><a href="delete.php">Delete movie</a></li>
									<li><a href="../includes/logout.php">Logout</a></li>
								
								</ol>
							</div>
						</div>

					<!-- Footer -->
						<footer id="footer">
							<div class="inner">
							</div>
						</footer>

				</div>

			<!-- Scripts -->
				<script src="../assets/js/jquery.min.js"></script>
				<script src="../assets/js/skel.min.js"></script>
				<script src="../assets/js/util.js"></script>
				<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
				<script src="../assets/js/main.js"></script>

		</body>
	</html>	


	<?php
	
} else {
	
	header("Location: ../index.php");
	
}


?>