<?php

session_start();

include_once('includes/connection.php');

if(isset($_POST['username'], $_POST['password'])){
	
	$user = mysqli_real_escape_string($conn, $_POST['username']);
	$pass = mysqli_real_escape_string($conn, $_POST['password']);
	
	//Error handlers
	
	if(empty($user) or empty($pass)){
		
		
		header("Location: /login.php?login=empty");
		$error = 'Something\'s missing..';
		exit();
		
	} else {
		$sql = "SELECT * FROM users WHERE user_name='$user'";
		$result = mysqli_query($conn, $sql);
		$resultCheck = mysqli_num_rows($result);
		
		if($resultCheck < 1){
			header("Location: /login.php?login=error");
			exit;
		} else {
			
			if($row = mysqli_fetch_assoc($result)){
				
				$hasedPassCheck = password_verify($pass, $row['user_password']);
				
				if($hasedPassCheck == false){
					
					header("Location: /login.php?login=error");
					$error = 'Wrong username or password!';
					exit();
					
				} elseif ($hasedPassCheck == true){
				
					//Log in user here
					
					$_SESSION['u_id'] = $row['user_id'];
					$_SESSION['u_first'] = $row['user_firstname'];
					$_SESSION['u_last'] = $row['user_lastname'];
					$_SESSION['u_name'] = $row['user_name'];
					
					if($row['u_admin'] == 1){
						
						$_SESSION['u_admin'] = $row['u_admin'];
						
					} else {
						
						$_SESSION['u_user'] = $row['u_admin'];
						
					}
					
					if($result != true){
						
						header("Location: /index.php?login=success");
						exit();
						
					} else {
						
						header("Location: /admin/index.php?login=success");
						exit();
					
					}
					
				}
				
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
								<h1>User login</h1>
								
								<?php if (isset($error)){ ?>
									<h3 style="color: #aa0000"><?php echo $error ?></h3>
								<?php }?>
								<form action="login.php" method="post" autocomplete="off">
									<input type="text" name="username" placeholder="Username" />
									<input type="text" name="password" placeholder="Password" />
									<br />
									<input type="submit" value="Login" />
								</form>
								<p>Don't have an account? <a href=/signup.php>Create</a> one!</p>
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
