<?php
	
	session_start(); //Start the session

	session_unset(); // Unset the data 	

	session_destroy(); // Destroy The Session	

	header("Location: sign_in.php");
