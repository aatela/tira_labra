<?php

// Class that can storage latitude and longitude -pairs for polygon map purpose
class map_point {
	public $lon;
	public $lat;
	function map_point($lon, $lat) {
		$this->lon = $lon;
		$this->lat = $lat;
	}
}

// This polygon map looks like Finland :)
$polygon_map = array(
	new map_point(21.1047, 59.4072), 
	new map_point(27.3999, 59.9672),
	new map_point(32.2119, 62.8562),
	new map_point(30.6409, 63.7009),
	new map_point(30.2783, 66.3869),
	new map_point(29.3774, 66.9138),
	new map_point(30.3882, 67.6436),
	new map_point(28.9929, 68.3109),
	new map_point(29.7070, 69.6770),
	new map_point(28.0042, 70.2194),
	new map_point(25.6091, 69.8101),
	new map_point(24.8950, 68.7930),
	new map_point(23.6646, 68.9040),
	new map_point(22.7307, 68.8327),
	new map_point(21.6321, 69.3889),
	new map_point(20.8960, 69.3657),
	new map_point(20.3796, 68.9829),
	new map_point(23.1042, 67.9178),
	new map_point(23.5986, 65.1932),
	new map_point(19.1272, 62.6045),
	new map_point(19.0283, 60.2464),
	new map_point(20.3027, 59.3512),
	new map_point(21.1047, 59.4072)
);

// Here will be calculation to find point from map
function seek_point($lat, $lon) {

	// upcoming code

	return false;
}

// Base that outputs html code
function main_page() {

	// If user have given coordinates; safe them to variables
	if ($_GET['lat'] != "") {
		$lat = $_GET['lat'];
	}	
	if ($_GET['lon'] != "") {
		$lon = $_GET['lon'];
        }

	echo '<html>';
	echo '</body>';

	echo '<div style="float: left; padding: 10; border: 1px solid #ccc;">';

	// If user have entered coordinates
	if (isset($_GET['lat']) && isset($_GET['lon'])) {
		// Try to seek coordinates from map
		if (seek_point($lat, $lon) == TRUE)
			echo '<span style="color: green">Given coordinates on polygon map.</span><br/>';	
		else
			echo '<span style="color: pink;">Given coordinates not on polygon map.</span><br/>';
	}

	echo '<form action="base.php">';
	echo 'Latitude: <input type="text" name="lat"><br>';
	echo 'Longitude: <input type="text" name="lon"><br>';
	echo '<input type="submit" value="Submit">';
	echo '</form>';
	echo '</div>';

	echo '</body>';
	echo '</html>';
}

// Execute main program
main_page();

?>

