<?php

session_start();

include_once('includes/connection.php');
include_once('includes/movie.php');
include_once('includes/categories.php');

$movie = new Movie;
$movies = $movie->fetch_all();

if(isset($_POST['name'])){
	$name = $_POST['name'];
	$to = "movies@moviewatchers.unaux.com";
	$subject = "Movie request";
	
	mail($to, $subject, $name);
	
}

?>

<html>
	<head>
		<title>Moviewatchers</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="../assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="../assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="../assets/css/ie8.css" /><![endif]-->
	</head>
	<body>
		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header">
						<div class="inner">

							<!-- Logo -->

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
							<header>
                                <h4>All Categories</h4>
				
								<form action="categories.php" method="post">
									<input type="submit" name="action" value="Action"/>
									<input type="submit" name="adventure" value="Adventure"/>
									<input type="submit" name="comedy" value="Comedy"/>
									<input type="submit" name="crime" value="crime"/>
									<input type="submit" name="drama" value="Drama"/>
									<input type="submit" name="fantasy" value="Fantasy"/>
									<input type="submit" name="horror" value="Horror"/>
									<input type="submit" name="history" value="History"/>
									<br /><br />
									<input type="submit" name="mystery" value="Mystery"/>
									<input type="submit" name="romantic" value="romantic"/>
									<input type="submit" name="scifi" value="Sci-Fi"/>
									<input type="submit" name="sport" value="Sport"/>
									<input type="submit" name="thriller" value="Thriller"/>
									<input type="submit" name="war" value="War"/>
								</form>
								
							</header>
							<section class="tiles">
								<?php if(!isset($_POST)){ ?>
	
								<?php foreach ($movies as $movie) {?>
								<article class="style1">
									<span class="image">
										<img src="images/<?php echo $movie['movie_img'] ?>" alt="" />
									</span>
									<a href="movie.php?id=<?php echo $movie['movie_id']; ?>">
										<h2><?php echo $movie['movie_title']; ?>(<?php echo $movie['movie_year'] ?>)</h2>
									</a>
								</article>
								<?php 
									} 
								} else {
	
								if(isset($_POST['action'])){
									$cat = "action";
								} elseif(isset($_POST['adventure'])){
									$cat = "adventure";
								} elseif(isset($_POST['comedy'])){
									$cat = "comedy";
								} elseif(isset($_POST['crime'])){
									$cat = "crime";
								} elseif(isset($_POST['drama'])){
									$cat = "drama";
								} elseif(isset($_POST['fantasy'])){
									$cat = "fantasy";
								} elseif(isset($_POST['horror'])){
									$cat = "horror";
								} elseif(isset($_POST['history'])){
									$cat = "history";
								} elseif(isset($_POST['mystery'])){
									$cat = "mystery";
								} elseif(isset($_POST['romantic'])){
									$cat = "romantic";
								} elseif(isset($_POST['scifi'])){
									$cat = "scifi";
								} elseif(isset($_POST['sport'])){
									$cat = "sport";
								} elseif(isset($_POST['thriller'])){
									$cat = "thriller";
								} elseif(isset($_POST['war'])){
									$cat = "war";
								} 
	
								$sql = "SELECT * FROM movies WHERE movie_category='$cat'";
								$result = mysqli_query($conn, $sql);
								$queryResult = mysqli_num_rows($result);
								
								if($queryResult > 0){
									
									while($row = mysqli_fetch_assoc($result)){
									echo "	
										<article class='style1'>
										<span class='image'>
											<img src='images/".$row['movie_img']."' alt='' />
										</span>
										<a href='movie.php?id=".$row['movie_id']."'>
											<h2>".$row['movie_title']."(".$row['movie_year'].")</h2>
										</a>
										</article> ";
									}
										
									} else {
										echo "There are no results!";
									}
	
								} 
								?>
							</section>
						</div>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<div class="inner">
							<section>
								<h2>Get in touch</h2>
								<form method="post" action="index.php">
									<div class="field half first">
										<input type="text" name="name" id="name" placeholder="Movie name" />
									</div>
									<ul class="actions">
										<li><input type="submit" value="Send" class="special" /></li>
									</ul>
								</form>
							</section>
						</div>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>