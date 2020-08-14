<?php 

$archive_name = 'coven-admin-files.zip';

if (isset($_POST['download'])) {
    $zip = new ZipArchive;

    if ($zip->open($archive_name, ZipArchive::CREATE) === TRUE) {
        // Add filter_fields folder :
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/database/filter_fields/';
        if ($handle = opendir($folder)) {
            while (false !== ($entry = readdir($handle))) {
                if (($entry != ".") && ($entry != "..")) {
                    $zip->addFile($folder . $entry, 'recherche/' . $entry);
                }
            }
            closedir($handle);
        }

        // Add inventory folder :
        $folder = $_SERVER['DOCUMENT_ROOT'] . '/database/inventory/';
        if ($handle = opendir($folder)) {
            while (false !== ($entry = readdir($handle))) {
                if (($entry != ".") && ($entry != "..")) {
                    $zip->addFile($folder . $entry, 'voitures/' . $entry);
                }
            }
            closedir($handle);
        }
    
        // All files are added, so close the zip file :
        $zip->close();

        // Send the file to the browser as a download :
        header("Content-disposition: attachment; filename=$archive_name");
        header('Content-type: application/zip');
        readfile($archive_name);
    }
}

?>