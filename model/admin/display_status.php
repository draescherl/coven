<?php
$result = 'failed';

$name = explode(" ", $_POST['car']);
$database_path = $_SERVER['DOCUMENT_ROOT'] . '/database/cars/';
$suffix        = '.JSON';
$full_path     = $database_path . $name[0] . "-" . $name[1] . $suffix;

$raw_file = file_get_contents($full_path);
$decoded_file = json_decode($raw_file, true);

if ($decoded_file['reservation'] == true) {
    $result = "0";
} else {
    $result = "1";
}
echo json_encode($result);
?>