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

// This simple polygon is for testing
$polygon_map_test = array(
	new map_point(0.0000, 0.0000),
	new map_point(2.5000, 2.5000),
	new map_point(5.0000, 0.0000),
	new map_point(5.0000, 5.0000),
	new map_point(2.5000, 2.5000),
	new map_point(0.0000, 5.0000),
	new map_point(0.0000, 0.0000)
);

// This polygon map looks like Finland :)
$polygon_map_finland = array(
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
function seek_point($user_point, $polygon_map) {

	// Counter that calculates amount of intersections with polygon borders (lines)
	$intersections = 0;

	// How many coordinates we have on map, so many iterations..
	$count = count($polygon_map);

	// Will iterate whole polygon array (all coordinates)
	for ($i=0; $i<$count; $i++)

		// Select two next points from array (line)
		$point1 = $polygon_map[$i];
		$point2 = $polygon_map[$i+1];

//			$crossing = diiba daaba..

			if ($crossing) {
                                $intersections++;
			}
		}
        }

	// Modulo, if intersections (starts from value 0) is even it will be inside of our polygon map
	if ($intersections % 2 == 0) {
		return FALSE;
	} else {
		return TRUE;
	}
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

		// Create array from coordinates
		$user_point = array("lat" => $_GET['lat'], "lon" => $_GET['lon']);

		// Polygon map that our seek will use
		$polygon_map = $polygon_map_test;

		// Try to seek coordinates from map
		if (seek_point($user_point, $polygon_map) == TRUE)
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

