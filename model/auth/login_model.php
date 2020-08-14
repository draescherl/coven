<?php

// If the user has sent a username and a password :
if (isset($_POST['username']) && isset($_POST['password'])) {

    // Path to the file :
    $prefix = $_SERVER['DOCUMENT_ROOT'] . '/database/users/';
    $username = $_POST['username'];
    $suffix = '.JSON';
    $filename = $prefix . $username . $suffix;

    // If the file exists :
    if (file_exists($filename)) {
        
        // Get all necessary data :
        $file = file_get_contents($filename);
        $file = json_decode($file, true);
        $password_user = $_POST['password'];
        $password_hash = $file['passwd'];

        // If password from form matches the one from the database :
        if(password_verify($password_user, $password_hash)) { 
            // Set necessary session variables :
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $file['role'];

            // Send success signal to view :
            echo "Success";
        } else {
            // If password doesn't match, send fail signal to view :
            echo "Failed";
        }

    } else { 
        // If file doesn't exist, send fail signal to view :
        echo "Failed";
    }
}

?>