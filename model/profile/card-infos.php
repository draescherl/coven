<?php

function get_infos() {
    $database_path = $_SERVER['DOCUMENT_ROOT'] . '/database/users/';
    $infos=array();

    if (file_exists($database_path . $_SESSION['username'] . '.JSON')){
        $raw_file = file_get_contents($database_path . $_SESSION['username'] . '.JSON');
        $decoded_file = json_decode($raw_file, true);
        //delivery adress
        array_push($infos, $decoded_file["delivery_address"]);
        array_push($infos, $decoded_file["delivery_city"]);
        array_push($infos, $decoded_file["delivery_code"]);
        //billing adress
        array_push($infos, $decoded_file["billing_address"]);
        array_push($infos, $decoded_file["billing_city"]);
        array_push($infos, $decoded_file["billing_code"]);
        return($infos);
    }
}