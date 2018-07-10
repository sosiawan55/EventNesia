<?php
	
	$query = $koneksi->prepare("SELECT * FROM user WHERE user_id=:user_id");
	$array_execute['user_id'] = $user_id;
	$query->execute($array_execute);
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	foreach ($result as $row) {
		$nama = $row['nama'];
		$username = $row['username'];
		$email = $row['email'];
	}

	$button = "Change Profile";


?>

<form action="<?php echo BASE_URL."/module/profile/action.php?user_id=$user_id"; ?>" method="POST">

	<?php
		$notif = isset($_GET['notif']) ? $_GET['notif'] : false;

		if ($notif == "berhasil") {
			echo "	<script>

						swal(
						  'Success',
						  'Profile berhasil diubah',
						  'success'
						)

					</script>";
		}
	?>

	<div class="form-group">
		<label for="nama_input">Nama</label>
		<span><input type="text" class="form-control" id="nama_input" name="nama" value="<?php echo $nama; ?>" /></span>
	</div>
	<div class="form-group">
		<label for="username_input">Username</label>
		<span><input type="text" class="form-control" id="username_input" name="username" value="<?php echo $username; ?>" /></span>
	</div>
	<div class="form-group">
		<label for="email_input">Username</label>
		<span><input type="email" class="form-control" id="email_input" name="email" value="<?php echo $email; ?>" /></span>
	</div>
	<div class="form-group">
		<span>
			<input type="submit" class="btn btn-success btn-block" name="button" value="<?php echo $button; ?>" />
		</span>
	</div>
</form>