<?php
session_start();

$path = $_SERVER['DOCUMENT_ROOT'] . '/database/payments/';
date_default_timezone_set('Europe/Paris');
$date = date('d/m/Y');
$contents = $date . '-' . $_POST['brand'] . '-' . $_POST['model'] . '-' . $_POST['price'] . "\n";

$file = fopen($path . $_SESSION['username'] . '.txt', 'a');
fwrite($file, $contents);
fclose($file);
//modification du fichier json de la voiture pour dire qu'elle est réservée
$database_path = $_SERVER['DOCUMENT_ROOT'] . '/database/cars/';
$full_path     = $database_path . str_replace(' ', '_', $_POST['brand']) . '-' . str_replace(' ', '_', $_POST['model']) . '.JSON';
$raw_file = file_get_contents($full_path);
$decoded_file = json_decode($raw_file, true);
$decoded_file['reservation'] = true;
$encoded_data = json_encode($decoded_file, JSON_FORCE_OBJECT);
file_put_contents($full_path, $encoded_data);

echo json_encode(array('success'=>true));
?>