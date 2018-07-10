<?php 

	$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : false;

	$nama_event = "";
	$kategori_id = "";
	$user_id = "";
	$tanggal_mulai = "";
	$tanggal_selesai = "";
	$jam_mulai = "";
	$jam_selesai = "";
	$tempat = "";
	$deskripsi = "";
	$gambar = "";
	$biaya = "";
	$status = "";
	$keterangan_gambar = "";
	$button = "Add";

	if ($event_id) {
		$query = $koneksi->prepare("SELECT * FROM events WHERE event_id=:event_id");
		$array_execute['event_id'] = $event_id;
		$query->execute($array_execute);
		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($result as $row) {
			$nama_event = $row['nama_event'];
			$kategori_id = $row['kategori_id'];
			$user_id = $row['user_id'];
			$tanggal_mulai = $row['tanggal_mulai'];
			$tanggal_selesai = $row['tanggal_selesai'];
			$jam_mulai = $row['jam_mulai'];
			$jam_selesai = $row['jam_selesai'];
			$tempat = $row['tempat'];
			$deskripsi = $row['deskripsi'];
			$gambar = $row['gambar'];
			$biaya = $row['biaya'];
			$status = $row['status'];
		}

		$button = "Update";

		$keterangan_gambar = "(Klik Browse... jika ingin mengubah gambar di bawah)";
		$gambar = "<img class='gbr' align='center' src='".BASE_URL."/img/event/$gambar' />";
	}

?>

	<script type="text/javascript" src="<?php echo BASE_URL."/file-pendukung/ckeditor/ckeditor.js"; ?>"></script>

<?php

	if ($level == "pengguna") {

?>
		<form action="<?php echo BASE_URL."/module/events/action.php?event_id=$event_id"; ?>" method="POST" enctype="multipart/form-data">

			<?php

				$notif = isset($_GET['notif']) ? $_GET['notif'] : false;
				$nama_event = isset($_GET['nama_event']) ? $_GET['nama_event'] : $nama_event;
				$kategori_id = isset($_GET['kategori_id']) ? $_GET['kategori_id'] : $kategori_id;
				$tanggal_mulai = isset($_GET['tanggal_mulai']) ? $_GET['tanggal_mulai'] : $tanggal_mulai;
				$tanggal_selesai = isset($_GET['tanggal_selesai']) ? $_GET['tanggal_selesai'] : $tanggal_selesai;
				$jam_mulai = isset($_GET['jam_mulai']) ? $_GET['jam_mulai'] : $jam_mulai;
				$jam_selesai = isset($_GET['jam_selesai']) ? $_GET['jam_selesai'] : $jam_selesai;
				$tempat = isset($_GET['tempat']) ? $_GET['tempat'] : $tempat;
				$deskripsi = isset($_GET['deskripsi']) ? $_GET['deskripsi'] : $deskripsi;
				$biaya = isset($_GET['biaya']) ? $_GET['biaya'] : $biaya;

				if ($notif == "require") {
					echo "<script>

							swal(
							  'Oops',
							  'Form masih ada yang belum diisi atau belum lengkap!',
							  'error'
							)

						</script>";
				}

			?>

			<div class="form-group">
				<label for="nama_event_input">Nama Event</label>
				<span><input type="text" class="form-control" id="nama_event_input" name="nama_event" value="<?php echo $nama_event; ?>" /></span>
			</div>
			<div class="form-group">
				<label>Kategori</label>
				<span>
					<select class="form-control" name="kategori_id">
						<?php
							$query = $koneksi->prepare("SELECT * FROM kategori");
							$query->execute();
							$result = $query->fetchAll(PDO::FETCH_ASSOC);
							
							foreach($result as $row) {

								if ($kategori_id == $row['kategori_id']) {
									echo "<option value='".$row['kategori_id']."' selected='true'>".$row['kategori']."</option>";
								} else {
									echo "<option value='".$row['kategori_id']."'>".$row['kategori']."</option>";
								}
							}
						?>
					</select>
				</span>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="tgl_mulai">Tanggal Mulai</label>
						<span>
							<input type="date" class="form-control" id="tgl_mulai" name="tanggal_mulai" value="<?php echo $tanggal_mulai; ?>">
						</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="tgl_selesai">Tanggal Selesai</label>
						<span>
							<input type="date" class="form-control" id="tgl_selesai" name="tanggal_selesai" value="<?php echo $tanggal_selesai; ?>">
						</span>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="jam_mulai">Jam Mulai</label>
						<span>
							<input type="text" class="form-control" id="jam_mulai" name="jam_mulai" value="<?php echo $jam_mulai; ?>">
						</span>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="jam_selesai">Jam Selesai</label>
						<span>
							<input type="text" class="form-control" id="jam_selesai" name="jam_selesai" value="<?php echo $jam_selesai; ?>">
						</span>
					</div>
				</div>


			</div>

			<div class="form-group">
				<label for="tempat">Kota</label>
				<span><input id="tempat" class="form-control" type="text" name="tempat" value="<?php echo $tempat; ?>" /></span>
			</div>
			<div class="form-group">
				<label for="deskripsi_area">Deskripsi</label>
				<span><textarea class="form-control" id="deskripsi_area"  name="deskripsi"><?php echo $deskripsi; ?></textarea></span>
			</div>
			<div class="form-group">
				<label for="biaya_input">Biaya</label>
				<span><input id="biaya_input" class="form-control" type="text" name="biaya" value="<?php echo $biaya; ?>" /></span>
			</div>
			<div class="form-group">
				<label>Image Event <?php echo $keterangan_gambar; ?></label>
				<span>
					<input type="file" class="btn btn-default" name="file" /><?php echo $gambar; ?>
				</span>
			</div>
			<div class="form-group">
				<label>Status</label>
				<span>
					<div class="radio">
						<?php 
							if ($button == "Add") {
						?>
									<label class="radioB">
										<input type="radio" name="status" value="on" disabled="" /> On
									</label>
									<label class="radioB">
										<input type="radio" name="status" value="off" checked="true" /> Off
									</label>
							
						<?php } else { ?>

									<label class="radioB">
										<input type="radio" name="status" value="on" <?php if($status == "on") { echo "checked='true'";} else { echo "disabled"; } ?> /> On
									</label>
									<label class="radioB">
										<input type="radio" name="status" value="off" <?php if($status == "off") { echo "checked='true'";} else { echo "disabled"; } ?> /> Off
									</label>
						<?php } ?>
					</div>
				</span>
			</div>
			<div class="form-group">
				<span>
					<input type="submit" class="btn btn-success btn-block" name="button" value="<?php echo $button; ?>">
					<input type="submit" class="btn btn-danger btn-block" name="cancel" value="Cancel" />
				</span>
			</div>
		</form>
<?php 
	} else {
?>
		<form action="<?php echo BASE_URL."/module/events/action.php?event_id=$event_id"; ?>" method="POST" enctype="multipart/form-data">

			<div class="form-group">
				<label for="nama_event_input">Nama Event</label>
				<span><input type="text" class="form-control" id="nama_event_input" name="nama_event" value="<?php echo $nama_event; ?>" disabled/></span>
			</div>
			<div class="form-group">
				<label>Kategori</label>
				<span>
					<select class="form-control" name="kategori_id">
						<?php
							$query = $koneksi->prepare("SELECT * FROM kategori");
							$query->execute();
							$result = $query->fetchAll(PDO::FETCH_ASSOC);
							foreach($result as $row) {

								if ($kategori_id == $row['kategori_id']) {
									echo "<option value='".$row['kategori_id']."' selected='true'>".$row['kategori']."</option>";
								}
							}
						?>
					</select>
				</span>
			</div>
			<div class="form-group">
				<label for="tempat">Kota</label>
				<span><input id="tempat" class="form-control" type="text" name="tempat" value="<?php echo $tempat; ?>" disabled/></span>
			</div>
			<div class="form-group">
				<label for="deskripsi_area">Deskripsi</label>
				<span><textarea class="form-control" id="deskripsi_area"  name="deskripsi" disabled><?php echo $deskripsi; ?></textarea></span>
			</div>
			<div class="form-group">
				<label for="biaya_input">Biaya</label>
				<span><input id="biaya_input" class="form-control" type="text" name="biaya" value="<?php echo $biaya; ?>" disabled /></span>
			</div>
			<div class="form-group">
				<label>Image Event <?php echo $keterangan_gambar; ?></label>
				<span>
					<input type="file" class="btn btn-default" name="file" disabled /><?php echo $gambar; ?>
				</span>
			</div>
			<div class="form-group">
				<label>Status</label>
				<span>
					<div class="radio">
						<label class="radioB">
							<input type="radio" name="status" value="on" <?php if($status == "on") { echo "checked='true'";} ?> /> On
						</label>
						<label class="radioB">
							<input type="radio" name="status" value="off" <?php if($status == "off") { echo "checked='true'";} ?> /> Off
						</label>
					</div>
				</span>
			</div>
			<div class="element-form">
				<span>
					<input type="submit" class="btn btn-success btn-block" name="button" value="<?php echo $button; ?>">
					<input type="submit" class="btn btn-danger btn-block" name="cancel" value="Cancel" />
				</span>
			</div>
		</form>
<?php
	}
?>

<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>



<script type="text/javascript">
	CKEDITOR.replace("deskripsi_area");

	$(function() {
	   $('#jam_mulai').timepicker({
	      timeFormat: 'h:i',
	      interval: 30,
	      dropdown: true,
	      scrollbar: true,
	  });
	});

	$(function() {
	   $('#jam_selesai').timepicker({
	      timeFormat: 'h:i',
	      interval: 30,
	      dropdown: true,
	      scrollbar: true,
	  });
	});

</script>