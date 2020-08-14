<?php
$result = 'failed';

$name = explode(" ", $_POST['car']);
$database_path = $_SERVER['DOCUMENT_ROOT'] . '/database/cars/';
$suffix        = '.JSON';
$full_path     = $database_path . $name[0] . "-" . $name[1] . $suffix;

$raw_file = file_get_contents($full_path);
$decoded_file = json_decode($raw_file, true);
if ($_POST['status'] == 1) {
    $decoded_file['reservation'] = false;
    $encoded_data = json_encode($decoded_file, JSON_FORCE_OBJECT);
    file_put_contents($full_path, $encoded_data);
    $result = 'success';
} else {
    $decoded_file['reservation'] = true;
    $encoded_data = json_encode($decoded_file, JSON_FORCE_OBJECT);
    file_put_contents($full_path, $encoded_data);
    $result = 'success';
}

$result = ($result == 'success') ? json_encode(array('success'=>true)) : json_encode(array('success'=>false));
echo $result;

?>