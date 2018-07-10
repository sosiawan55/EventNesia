<?php
	
	include_once("../../function/koneksi.php");
	include_once("../../function/helper.php");
	
	$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : false ;
	$password_lama = $_POST['password_lama'];
	$password_baru = $_POST['password_baru'];
	$konfirmasi_password = $_POST['konfirmasi_password'];

	if (empty($password_lama) || empty($password_baru) || empty($konfirmasi_password) )  {
		header("location: ".BASE_URL."/index.php?page=my-profile&module=ubah-password&action=form&notif=require");
	} elseif ($password_lama == $password_baru) {
		header("location: ".BASE_URL."/index.php?page=my-profile&module=ubah-password&action=form&notif=password");
	} elseif ($password_baru != $konfirmasi_password) {
		header("location: ".BASE_URL."/index.php?page=my-profile&module=ubah-password&action=form&notif=password_baru");
	} else {
		$password_lama = md5($password_lama);
		$password_baru = md5($password_baru);

		$query = $koneksi->prepare("UPDATE user SET password='$password_baru' WHERE user_id=:user_id");
		$array_execute['user_id'] = $user_id;
		$query->execute($array_execute);
		//mysqli_query($koneksi, "UPDATE user SET password='$password_baru' WHERE user_id='$user_id'");

		header("location: ".BASE_URL."/index.php?page=my-profile&module=ubah-password&action=form&notif=berhasil");

	}
?>