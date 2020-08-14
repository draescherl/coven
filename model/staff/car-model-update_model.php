<?php

/** 
 * A function that gets data from a CSV file
 * 
 * @param string $filename CSV file's name
 * @return array All the file's contents
*/
function get_data(string $filename)
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

$database_path = $_SERVER['DOCUMENT_ROOT'] . '/database/inventory/';
// Stores all the models from a brand requested by the view through a POST request :
$models = get_data($database_path . $_POST['brand'] . '.csv');

// Sends array back to the view
echo json_encode($models);