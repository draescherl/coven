<?php

class car
{
    private $root;
    private $suffix     = '.JSON';
    private $media_path = '/media/cars/';
    private $db_path    = '/database/cars/';

    public function __construct() 
    { 
        $this->root = str_replace('\\', '/', $_SERVER['DOCUMENT_ROOT']);
    }


    private function resize_image($file, $new_width = 1920, $new_height = 1080)
    {
        $size  = getimagesize($file);
        
        // $ratio = $size[0]/$size[1]; // width/height
        // if($ratio > 1) {
        //     $width  = $new_width;
        //     $height = $new_width/$ratio;
        // } else {
        //     $width  = $new_height*$ratio;
        //     $height = $new_height;
        // }

        $width  = $new_width;
        $height = $new_height;
        
        $src = imagecreatefromstring(file_get_contents($file));
        $dst = imagecreatetruecolor($width, $height);
        
        imagecopyresampled($dst, $src, 0, 0, 0, 0, $width, $height, $size[0], $size[1]);
        imagedestroy($src);
        imagepng($dst, $file);
        imagedestroy($dst);
    }


    /** 
     * A function to upload a single image to the database
     * @return string path to the file if upload is successful, false otherwise 
     */
    private function upload_file(string $name, string $brand, string $model)
    {
        // Get uploaded file name and type :
        $filename  = $_FILES[$name]['name'];
        $location  = $this->root . $this->media_path . $filename;
        $file_type = pathinfo($location, PATHINFO_EXTENSION);

        // Rename file to brand-model-side.type : 
        $side          = (strpos($name, 'front')) ? 'front' : 'back';
        $new_file_name = $brand . '-' . $model . '-' . $side . '.' . $file_type;
        $new_location  = $this->root . $this->media_path . $new_file_name;

        // Check if file type is correct :
        $valid_extensions = array("jpg", "jpeg", "png");
        if (!in_array(strtolower($file_type), $valid_extensions)) {
            return false;
        }

        // Resize image :
        //$this->resize_image($_FILES[$name]['tmp_name']);

        // Check if upload is successful :
        if (move_uploaded_file($_FILES[$name]['tmp_name'], $new_location)) {
            return $this->media_path . $new_file_name;
        }

        return false;
    }

    
    /** 
     * A function to upload multiple images to the database
     * @return array paths to the files if upload is successful, false otherwise 
     */
    private function upload_files(string $name, string $brand, string $model)
    {
        $continue = true;
        $i        = 0;
        $total    = count($_FILES[$name]['name']);
        $paths    = array();

        // Continue while there are still images to be uploaded or if an error occured :
        while (($i < $total) && $continue) {
            // Get uploaded file name and type :
            $filename  = $_FILES[$name]['name'][$i];
            $location  = $this->root . $this->media_path . $filename;
            $file_type = pathinfo($location, PATHINFO_EXTENSION);

            // Rename file to brand-model-others-i.type : 
            $new_file_name = $brand . '-' . $model . '-others-' . $i . '.' . $file_type;
            $new_location  = $this->root . $this->media_path . $new_file_name;

            // Check if file type is correct :
            $valid_extensions = array("jpg", "jpeg", "png");
            if (!in_array(strtolower($file_type), $valid_extensions)) {
                !$continue;
            }

            // Resize image :
            //$this->resize_image($_FILES[$name]['tmp_name'][$i]);

            // Check if upload is successful :
            if ($continue && move_uploaded_file($_FILES[$name]['tmp_name'][$i], $new_location)) {
                array_push($paths, $this->media_path . $new_file_name);
            } else {
                !$continue;
            }

            $i++;
        }
        
        // Check if all files have been uploaded :
        $res = (count($paths) == $total) ? $paths : false;
        return $res;
    }


    /** 
     * A function that creates a car in the database
     * @return boolean true if upload to database is successful, false otherwise
     */
    public function add_car(string $brand, string $model, string $price, string $desc, string $type, string $year)
    {
        $brand_formated = strtolower(str_replace(' ', '_', $brand));
        $model_formated = strtolower(str_replace(' ', '_', $model));

        $front  = $this->upload_file('file_front', $brand_formated, $model_formated);
        $back   = $this->upload_file('file_back', $brand_formated, $model_formated);
        $others = $this->upload_files('file_others', $brand_formated, $model_formated);

        if (($front !== false) && ($back !== false) && ($others !== false)) {
            
            // Set all necessary variables :
            $this->brand  = htmlspecialchars($brand);
            $this->model  = htmlspecialchars($model);
            $this->type   = htmlspecialchars($type);
            $this->year   = htmlspecialchars($year);
            $this->price  = htmlspecialchars($price);
            $this->desc   = htmlspecialchars($desc);
            $this->front  = htmlspecialchars($front);
            $this->back   = htmlspecialchars($back);
            $this->others = $others;
            $this->reservation = false;

            // Write data to files :
            $file = fopen(
                $this->root . $this->db_path . str_replace(' ', '_', $this->brand) . '-' . str_replace(' ', '_', $this->model) . $this->suffix, 'w'
            );
            fwrite($file, json_encode($this));
            fclose($file);

            return true;

        }
        
        return false;   
    }
}



$result = "Failed";

// Check if all fields have been filled :
if (   isset($_POST['brand']) 
    && isset($_POST['model']) 
    && isset($_POST['price']) 
    && isset($_POST['desc']) 
    && isset($_POST['model_year']) 
    && isset($_POST['vehicle_type'])
) {

    // Check if no data is empty
    if (   !empty($_POST['brand']) 
        && !empty($_POST['model']) 
        && !empty($_POST['price']) 
        && !empty($_POST['desc']) 
        && !empty($_POST['model_year']) 
        && !empty($_POST['vehicle_type'])
    ) {
        
        $car = new car;
        // Check if car adding was successfull :
        if ($car->add_car($_POST['brand'], $_POST['model'], $_POST['price'], $_POST['desc'], $_POST['vehicle_type'], $_POST['model_year'])) {
            $result = "Success";
        }

    }
}

echo $result;