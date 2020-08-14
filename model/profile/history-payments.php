<?php

function get_payments(string $username)
{
    // Path :
    $database_path = $_SERVER['DOCUMENT_ROOT'] . '/database/payments/';
    $filename      = $username . '.txt';
    $full_path     = $database_path . $filename;

    // Init :
    $payments = array();
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
                $payments[$i][$value] = $data[$key];
            }
            $i++;
        }
        fclose($file);
    }
    

    return($payments);
}

?>