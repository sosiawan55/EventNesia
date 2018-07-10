	<?php 

	// Protect Login
	if ($user_id) {
		$module = isset($_GET['module']) ? $_GET['module'] : false;
		$action = isset($_GET['action']) ? $_GET['action'] : false;
		$mode = isset($_GET['mode']) ? $_GET['mode'] : false;
	} else {
		header("location: ".BASE_URL."/login.html");
	}

	if ($level != "admin") {
		$admin_page = array("users");
		if (in_array($module, $admin_page)) {
			header("location: ".BASE_URL);
		}
	}

?>

<div class="container my-profile">
	<div class="profile-left col-lg-3 col-xs-12">

		<?php

			if ($level == "admin") {
		?>
			<a <?php if($module=="events"){ echo "class='active'"; } ?> href="<?php echo BASE_URL."/index.php?page=my-profile&module=events&action=list" ?>">
				Events
			</a>
			<a <?php if($module=="users"){ echo "class='active'"; } ?> href="<?php echo BASE_URL."/index.php?page=my-profile&module=users&action=list" ?>">
				Users
			</a>
			<a href="<?php echo BASE_URL."/index.php?page=logout" ?>">
				Logout
			</a>
		<?php 
			} else {
		?>

			<a <?php if($module=="events"){ echo "class='active'"; } ?> href="<?php echo BASE_URL."/index.php?page=my-profile&module=events&action=list" ?>">
				Events
			</a>

			<a <?php if($module=="profile"){ echo "class='active'"; } ?> href="<?php echo BASE_URL."/index.php?page=my-profile&module=profile&action=form" ?>">
				Profile
			</a>
			<a <?php if($module=="ubah-password"){ echo "class='active'"; } ?> href="<?php echo BASE_URL."/index.php?page=my-profile&module=ubah-password&action=form" ?>">
				Ubah Password
			</a>
			<a href="<?php echo BASE_URL."/index.php?page=logout" ?>">
				Logout
			</a>

		<?php 
			}
		?>
		
	</div>
	<div class="profile-right col-lg-9 col-xs-12">
		<?php

			$file = "module/$module/$action.php";

			if (file_exists($file)) {
				include_once($file);
			} else {
				echo "<h3>Maaf, Halaman tersebut tidak ditemukan.</h3>";
			}

		?>
	</div>
</div>