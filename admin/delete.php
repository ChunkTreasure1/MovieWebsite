<?php

session_start();

include_once('../includes/connection.php');
include_once('../includes/movie.php');

$movie = new Movie;

if(isset($_SESSION['u_admin'])){
	if(isset($_GET['id'])){
		$id = $_GET['id'];
		
		$query = $pdo->prepare('DELETE FROM movies WHERE movie_id = ?');
		$query = bindValue(1, $id);
		$query->execute();
		
		header('Location: delete.php');
	}
	
	$movies = $movie->fetch_all();	
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
								<h1>Delete movie</h1>
								
								<h2>Select a movie to delete</h2>
								
								<form action="delete.php" method="get">
									<select onChange="this.form.submit();" name="id">
										<?php foreach($movies as $movie) { ?>
										
										<option value="<?php echo $movie['movie_id']; ?>">	<?php echo $movie['movie_title'];?>
										</option>
										
										<?php } ?>
									</select>
								</form>
								
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
	header('Location: index.php');
}

?>
