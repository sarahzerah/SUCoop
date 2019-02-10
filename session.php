<?php

	session_start();

	//if a session hasn't started is still not set, redirect to login page
	if (!isset($_SESSION['userID'])) {
		header('Location:../index.php');
	}

?>

