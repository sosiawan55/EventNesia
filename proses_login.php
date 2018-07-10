<?php

	include_once("function/koneksi.php");
	include_once("function/helper.php");

	$name = $_POST['name'];
	$password = md5($_POST['password']);
	$check_email = Is_email($name);

	if($check_email){
	    // email & password combination
	    $query = $koneksi->prepare("SELECT * FROM user WHERE email=:name AND password=:password");
	    $array_execute['name'] = $name;
	    $array_execute['password'] = $password;
	    $query->execute($array_execute);
	    // $query = mysqli_query($koneksi, "SELECT * FROM user WHERE email='$name' AND password='$password'");
	} else {
	    // username & password combination
	    $query = $koneksi->prepare("SELECT * FROM user WHERE username=:name AND password=:password");
	    $array_execute['name'] = $name;
	    $array_execute['password'] = $password;
	    $query->execute($array_execute);
    	// $query = mysqli_query($koneksi, "SELECT * FROM user WHERE username='$name' AND password='$password'");
	}

	if ($query->rowCount() == 0) {
		header("location: ".BASE_URL."/index.php?page=login&notif=gagal");
	} else {

		//$row = mysqli_fetch_assoc($query);

		$result = $query->fetchAll(PDO::FETCH_ASSOC);

		foreach ($result as $rows) {
			session_start();

			$_SESSION['user_id'] = $rows['user_id'];
			$_SESSION['username'] = $rows['username'];
			$_SESSION['level'] = $rows['level'];
		}

		header("location: ".BASE_URL."/");

	}

	function Is_email($user) {
    	//If the username input string is an e-mail, return true
	    if(filter_var($user, FILTER_VALIDATE_EMAIL)) {
	        return true;
    	} else {
        	return false;
	    }
	}

?>