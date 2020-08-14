<?php

$result = "Failed";

function get_car(string $path)
{
    $file = file_get_contents($path);
    $file = json_decode($file, true);
    
    $fields = array('brand', 'model', 'price', 'desc', 'front', 'back', 'others');
    $data = array();
    foreach ($fields as $value) {
        $data[$value] = $file[$value];
    }

    return $data;
}


function filter(array $res, $string, $string2){
    $temp=array();

    //if user wants to filter by brand
    if ($string2=='brand') {
        if ($dir = opendir($_SERVER['DOCUMENT_ROOT'] .'/database/cars')) {
            while (($file = readdir($dir)) !== false) {
                if ( ($file != '.') && ($file != '..') ) {
                    $car=explode("-", $file);
                    if ($car[0]==$string) {
                        array_push($res, $file);
                    }
                }
            }
        }
    }

    //if user wants to filter firstly by type
    if (empty($res) && $string2=='vehicle_type') {
        if ($dir = opendir($_SERVER['DOCUMENT_ROOT'] .'/database/cars')) {
            while (($file = readdir($dir)) !== false) {
                if ( ($file != '.') && ($file != '..') ) {
                    $raw_file = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/database/cars/'.$file);
                    $decoded_file = json_decode($raw_file, true);
                    if ($decoded_file['type']==$string) {   //!!!!!!!!!!!!!!pay attention at 'type' here !!!!!!
                        array_push($res, $file);
                    }
                }
            }
        }
    }

    //if user wants to filter firstly by model_year
    if (empty($res) && $string2=='model_year') {
        if ($dir = opendir($_SERVER['DOCUMENT_ROOT'] .'/database/cars')) {
            while (($file = readdir($dir)) !== false) {
                if ( ($file != '.') && ($file != '..') ) {
                    $raw_file = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/database/cars/'.$file);
                    $decoded_file = json_decode($raw_file, true);
                    if ($decoded_file['year']==$string) {   //!!!!!!!!!!!!!!pay attention at 'model_year' here !!!!!!
                        array_push($res, $file);
                    }
                }
            }
        }
    }

    //if user wants to filter firstly by minimum price
    if (empty($res) && $string2=='minprice') {
        if ($dir = opendir($_SERVER['DOCUMENT_ROOT'] .'/database/cars')) {
            while (($file = readdir($dir)) !== false) {
                if ( ($file != '.') && ($file != '..') ) {
                    $raw_file = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/database/cars/'.$file);
                    $decoded_file = json_decode($raw_file, true);
                    if ($decoded_file['price']>=$string) {
                        array_push($res, $file);
                    }
                }
            }
        }
    }

    //if user wants to filter firstly by maximum price
    if (empty($res) && $string2=='maxprice') {
        if ($dir = opendir($_SERVER['DOCUMENT_ROOT'] .'/database/cars')) {
            while (($file = readdir($dir)) !== false) {
                if ( ($file != '.') && ($file != '..') ) {
                    $raw_file = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/database/cars/'.$file);
                    $decoded_file = json_decode($raw_file, true);
                    if ($decoded_file['price']<=$string) {
                        array_push($res, $file);
                    }
                }
            }
        }
    }

    //if users wants to filter by type and brand
    if (!empty($res) && $string2=='vehicle_type') {
        if ($dir = opendir($_SERVER['DOCUMENT_ROOT'] .'/database/cars')) {
            for ($i=0; $i < count($res); $i++) {
                $file_temp=$res[$i];
                $raw_file = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/database/cars/'.$file_temp);
                $decoded_file = json_decode($raw_file, true);
                if ($decoded_file['type']==$string) {
                    array_push($temp, $res[$i]);
                }
            }
        }
        //reset res and put temp into res then reset temp
        unset($res);
        $res=array();
        $res=$temp;
        $temp=array();
    }

    //if users wants to filter by year and smth else
    if (!empty($res) && $string2=='model_year') {
        if ($dir = opendir($_SERVER['DOCUMENT_ROOT'] .'/database/cars')) {
            for ($i=0; $i < count($res); $i++) {
                $file_temp=$res[$i];
                $raw_file = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/database/cars/'.$file_temp);
                $decoded_file = json_decode($raw_file, true);
                if ($decoded_file['year']===$string) {
                    array_push($temp, $res[$i]);
                }
            }
        }
        //reset res and put temp into res then reset temp
        unset($res);
        $res=array();
        $res=$temp;
        $temp=array();
    }

    //if users wants to filter by minprice and smth else
    if (!empty($res) && $string2=='minprice') {
        if ($dir = opendir($_SERVER['DOCUMENT_ROOT'] .'/database/cars')) {
            for ($i=0; $i < count($res); $i++) {
                $file_temp=$res[$i];
                $raw_file = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/database/cars/'.$file_temp);
                $decoded_file = json_decode($raw_file, true);
                if ($decoded_file['price']>=$string) {
                    array_push($temp, $res[$i]);
                }
            }
        }
        //reset res and put temp into res then reset temp
        unset($res);
        $res=array();
        $res=$temp;
        $temp=array();
    }

    //if users wants to filter by maxprice and smth else
    if (!empty($res) && $string2=='maxprice') {
        if ($dir = opendir($_SERVER['DOCUMENT_ROOT'] .'/database/cars')) {
            for ($i=0; $i < count($res); $i++) {
                $file_temp=$res[$i];
                $raw_file = file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/database/cars/'.$file_temp);
                $decoded_file = json_decode($raw_file, true);
                if ($decoded_file['price']<=$string) {
                    array_push($temp, $res[$i]);
                }
            }
        }
        //reset res and put temp into res then reset temp
        unset($res);
        $res=array();
        $res=$temp;
        $temp=array();
    }

    return($res);
}

//main 
$res=array();
$database_path2 = $_SERVER['DOCUMENT_ROOT'] . '/database/cars/';

if (isset($_POST['brand'])) {
    if (!empty($_POST['brand'])) {
        $res=filter($res, $_POST['brand'], 'brand');
    }
}

if (isset($_POST['vehicle_type'])) {
    if (!empty($_POST['vehicle_type'])) {
        $res=filter($res, $_POST['vehicle_type'], 'vehicle_type');
    }
}

if (isset($_POST['model_year'])) {
    if (!empty($_POST['model_year'])) {
        $res=filter($res, $_POST['model_year'], 'model_year');
    }
}

if (isset($_POST['minprice'])) {
    if (!empty($_POST['minprice'])) {
        $res=filter($res, $_POST['minprice'], 'minprice');
    }
}

if (isset($_POST['maxprice'])) {
    if (!empty($_POST['maxprice'])) {
        $res=filter($res, $_POST['maxprice'], 'maxprice');
    }
}

//used to display all cars if there's no filter
if (empty($_POST['brand']) && empty($_POST['vehicle_type']) && empty($_POST['model_year']) && empty($_POST['minprice']) && empty($_POST['maxprice'])) {
    $filtered_vehicules = array_diff(scandir($database_path2), array('.', '..'));
}else{
    $filtered_vehicules=$res;
}

$result = "Success";
foreach ($filtered_vehicules as $key => $value) {
    $filtered_vehicules[$key] = get_car($database_path2 . $value);
}

// result of the filter
if (isset($filtered_vehicules)){
?>
    <div class="row">
            <?php
            foreach ($filtered_vehicules as $car) {
                ?>
                <div class="col s12 m6 l6 xl4">
                    <div class="card">
                        <div class="card-image waves-effect waves-block waves-light">
                            <img class="activator" src=<?= $car['front'] ?> id=<?= $car['model'] ?> onmouseover="mouseover(this.id, '<?= $car['back'] ?>')" onmouseout="mouseout(this.id, '<?= $car['front'] ?>')">
                        </div>
                        <div class="card-content">
                            <span class="card-title activator grey-text text-darken-4"> <b><?= $car['brand'] ?></b> <i class="material-icons right">more_vert</i> <br> <b><?= $car['model'] ?></b> </span>
                            <p><a href=<?='/?action=car_info&car=' . str_replace(' ', '_', $car['brand']) . '-' . str_replace(' ', '_', $car['model']) ?>> <b>Plus d'informations sur la voiture</b> </a></p>
                        </div>
                        <div class="card-reveal">
                            <span class="card-title grey-text text-darken-4"><?= $car['brand'] ?> <i class="material-icons right">close</i> <br> <?= $car['model'] ?></span>
                            <p> <b><?= $car['desc'] ?></b> </p>
                        </div>
                    </div>
                </div>
            <?php
            }
                ?>
    </div>
<?php
}
?>