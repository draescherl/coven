<?php

function delete_user(string $username = '')
{
    $path_to_users        = $_SERVER['DOCUMENT_ROOT'] . '/database/users/' . $username . '.JSON';
    $path_to_reservations = $_SERVER['DOCUMENT_ROOT'] . '/database/reservations/reservations-' . $username . '.txt';
    $path_to_messages     = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']) . '/database/messaging/';

    // Delete user file :
    if (file_exists($path_to_users)) {
        unlink($path_to_users);
    }

    // Delete reservations :
    if (file_exists($path_to_reservations)) {
        unlink($path_to_reservations);
    }

    // Delete sent messages :
    foreach (glob($path_to_messages . $username . '-*.txt') as $filename) {
        unlink($filename);
    }

    // Delete received messages :
    foreach (glob($path_to_messages . '*-' . $username . '.txt') as $filename) {
        unlink($filename);
    }
}

function update_role(string $username = '', int $new_role = 1)
{
    $database_path = $_SERVER['DOCUMENT_ROOT'] . '/database/users/';
    $suffix        = '.JSON';
    $full_path     = $database_path . $username . $suffix;

    if ($new_role == 0) {
        delete_user($username);
        return true;
    }

    if (file_exists($full_path)) {

        $raw_file = file_get_contents($full_path);
        $decoded_file = json_decode($raw_file, true);
        $decoded_file['role'] = $new_role;
        $encoded_data = json_encode($decoded_file, JSON_FORCE_OBJECT);
        file_put_contents($full_path, $encoded_data);

        return true;

    } 

    return false;
}


// https://stackoverflow.com/questions/9059489/jquery-ajax-success-error
echo json_encode(array('success'=>update_role($_POST['username'], $_POST['role'])));

?>