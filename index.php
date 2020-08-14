<?php
session_start();

// Sets default role to user not logged in :
if (!isset($_SESSION['role'])) {
	$_SESSION['role'] = 0;
}

$view = 'view/'; // Path to view folder
require('controller/controller.php');

// Get page :
if (isset($_GET['action'])) {
	
	switch ($_GET['action']) {
		case 'home': home();
		break;

		case 'register': register();
		break;

		case 'login': login();
		break;

		case 'logout': logout();
		break;

		case 'admin': admin();
		break;

		case 'filter': filter();
		break;

		case 'add_car': add_car();
		break;

		case 'delete_car': delete_car();
		break;

		case 'who_are_we': who_are_we();
		break;

		case 'car_info': car_info();
		break;

		case 'profile': profile();
		break;

		case 'delete_from_cart': delete_from_cart();
		break;

		case 'check_reservations': check_reservations();
		break;

		case 'chat': chat();
		break;

		case 'payment': payment();
		break;

		case '401': error_401();
		break;
		
		default: error_404();
		break;
	}

} else {
	// Default page :
	home();
}