<div class="container" align="center">
	<div class="form-box">
			<div class="form-top">
	    		<div class="form-top-left">
	    			<h3>Daftar</h3>
	        		<p>Masukkan data dibawah dengan sesuai atau benar :</p>
	    		</div>
	    		<div class="form-top-right">
    			<i class="fa fa-pencil-alt"></i>
    		</div>
	        </div>
	        <div class="form-bottom">
	            <form action="<?php echo BASE_URL."/proses_register.php"; ?>" method="POST">

		            <?php

		            	$notif = isset($_GET['notif']) ? $_GET['notif'] : false;
		            	$nama = isset($_GET['nama']) ? $_GET['nama'] : false;
		            	$username = isset($_GET['username']) ? $_GET['username'] : false;
		            	$email = isset($_GET['email']) ? $_GET['email'] : false;
		            	$password = isset($_GET['password']) ? $_GET['password'] : false;
		            	$re_password = isset($_GET['re_password']) ? $_GET['re_password'] : false;


		            	if ($notif == "require") {
		            		echo "<div class='notif'><i class='fas fa-exclamation-circle'></i> Form di bawah masih ada yang belum diisi atau lengkap !!! <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Harap diisi dan dilengkapi </div> ";
		            	} elseif ($notif == "password") {
		            		echo "<div class='notif'><i class='fas fa-exclamation-circle'></i> Password tidak sama !!! </div> ";
		            	} elseif ($notif == "emailNusername") {
		            		echo "<div class='notif'><i class='fas fa-exclamation-circle'></i> Username dan Email yang digunakan sudah terdaftar !!! </div> ";
		            	} elseif ($notif == "email") {
		            		echo "<div class='notif'><i class='fas fa-exclamation-circle'></i> Email yang digunakan sudah terdaftar !!! </div> ";
		            	} elseif ($notif == "username") {
		            		echo "<div class='notif'><i class='fas fa-exclamation-circle'></i> Username yang digunakan sudah terdaftar !!! </div> ";
		            	} 

		            	function kesalahan1($kslh, $notiff){
		            		if ($notiff == "require") {
		            			if (empty($kslh)) {
		            				echo "wrong";
		            			}
		            		}
		            	}

		            	function kesalahan2($kslh, $notiff, $nama){
		            		if ($notiff == "require") {
		            			if (empty($kslh)) {
		            				echo "<p class='textP'>$nama harus diisi</p>";
		            			}
		            		}
		            	}

		            ?>

	            	<div class="form-group">
	                	<input type="text" name="nama" value="<?php echo $nama;?>" placeholder="Nama..." class="form-control <?php echo kesalahan1($nama, $notif);?>">

	                	<?php kesalahan2($nama, $notif, 'Nama');?>
	                </div>
	                <div class="form-group">
	                	<input type="text" name="username" value="<?php echo $username; ?>" placeholder="Username..." class="form-control <?php echo kesalahan1($username, $notif);?>">

	                	<?php kesalahan2($username, $notif, 'Username');?>
	                </div>
	                <div class="form-group">
	                	<input type="email" name="email" value="<?php echo $email;?>" placeholder="Email..." class="form-control <?php echo kesalahan1($email, $notif);?>">

	                	<?php kesalahan2($email, $notif, 'Email');?>
	                </div>
	                <div class="form-group">
	                	<input type="password" name="password" placeholder="Password..." class="form-control <?php echo kesalahan1($password, $notif);?>"" minlength="8">
	                	<?php kesalahan2($password, $notif, 'Password');?>
	                </div>
	                <div class="form-group">
	                	<input type="password" name="re_password" placeholder="Re-type Password..." class="form-control <?php echo kesalahan1($re_password, $notif);?>"" minlength="8">
	                	<?php kesalahan2($re_password, $notif, 'Re_Password');?>
	                </div>
	                <div class="form-group">
	                	<button type="submit" name="submit" class="btn btn-success">Sign up</button>
	                </div>
	                <div class="form-group">
	                	<p id="pRegister">Sudah punya akun? <a class="aRegister" href="<?php echo BASE_URL."/index.php?page=login"; ?>">Silahkan login</a></p>
	                </div>
	            </form>
	        </div>
		</div>
</div>
