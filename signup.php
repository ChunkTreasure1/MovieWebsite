<?php
	
session_start();

	include_once('includes/connection.php');
	
	//Error handlers
	
	if(isset($_POST['firstname'], $_POST['lastname'], $_POST['username'], $_POST['password'])){

		$first = $_POST['firstname'];
		$last = $_POST['lastname'];
		$user = $_POST['username'];
		$pass = $_POST['password'];
		
		if(empty($first) or empty($last) or empty($user) or empty($pass)){
		
			$error = 'All fields are required!';
			header("Location: /signup.php?signup=empty");
			exit();
		
		} else {
		
			if(!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match("/^[a-zA-Z]*$/", $last)){	
		
				$error = 'Invalid character!';
				header("Location: /signup.php?signup=invalid");
				exit();
		
			} else {
			
				$sql = "SELECT * FROM users WHERE user_name='$user'";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysql_num_rows($result);
			
				if ( false===$result ) {
  				printf("error: %s\n", mysqli_error($con));
				}
				
				if($resultCheck > 0){
				
					$error = 'Username already in use!';
					header("Location: /signup.php?signup=usertaken");
					exit();
				
				} else {
				
					//Hash pass
					$hashedPass = password_hash($pass, PASSWORD_DEFAULT);
					//Add user to db
					$sql = "INSERT INTO users (user_name, user_password, user_lastname, user_firstname) VALUES ('$user', '$hashedPass', '$last', '$first');";
					mysqli_query($conn, $sql);
					header("Location: /signup.php?signup=success");
					exit();	
				}
			}
		}
	}

?>

<html>
		<head>
			<title>Moviewatchers</title>
			<meta charset="utf-8" />
			<meta name="viewport" content="width=device-width, initial-scale=1" />
			<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
			<link rel="stylesheet" href="/assets/css/main.css" />
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
								<h1>Sign up</h1>
								
								<?php if (isset($error)){ ?>
									<h3 style="color: #aa0000"><?php echo $error ?></h3>
								<?php }?>
								<form action="signup.php" method="post" autocomplete="off">
									<input type="text" name="firstname" placeholder="Firstname" />
									<input type="text" name="lastname" placeholder="Lastname" />
									<input type="text" name="username" placeholder="Username" />
									<input type="text" name="password" placeholder="Password" />
									<br />
									<input type="submit" name="submit" value="Sign up!" />
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
				<script src="/assets/js/jquery.min.js"></script>
				<script src="/assets/js/skel.min.js"></script>
				<script src="/assets/js/util.js"></script>
				<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
				<script src="/assets/js/main.js"></script>

		</body>
	</html>	
