<?php

	$notif = isset($_GET['notif']) ? $_GET['notif'] : false;

	if ($notif == "require") {
		echo "	<script>

					swal(
					  'Oops',
					  'Form masih ada yang belum diisi atau belum lengkap!',
					  'error'
					)

				</script>";

	} elseif ($notif == "password") {
		echo "	<script>

					swal(
					  'Oops',
					  'Password Baru tidak boleh sama dengan Password Lama',
					  'error'
					)

				</script>";

	} elseif ($notif == "password_baru") {
		echo "	<script>

					swal(
					  'Oops',
					  'Password Baru tidak sesuai dengan Konfirmasi Password',
					  'error'
					)

				</script>";
				
	} elseif ($notif == "berhasil") {
		echo "	<script>

					swal(
					  'Success',
					  'Password berhasil diubah',
					  'success'
					)

				</script>";
	}

	$button = "Change Password";


?>

<form action="<?php echo BASE_URL."/module/ubah-password/action.php?user_id=$user_id"?>" method="POST">
	
	<div class="form-group">
		<label for="password_lama">Password Lama</label>	
		<span><input type="password" class="form-control" id="password_lama" name="password_lama" /></span>
	</div>	

	<div class="form-group">
		<label for="password_baru">Password Baru</label>	
		<span><input type="password" class="form-control" id="password_baru" name="password_baru" minlength="8" /></span>
	</div>	

	<div class="form-group">
		<label for="konfirmasi_password">Re-type Password Baru</label>	
		<span><input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password"/></span>
	</div>

	<div class="form-group">
		<span>
			<input type="submit" class="btn btn-success btn-block" name="button" value="<?php echo $button; ?>" />
		</span>
	</div>	

</form>