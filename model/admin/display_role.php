<?php
$result = 'failed';

$database_path = $_SERVER['DOCUMENT_ROOT'] . '/database/users/';
$suffix        = '.JSON';
$full_path     = $database_path . $_POST['user'] . $suffix;

$raw_file = file_get_contents($full_path);
$decoded_file = json_decode($raw_file, true);
$result = $decoded_file['role'];

echo json_encode($result);
?>