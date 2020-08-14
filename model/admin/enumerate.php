<?php

function users_enumerate(){
    $users=array();
    if($dir = opendir('./database/users')){
        while(false !== ($file = readdir($dir))){
            if($file != '.' && $file != '..' && $file != '--roles--.txt'){
                $data = file_get_contents("./database/users/".$file);
				$obj = json_decode($data);
                array_push($users, $obj);
            }
        }
    }
    return($users);
}

function cars_enumerate(){
    $cars=array();
    if($dir = opendir('./database/cars')){
        while(false !== ($file = readdir($dir))){
            if($file != '.' && $file != '..'){
                $data = file_get_contents("./database/cars/".$file);
				$obj = json_decode($data);
                array_push($cars, $obj);
            }
        }
    }
    return($cars);
}

?>