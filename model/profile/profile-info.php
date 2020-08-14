<?php

function get_user_info(string $username)
{
    $prefix = $_SERVER['DOCUMENT_ROOT'] . '/database/users/';
    $suffix = '.JSON';
    $filename = $prefix . $username . $suffix;

    $file = file_get_contents($filename);
    $file = json_decode($file, true);

    return $file;
}


function modif_user_info(string $username, string $userInfo, string $new_value){
    $prefix = $_SERVER['DOCUMENT_ROOT'] . '/database/users/';
    $suffix = '.JSON';
    $filename = $prefix . $username . $suffix;

    $file = file_get_contents($filename);
    $file = json_decode($file, true);

    $file[$userInfo] = $new_value;
    echo $new_value;
    $file = json_encode($file, true);
    file_put_contents($filename, $file);
}


function modif_user_passwd(string $username, string $old_passwd, string $new_passwd, string $verif_new_passwd){
    $prefix = $_SERVER['DOCUMENT_ROOT'] . '/database/users/';
    $suffix = '.JSON';
    $filename = $prefix . $username . $suffix;

    $file = file_get_contents($filename);
    $file = json_decode($file, true);
    $password_hash = $file['passwd'];

    if ($new_passwd == $verif_new_passwd) {
        echo 'new passwords match';
        if(password_verify($old_passwd, $password_hash)) {
            echo 'old password correct';
            $new_value = password_hash($new_passwd, PASSWORD_DEFAULT);
            $file['passwd'] = $new_value;
            $file = json_encode($file, true);
            file_put_contents($filename, $file);
            echo 'password changed';
        }
    } 
}

if (isset($_POST['new_username'])) {
    modif_user_info($_POST['old_username'], $_POST['type'], $_POST['new_username']);
    rename($_SERVER['DOCUMENT_ROOT'] . "/database/users/" . $_POST['old_username'] . ".JSON", $_SERVER['DOCUMENT_ROOT'] . "/database/users/" . $_POST['new_username'] . ".JSON");
} else if (isset($_POST['new_first_name'])) {
    modif_user_info($_POST['username'], $_POST['type'], $_POST['new_first_name']);
} else if (isset($_POST['new_last_name'])) {
    modif_user_info($_POST['username'], $_POST['type'], $_POST['new_last_name']);
} else if (isset($_POST['new_mail'])) {
    modif_user_info($_POST['username'], $_POST['type'], $_POST['new_mail']);
} else if (isset($_POST['new_age'])) {
    modif_user_info($_POST['username'], $_POST['type'], $_POST['new_age']);
} else if (isset($_POST['new_job'])) {
    modif_user_info($_POST['username'], $_POST['type'], $_POST['new_job']);
} else if (isset($_POST['new_delivery_city'])) {
    modif_user_info($_POST['username'], $_POST['type'], $_POST['new_delivery_city']);
} else if (isset($_POST['new_delivery_code'])) {
    modif_user_info($_POST['username'], $_POST['type'], $_POST['new_delivery_code']);
} else if (isset($_POST['new_delivery_adress'])) {
    modif_user_info($_POST['username'], $_POST['type'], $_POST['new_delivery_adress']);
} else if (isset($_POST['new_billing_adress'])) {
    modif_user_info($_POST['username'], $_POST['type'], $_POST['new_billing_adress']);
} else if (isset($_POST['new_billing_code'])) {
    modif_user_info($_POST['username'], $_POST['type'], $_POST['new_billing_code']);
} else if (isset($_POST['new_billing_city'])) {
    modif_user_info($_POST['username'], $_POST['type'], $_POST['new_billing_city']);
} else if (isset($_POST['new_passwd'])) {
    modif_user_passwd($_POST['username'], $_POST['old_passwd'], $_POST['new_passwd'], $_POST['verif_new_passwd']);
}

?>