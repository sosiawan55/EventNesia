<?php
    include("../../function/koneksi.php");   
    include("../../function/helper.php");   
     
    $user_id = $_GET['user_id'];

	$level = $_POST["level"];

	$query = $koneksi->prepare("UPDATE user SET level=:level WHERE user_id=:user_id");
	$array_execute['level'] = $level;
	$array_execute['user_id'] = $user_id;
	$query->execute($array_execute);

    header("location: ".BASE_URL."/index.php?page=my-profile&module=users&action=list&notif=berhasil");
?>