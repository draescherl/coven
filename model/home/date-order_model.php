<?php

function get_date()
{
	$date = array();

	if ($dir = opendir('./database/cars')) {
		while (($file = readdir($dir)) !== false) {
			if ( ($file != '.') && ($file != '..') ) {
				array_push($date, date("d m Y H:i:s.", filemtime('./database/cars/' . $file)));
			}
		}
		closedir($dir);
	}

	return ($date);
}


function order_by_latest_creation_date()
{
	$dates = get_date();
	sort($dates);
	$dates = array_reverse($dates);

	return ($dates);
}

?>