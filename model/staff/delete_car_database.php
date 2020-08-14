<?php

$result = 'failed';

if(isset($_POST['car'])) {
    if(!empty($_POST['car'])) {

        $names = explode(" ", $_POST['car']);
        $to_delete = array();

        $database_path = $_SERVER['DOCUMENT_ROOT'] . '/database/cars/';
        $suffix        = '.JSON';
        $full_path     = $database_path . $names[0] . "-" . $names[1] . $suffix;

        if (file_exists($full_path)) {

            $raw_file = file_get_contents($full_path);
            $decoded_file = json_decode($raw_file, true);
            
            foreach ($decoded_file['others'] as $other_image) {
                array_push($to_delete, $other_image);
            }

            $images = array('front', 'back');
            foreach ($images as $image) {
                array_push($to_delete, $decoded_file[$image]);
            }

            foreach ($to_delete as $image) {
                unlink($_SERVER['DOCUMENT_ROOT'] . $image);
            }
    
        } 

        $result = (unlink($full_path)) ? 'success' : 'failed';

    }
}

$result = ($result == 'success') ? json_encode(array('success'=>true)) : json_encode(array('success'=>false));
echo $result;