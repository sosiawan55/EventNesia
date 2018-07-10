<?php

	if ($user_id) {
		header("location: ".BASE_URL);
	}

?>

<div class="container loginNregister-info" align="center">
	<div class="form-box">


		<?php

			$info = isset($_GET['info']) ? $_GET['info'] : false;
			$notif = isset($_GET['notif']) ? $_GET['notif'] : false;

			if ($info == "berhasil") {
				echo "<div class='info'><i class='fas fa-check'></i> Registrasi berhasil </div> ";
			}

			if ($notif == "gagal") {
				echo "<div class='notif'><i class='far fa-times-circle'></i> Email/Username dan Password tidak cocok </div> ";
			}

		?>

		<div class="form-top">
			<div class="form-top-left">
				<h3>Masuk</h3>
	    		<p>Masukkan Email dan Password dibawah :</p>
			</div>
			<div class="form-top-right">
				<i class="fas fa-lock"></i>
			</div>
	    </div>
	    <div class="form-bottom">
	        <form action="<?php echo BASE_URL."/proses_login.php"; ?>" method="post">
	        	<div class="form-group">
	            	<p id="pRegister">Belum punya akun? <a class="aRegister" href="<?php echo BASE_URL."/index.php?page=register"; ?>">Daftar di sini</a></p>
	            </div>
	            <div class="form-group">
	            	<input type="text" name="name" placeholder="Email/Username..." class="form-control">
	            </div>
	            <div class="form-group">
	            	<input type="password" name="password" placeholder="Password..." class="form-control">
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="btn btn-success">Sign in</button>
	            </div>
	        </form>
	    </div>
	</div>
</div>