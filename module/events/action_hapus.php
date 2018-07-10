<?php

	$event_id = isset($_GET['event_id']) ? $_GET['event_id'] : false;

	$query = $koneksi->prepare("DELETE FROM events WHERE event_id='$event_id'");

	$array_execute['event_id'] = $event_id;
	$query->execute($array_execute);

	header("location: ".BASE_URL."/index.php?page=my-profile&module=events&action=list&notif=hapus");
?>