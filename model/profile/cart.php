<?php

function get_cart(string $username)
{
    // Path :
    $database_path = $_SERVER['DOCUMENT_ROOT'] . '/database/reservations/';
    $filename      = 'reservations-' . $username . '.txt';
    $full_path     = $database_path . $filename;

    // Init :
    $cart = array();
    $i = 0;

    // Information to display in cart page on website :
    $info = array('date', 'brand', 'model', 'price');
    
    // If file exists :
    if (file_exists($full_path)) {
        // Get data from file :
        $file = fopen($full_path, 'r');
        while (($line = fgets($file)) !== false) {
            $data = explode('-', $line);
            foreach ($info as $key => $value) {
                $cart[$i][$value] = $data[$key+1];
            }
            $i++;
        }
        fclose($file);
    }
    

    return($cart);
}

?>