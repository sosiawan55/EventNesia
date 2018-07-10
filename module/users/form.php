<?php
      
    $user_id = isset($_GET['user_id']) ? $_GET['user_id'] : false ;
      
	$button = "Update";

	$queryUser = $koneksi->prepare("SELECT * FROM user WHERE user_id=:user_id");
	$array_execute['user_id'] = $user_id;
	$queryUser->execute($array_execute);
	$result = $queryUser->fetchAll(PDO::FETCH_ASSOC);
	
	foreach ($result as $row) {
		$nama = $row["nama"];
		$email = $row["email"];
		$level = $row["level"];
		$username = $row['username'];
	}

	
?>
<form action="<?php echo BASE_URL."/module/users/action.php?user_id=$user_id"?>" method="POST">
	  
	<div class="form-group">
		<label for="nama_input">Nama Lengkap</label>	
		<span><input type="text" class="form-control" id="nama_input" name="nama" value="<?php echo $nama; ?>" disabled/></span>
	</div>

	<div class="form-group">
		<label for="username_input">Username</label>	
		<span><input type="text" class="form-control" id="username_input" name="username_input" value="<?php echo $username; ?>" disabled/></span>
	</div>		

	<div class="form-group">
		<label for="email_input">Email</label>	
		<span><input type="text" class="form-control" id="email_input" name="email" value="<?php echo $email; ?>" disabled /></span>
	</div>			

	<div class="form-group">
		<label>Level</label>	
		<span>
			<div class="radio">
				<label class="radioB">
					<input type="radio" value="admin" name="level" <?php if($level == "admin"){ echo "checked"; } ?> /> Admin
				</label>
				<label class="radioB">
					<input type="radio" value="pengguna" name="level" <?php if($level == "pengguna"){ echo "checked"; } ?> /> Pengguna
				</label>
			</div>
		</span>
	</div>			
	  
	<div class="form-group">
		<span>
			<input type="submit" class="btn btn-success btn-block" name="button" value="<?php echo $button; ?>" />
			<input type="submit" class="btn btn-danger btn-block" name="cancel" value="Cancel" />
		</span>
	</div>	
</form>