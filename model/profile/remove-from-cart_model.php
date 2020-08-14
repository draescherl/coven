<?php

function remove_from_cart(string $path, string $GET)
{
    // Copy all lines except one to delete :
    $new_file = array();
    $file = fopen($path, 'r');
    while (($line = fgets($file)) !== false) {
        
        // If line doesn't contain GET :
        if (strpos($line, $GET) === false) {
            array_push($new_file, $line);
        }
        
    }
    fclose($file);

    // Delete file :
    unlink($path);

    // Paste all data :
    $file = fopen($path, 'a');
    foreach ($new_file as $line) {
        fputs($file, $line);
    }
    fclose($file);
}

?>