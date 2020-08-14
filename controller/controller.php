<?php

/* Import necessary librairies */
require('model/admin/enumerate.php');
require('model/auth/register_model.php');
require('model/filter/get-filter-fields.php');
require('model/home/home_model.php');
require('model/home/date-order_model.php');
require('model/profile/cart.php');
require('model/profile/remove-from-cart_model.php');
require('model/profile/profile-info.php');
require('model/profile/card-infos.php');
require('model/profile/history-payments.php');


/** 
 * A function that gets the path to the file given as a parameter by adding the path to the view folder
 * 
 * @param string $page_name The name of the view you want to access
 * @return string Full path to the file
*/
function get_page(string $page_name = "") : string
{
    return($GLOBALS['view'] . $page_name);
}



/* ---------------------------------------------------- */
/* ---- Functions that link to the different pages ---- */
/* ---------------------------------------------------- */

/* ===Admin=== */
function admin()
{
    $cars = cars_enumerate();
    $users = users_enumerate();
    require (get_page('admin/admin.php'));
}
/* =========== */



/* ===Auth=== */
function register()
{
    require (get_page('auth/user_register.php'));
    if (isset($_POST['action'])) {
        $data = new data; // The data that will be written in the files
        $data->create_user();
    }
}

function login()
{
    require (get_page('auth/user_login.php'));
}

function logout()
{
    require (get_page('auth/user_logout.php'));
}
/* ========== */



/* ===Chat=== */
function chat()
{
    $users = users_enumerate();
    require (get_page('chat/chat.php'));
}
/* ========== */


/* ===Errors=== */
function error_404()
{
    require (get_page('errors/404.php'));
}

function error_401()
{
    require (get_page('errors/401.php'));
}
/* ============ */



/* ===Home=== */
function home()
{
    $database_path = $_SERVER['DOCUMENT_ROOT'] . '/database/cars/';
    $latest_cars   = array();
    $dates         = order_by_latest_creation_date();
    $carousel_size = 3;
    
    // Get all cars in the database :
    $cars = array_diff(scandir($database_path), array('.', '..'));

    // Get the latest adverts :
    foreach ($dates as $date) {
        if ($dir = opendir('./database/cars')) {

			while (($file = readdir($dir)) !== false) {
				if ( ($file != '.') && ($file != '..') ) {
                    // If car is one of the latest to be added :
					if (date("d m Y H:i:s.", filemtime($database_path . $file)) == $date) {
                        // Keeps only the last three (3 = $carousel_size) :
						if (count($latest_cars) < $carousel_size) {
							$latest_cars[count($latest_cars)] = get_car($database_path . $file);
						}
					}
				}
			}
            closedir($dir);

        }
    }

    // Get all adverts :
    foreach ($cars as $key => $value) {
        $cars[$key] = get_car($database_path . $value);
    }
    
    require (get_page('home/home.php'));
}

function car_info()
{
    $database_path = $_SERVER['DOCUMENT_ROOT'] . '/database/cars/';

    if (isset($_GET['car'])) {
        $path = $database_path . $_GET['car'] . '.JSON';
        if (file_exists($path)) {
            $car = get_car($path);
            require (get_page('home/car_info.php'));
        } else {
            require (get_page('errors/404.php'));
        }
    } else {
        require (get_page('errors/404.php'));
    }
}
/* ========== */



/* ===Profile=== */
function profile()
{
    if (isset($_SESSION['username'])) {
        $info = get_user_info($_SESSION['username']);
        $cart = get_cart($_SESSION['username']);
        $payments = get_payments($_SESSION['username']);
    }
    require (get_page('profile/profile.php'));
}

function delete_from_cart()
{
    $reservation_path = $_SERVER['DOCUMENT_ROOT'] . '/database/reservations/';
    $car_path = $_SERVER['DOCUMENT_ROOT'] . '/database/cars/';

    // If user is logged in :
    if (isset($_SESSION['username'])) {

        // If car is set :
        if (isset($_GET['id'])) {
            $reservation_file = $reservation_path . 'reservations-' . $_SESSION['username'] . '.txt';
            $car_file = $car_path . $_GET['id'] . '.JSON';

            // If car exists and user has a cart :
            if (file_exists($car_file) && file_exists($reservation_file)) {
                remove_from_cart($reservation_file, $_GET['id']);
                require (get_page('profile/remove_from_cart.php'));
            } else {
                require (get_page('errors/404.php'));
            }

        } else {
            require (get_page('errors/404.php'));
        }
        
    } else {
        require (get_page('errors/404.php'));
    }
}

function payment()
{
    $infos = get_infos();
    // If car is set :
    if (isset($_GET['id'])) {
      $car = explode("-", $_GET['id']);
    }
    require (get_page('profile/payment.php'));
}
/* ============= */



/* ===Filter=== */
function filter()
{
    $filter_path    = $_SERVER['DOCUMENT_ROOT'] . '/database/filter_fields/';
    $inventory_path = $_SERVER['DOCUMENT_ROOT'] . '/database/inventory/';
    
    /* Arrays to be passed to the view */
    $brands       = get_available_brands($inventory_path);
    $model_year   = get_data_from_csv($filter_path . 'model_year.csv');
    $vehicle_type = get_data_from_csv($filter_path . 'vehicle_type.csv');

    require (get_page('filter/filter_cars.php'));
}
/* ============ */



/* ===Staff=== */
function add_car()
{
    $inventory_path = $_SERVER['DOCUMENT_ROOT'] . '/database/inventory/';
    $filter_path    = $_SERVER['DOCUMENT_ROOT'] . '/database/filter_fields/';

    $model_year   = get_data_from_csv($filter_path . 'model_year.csv');
    $vehicle_type = get_data_from_csv($filter_path . 'vehicle_type.csv');

    /* List of brands to be passed to the view */
    $brands = array_diff(scandir($inventory_path), array('.', '..'));
    foreach ($brands as $key => $value) {
        $brands[$key] = basename($value, '.csv'); // Removes the file extension
    }

    require (get_page('staff/add_car.php'));
}

function delete_car()
{
    $cars = cars_enumerate();
    require (get_page('staff/delete_car.php'));
}

function check_reservations()
{
    $database_path = $_SERVER['DOCUMENT_ROOT'] . '/database/reservations/';

    // Get all users that have made reservations :
    $users = array_diff(scandir($database_path), array('.', '..'));
    foreach ($users as $key => $value) {
        $username = explode('-', $value);
        $users[$key] = basename($username[1], '.txt'); // Removes the file extension
    }

    $reservations = array();
    foreach ($users as $username) {
        $reservations[$username] = get_cart($username);
    }

    require (get_page('staff/check_reservations.php'));
}
/* =========== */




/* ===Who are we=== */
function who_are_we()
{
    require (get_page('who_are_we/who_are_we.php'));
}
/* ================ */