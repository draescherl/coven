<?php

function get_car(string $path)
{
    $file = file_get_contents($path);
    $file = json_decode($file, true);
    
    $fields = array('brand', 'model', 'price', 'desc', 'front', 'back', 'others', 'year', 'type', 'reservation');
    $data = array();
    foreach ($fields as $value) {
        $data[$value] = $file[$value];
    }

    return $data;
}

?>