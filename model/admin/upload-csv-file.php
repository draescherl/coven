<?php


function upload_file(string $form_name, string $form_type, string $upload_to_path)
{
    // Get uploaded file name and type :
    $filename  = $_FILES[$form_name]['name'];
    $location  = $upload_to_path . $filename;
    $file_type = pathinfo($location, PATHINFO_EXTENSION);

    // Check if file type is correct :
    $valid_extensions = array("csv");
    if (!in_array(strtolower($file_type), $valid_extensions)) {
        return false;
    }

    // Rename file if necessary :
    switch ($form_type) {
        case 'year': $new_filename = 'model_year.' . $file_type;
        break;

        case 'type': $new_filename = 'vehicle_type.' . $file_type;
        break;
        
        default: $new_filename = $filename;
        break;
    }

    // Upload file :
    $new_location = $upload_to_path . $new_filename;
    return (move_uploaded_file($_FILES[$form_name]['tmp_name'], $new_location));
}


function upload_file_by_type(string $form_type, string $form_name)
{
    $path = $_SERVER['DOCUMENT_ROOT'] . '/database/';

    switch ($form_type) {
        case 'year': $path .= 'filter_fields/';
        break;

        case 'type': $path .= 'filter_fields/';
        break;
        
        default: $path .= 'inventory/';
        break;
    }

    return (upload_file($form_name, $form_type, $path));
}

echo (upload_file_by_type($_POST['type'], 'file')) ? 'success':'failed';

?>