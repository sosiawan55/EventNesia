<?php 
	
	session_start();

	$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : false;
	$level = isset($_SESSION['level']) ? $_SESSION['level'] : false;

	include_once("../../function/koneksi.php");
	include_once("../../function/helper.php");

	$nama_event = $_POST['nama_event'];
	$kategori_id = $_POST['kategori_id'];
	$tanggal_mulai = date("Y-m-d", strtotime($_POST['tanggal_mulai']));
	$tanggal_selesai = date("Y-m-d", strtotime($_POST['tanggal_selesai']));
	$jam_mulai = date("h:i A", strtotime($_POST['jam_mulai']));
	$jam_selesai = date("h:i A", strtotime($_POST['jam_selesai']));
	$tempat = $_POST['tempat'];
	$deskripsi = $_POST['deskripsi'];
	$status = $_POST['status'];
	$button = $_POST['button'];
	$biaya = $_POST['biaya'];
	$view = 0;
	$update_gambar = "";

	$dataForm = http_build_query($_POST);

	if ($biaya != 0) {
		$biayaSel = $biaya;
	} else {
		$biayaSel = 0;
	}


	if (!empty($_FILES["file"]["name"])) {
		$nama_file = $_FILES["file"]["name"];
		move_uploaded_file($_FILES["file"]["tmp_name"], "../../img/event/".$nama_file);

		$update_gambar = ", gambar='$nama_file'";
	}
	

	if ($button == "Add") {

		if (empty($nama_event) || empty($deskripsi) || empty($nama_file) || empty($tempat) ) {

			header("location: ".BASE_URL."/index.php?page=my-profile&module=events&action=form&notif=require&$dataForm");

		} else {

			$query = $koneksi->prepare("INSERT INTO events (kategori_id, tanggal_mulai, tanggal_selesai, jam_mulai, jam_selesai, tempat, user_id, nama_event, deskripsi, gambar, biaya, status, view) VALUES (:kategori_id, :tanggal_mulai, :tanggal_selesai, :jam_mulai, :jam_selesai, :tempat, :user_id, :nama_event, :deskripsi, :nama_file, :biaya, :status, :view)");

			$array_execute['kategori_id'] = $kategori_id;
			$array_execute['tanggal_mulai'] = $tanggal_mulai;
			$array_execute['tanggal_selesai'] = $tanggal_selesai;
			$array_execute['jam_mulai'] = $jam_mulai;
			$array_execute['jam_selesai'] = $jam_selesai;
			$array_execute['tempat'] = $tempat;
			$array_execute['user_id'] = $user_id;
			$array_execute['nama_event'] = $nama_event;
			$array_execute['deskripsi'] = $deskripsi;
			$array_execute['nama_file'] = $nama_file;
			$array_execute['biaya'] = $biayaSel;
			$array_execute['status'] = $status;
			$array_execute['view'] = $view;

			$query->execute($array_execute);

			header("location: ".BASE_URL."/index.php?page=my-profile&module=events&action=list&notif=tambah");

		}

	} elseif ($button == "Update") {

		$event_id = $_GET['event_id'];
		
		if ($level == "pengguna") {

			$query = $koneksi->prepare("UPDATE events SET nama_event=:nama_event, kategori_id=:kategori_id, tanggal_mulai=:tanggal_mulai, tanggal_selesai=:tanggal_selesai, tempat=:tempat, deskripsi=:deskripsi, biaya=:biaya $update_gambar WHERE event_id=:event_id");

			$array_execute['nama_event'] = $nama_event;
			$array_execute['kategori_id'] = $kategori_id;
			$array_execute['tanggal_mulai'] = $tanggal_mulai;
			$array_execute['tanggal_selesai'] = $tanggal_selesai;
			$array_execute['tempat'] = $tempat;
			$array_execute['deskripsi'] = $deskripsi;
			$array_execute['biaya'] = $biayaSel;
			$array_execute['event_id'] = $event_id;

			$query->execute($array_execute);

		} else {

			$query = $koneksi->prepare("UPDATE events SET status=:status WHERE event_id=:event_id");

			$array_execute['status'] = $status;
			$array_execute['event_id'] = $event_id;

			$query->execute($array_execute);

		}

		header("location: ".BASE_URL."/index.php?page=my-profile&module=events&action=list&notif=berhasil");

	} else {
		header("location: ".BASE_URL."/index.php?page=my-profile&module=events&action=list");
	}

	unset($user_id);

?>