<?php
	
	$server = "localhost";
	$username = "root";
	$password = "";
	$database = "eventnesia";

	$koneksi = new PDO("mysql:host=$server;dbname=$database", $username, $password);
