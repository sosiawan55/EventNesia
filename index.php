<?php
	
	session_start();

	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$page = isset($_GET['page']) ? $_GET['page'] : false;

	$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
	$username = isset($_SESSION['username']) ? $_SESSION['username'] : false;
	$level = isset($_SESSION['level']) ? $_SESSION['level'] : false;

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Web1</title>
	<link rel="stylesheet" href="/eventnesia/bootstrap-3.3.5/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="/eventnesia/bootstrap-3.3.5/css/style.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
    <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <script src="https://unpkg.com/sweetalert@2.1.0/dist/sweetalert.min.js"></script>
    
    <style type="text/css">
    	body {
			position: relative; 
		}
		.affix {
			top:0;
			width: 100%;
			z-index: 9999 !important;
		}
		.navbar {
			margin-bottom: 0px;
		}

		.affix ~ .container-fluid {
			position: relative;
			top: 50px;
		}
    </style>
    
</head>
<body>

	<header>
		<div class="container">
			<a href="<?php echo BASE_URL; ?>">
				<img src="<?php echo BASE_URL."/img/kel.jpg"; ?>" />
			</a>
		</div>
	</header>
	<nav class="navbar navbar-default" data-spy="affix" data-offset-top="150">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#tombolMenu" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
				</button>
			</div>
			<div class="collapse navbar-collapse" id="tombolMenu">
				<ul class="nav navbar-nav">
					<li>
						<a <?php if ($page=="") { echo "class='active'"; } ?> href="<?php echo BASE_URL; ?>"><i class="fas fa-home"></i> Home</a>
					</li>
		            <li>
		            	<a <?php if ($page=="festival") { echo "class='active'"; } ?> href="<?php echo BASE_URL."/index.php?page=festival"; ?>">Festival</a>
		            </li>
		            <li>
		            	<a <?php if ($page=="seminar") { echo "class='active'"; } ?> href="<?php echo BASE_URL."/index.php?page=seminar"; ?>">Seminar</a>
		            </li>
		            <li>
		            	<a <?php if ($page=="workshop") { echo "class='active'"; } ?> href="<?php echo BASE_URL."/index.php?page=workshop"; ?>">Workshop</a>
		            </li>
		            <li>
		            	<a <?php if ($page=="sports") { echo "class='active'"; } ?> href="<?php echo BASE_URL."/index.php?page=sports"; ?>">Sports</a>
		            </li>
		            <li>
		            	<a  <?php if ($page=="other-event") { echo "class='active'"; } ?> href="<?php echo BASE_URL."/index.php?page=other-event"; ?>">Other Event</a>
		            </li>
		            <li><a <?php if ($page=="about-us") { echo "class='active'"; } ?> href="<?php echo BASE_URL."/index.php?page=about-us"; ?>">About Us</a></li>
				</ul>
				<ul class="nav navbar-nav navbar-right">

					<?php
						if ($user_id) {
					?>
								<li>
									<a <?php if ($page=="my_profile") { echo "class='active'"; } ?> href="<?php echo BASE_URL.'/index.php?page=my-profile&module=events&action=list'; ?>"><i class='fas fa-user'><?php echo " ".$username ?></i></a>
								</li>
					<?php	
						} else {
					?>
							<li><a <?php if ($page=="login" || $page=="register") { echo "class='active'"; } ?> href="<?php echo BASE_URL.'/index.php?page=login'; ?>"><i class='fas fa-user'></i> Login/Register</a></li>
					<?php
						}
					?>

            		
				</ul>
			</div>
		</div>
	</nav>

	<main>
	
		<?php

			$filename = "$page.php";

			if (file_exists($filename)) {
				include_once($filename);
			} else {
				include_once("home.php");
			}
		?>

	</main>

	<footer>
	    <div class="cb" align="center">
			<a href="https://twitter.com/" target="_blank">
				<img src="/eventnesia/img/icon/twitter.png" alt="twitter icon" class="sosial">
			</a>
			<a href="https://www.facebook.com/" target="_blank">
				<img src="/eventnesia/img/icon/facebook.png" alt="facebook icon" class="sosial">
			</a>
			<a href="https://plus.google.com/" target="_blank">
				<img src="/eventnesia/img/icon/googleplus.png" alt="googleplus icon" class="sosial">
			</a>
	    </div>
	    <div class="cp">
			<p id="pPertama">&copy; 2018 Copyright Kelompok 1</p>
	    </div>
  	</footer>
	

	
  	<script src="https://www.google.com/recaptcha/api.js"></script>
	<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="bootstrap-3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.3/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

	<!-- Updated stylesheet url -->
	<link rel="stylesheet" href="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.css">

	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.3/jquery-ui.js"></script>

	<!-- Updated JavaScript url -->
	<script src="//jonthornton.github.io/jquery-timepicker/jquery.timepicker.js"></script>
</body>
</html>