<?php

	include_once("../../function/koneksi.php");
	include_once("../../function/helper.php");
	
	$user_id = isset($_GET['user_id']) ? $_GET['user_id'] : false;

	$nama = $_POST['nama'];
	$username = $_POST['username'];
	$email = $_POST['email'];

	$query = $koneksi->prepare("UPDATE user SET nama=:nama, username=:username, email=:email WHERE user_id=:user_id");

	$array_execute['nama'] = $nama;
	$array_execute['username'] = $username;
	$array_execute['email'] = $email;	
	$array_execute['user_id'] = $user_id;
	$query->execute($array_execute);

	header("location: ".BASE_URL."/index.php?page=my-profile&module=profile&action=form&notif=berhasil");

?>