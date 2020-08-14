<?php

/** 
 * A function that gets data from a CSV file
 * 
 * @param string $filename CSV file's name
 * @return array All the file's contents
*/
function get_data_from_csv(string $filename)
{
    $file = fopen($filename, 'r');
    $data = array();
    
    if ($file) {
        while (($line = fgetcsv($file, 1000, ','))) {
            array_push($data, $line[0]);
        }
    }

    fclose($file);
    return $data;
}


function get_available_brands(string $database_path)
{
    $brands = array_diff(scandir($database_path), array('.', '..'));
    foreach ($brands as $key => $brand) {
        $brands[$key] = basename($brand, '.csv'); // Removes the file extension
    }
    return ($brands);
}