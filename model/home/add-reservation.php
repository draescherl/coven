<?php
session_start();

function allow_reservation($filename, $brand, $model)
{
    if (file_exists($filename)) {
        $searched = $brand . '-' . $model;
        $file = fopen($filename, 'r');

        while (($line = fgets($file)) !== false) {
            if (strpos($line, $searched)) {
                return('already_exists');
            }
        }

        fclose($file);
    }
    
    return('success');
}

$database_path = $_SERVER['DOCUMENT_ROOT'] . '/database/reservations/';
$filename      = 'reservations-' . $_SESSION['username'] . '.txt';
$full_path     = $database_path . $filename;

$allowed = allow_reservation($full_path, $_POST['brand'], $_POST['model']);
if ($allowed === 'success') {
    $file = fopen($full_path, 'a');
    date_default_timezone_set('Europe/Paris');
    $date = date('h:i:s-d/m/Y');
    $contents = $date . '-' . $_POST['brand'] . '-' . $_POST['model'] . '-' . $_POST['price'] . "\n";

    fwrite($file, $contents);
    fclose($file);
}
echo $allowed;

?>