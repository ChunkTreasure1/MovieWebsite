<?php

session_start();

include_once('../includes/connection.php');

if (isset($_SESSION['u_admin'])) {
	if(isset($_POST['title'], $_POST['description'], $_POST['year'], $_POST['link'], $_POST['img'], $_POST['cat'])){
		
		$title = $_POST['title'];
		$description = nl2br($_POST['description']);
		$year = $_POST['year'];
		$link = $_POST['link'];
		$img = $_POST['img'];
		$cat = $_POST['cat'];
		
		if(empty($title) or empty($description) or empty($year) or empty($link) or empty($img) or empty($cat)){
			$error = 'All fields are required!';
		} else {
			$query = $pdo->prepare('INSERT INTO movies (movie_title, movie_desc, movie_img, movie_year, movie_openlink, movie_category) VALUES (?, ?, ?, ?, ?, ?)');
				
			$query->bindValue(1, $title);
			$query->bindValue(2, $description);
			$query->bindValue(3, $img);
			$query->bindValue(4, $year);
			$query->bindValue(5, $link);
			$query->bindValue(6, $cat);
			
			$query->execute(); 
			
			header('Location: index.php?add=success');
		}
	}
	
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
								<li><a href="index.php">Home</a></li>
								<li><a href="categories.php">Categories</a></li>
								<?php if(isset($_SESSION['u_admin'])){ ?>
									<li><a href="admin/index.php">Admin</a></li>
								<?php }?>
							
								<?php if(isset($_SESSION['u_id'])) { ?>
									<li><a href="includes/logout.php">Sign out</a></li>
								<?php } else { ?>
									<li><a href="/login.php">Log in</a></li>
								<?php } ?>
							</ul>
						</nav>

					<!-- Main -->
						<div id="main">
							<div class="inner">
								<h1>Add movie</h1>
								
								<?php if (isset($error)){ ?>
									<h3 style="color: #aa0000"><?php echo $error ?></h3>
								<?php }?>
								
								<form action="add.php" method="post" autocomplete="off">
									<input type="text" name="title" placeholder="Movie title"/>
									<input type="text" name="year" placeholder="Release year"/>
									<input type="text" name="img" placeholder="Movie image"/>
									<input type="text" name="cat" placeholder="Movie category"/>
									<textarea rows="15" cols="50" placeholder="Movie description" name="description"></textarea>
									<textarea rows="15" cols="50" placeholder="Movie openload link" name="link"></textarea> <br />
									<input type="submit" value="Add movie"/>
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
