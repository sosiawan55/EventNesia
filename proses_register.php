<?php

	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$level = "pengguna";
	$status = "on";
	$nama = $_POST['nama'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$password = $_POST['password'];
	$re_password = $_POST['re_password'];

	unset($_POST['password']);
	unset($_POST['re_password']);

	$dataForm = http_build_query($_POST);

	$queryEmail = $koneksi->prepare("SELECT * FROM user WHERE email=:email");
	$array_execute1['email'] = $email;
	$queryEmail->execute($array_execute1);

	$queryUsername = $koneksi->prepare("SELECT * FROM user WHERE username=:username");
	$array_execute2['username'] = $username;
	$queryUsername->execute($array_execute2);


	if (empty($nama) || empty($email) || empty($username) || empty($password) || empty($re_password) ) {
		header("location: ".BASE_URL."/index.php?page=register&notif=require&$dataForm");
	} elseif ($password!= $re_password) {
		header("location: ".BASE_URL."/index.php?page=register&notif=password&$dataForm");
	} elseif ($queryEmail->rowCount() == 1 && $queryUsername->rowCount() == 1) {
		header("location: ".BASE_URL."/index.php?page=register&notif=emailNusername&$dataForm");
	} elseif ($queryEmail->rowCount() == 1) {
		header("location: ".BASE_URL."index.php?page=register&notif=email&$dataForm");
	} elseif ($queryUsername->rowCount() == 1) {
		header("location: ".BASE_URL."/index.php?page=register&notif=username&$dataForm");
	} else {
		
		$password = md5($password);

		$query = $koneksi->prepare("INSERT INTO user (level, nama, username, email, password) VALUES (:level, :nama, :username, :email, :password)");
		
		$array_execute['level'] = $level;
		$array_execute['nama'] = $nama;
		$array_execute['username'] = $username;
		$array_execute['email'] = $email;
		$array_execute['password'] = $password;
		$query->execute($array_execute);

		//mysqli_query($koneksi, "INSERT INTO user (level, nama, username, email, password) VALUES ('$level', '$nama', '$username', '$email', '$password')");
		header("location: ".BASE_URL."/index.php?page=login&info=berhasil");
		
	}

?>