<?php
	
		
	// Error Reporting
	ini_set('display_errors', 'On');
	error_reporting(E_ALL);
	
	include 'connect.php';	

	//Routes
	$tpl = 'includes/templates/'; //Template Directory
	$func = 'includes/functions/'; // Function Directory
	$css = 'layout/css/'; //Css Directory
	$js = 'layout/js/'; //Js Directory 
	
	
	//Include the important files
	include $func .'functions.php';
	include $tpl.'header.php';
	
	
	// Include Navbar on all pages expect the one with $noNavbar variable

	if(!isset($noNavbar)){	include $tpl.'navbar.php'; 	}

	
	?>



	