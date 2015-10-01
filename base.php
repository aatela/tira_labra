<?php
// Here are the base functions and algorithm

// Class that can storage latitude and longitude -pairs for polygon map purpose
class map_point {
	public $lat;
	public $lon;
	function map_point($lat, $lon) {
		$this->lat = $lat;
		$this->lon = $lon;
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
	new map_point(59.4072, 21.1047), 
	new map_point(59.9672, 27.3999),
	new map_point(62.8562, 32.2119),
	new map_point(63.7009, 30.6409),
	new map_point(66.3869, 30.2783),
	new map_point(66.9138, 29.3774),
	new map_point(67.6436, 30.3882),
	new map_point(68.3109, 28.9929),
	new map_point(69.6770, 29.7070),
	new map_point(70.2194, 28.0042),
	new map_point(69.8101, 25.6091),
	new map_point(68.7930, 24.8950),
	new map_point(68.9040, 23.6646),
	new map_point(68.8327, 22.7307),
	new map_point(69.3889, 21.6321),
	new map_point(69.3657, 20.8960),
	new map_point(68.9829, 20.3796),
	new map_point(67.9178, 23.1042),
	new map_point(65.1932, 23.5986),
	new map_point(62.6045, 19.1272),
	new map_point(60.2464, 19.0283),
	new map_point(59.3512, 20.3027),
	new map_point(59.4072, 21.1047)
);

// Here will be calculation to find point from map
function seek_point($user_point, $polygon_map) {

	// Counter that calculates amount of intersections with polygon borders (lines)
	$intersections = 0;

	// How many coordinates we have on map, so many iterations..
	$count = count($polygon_map);

	for ($i=0; $i<=$count; $i++) {

		// Select two next points from array (line)
		$point1 = $polygon_map[$i];
		$point2 = $polygon_map[$i+1];

		// If last round, our second point is starting point
		if ($i == $count) {
			$point2 = $polygon_map[0];
		}

		// Check if given point is between min and max coordinate points
		if (min($point1->lon, $point2->lon) < $user_point->lon && $user_point->lon <= max($point1->lon, $point2->lon) && $user_point->lat <= max($point1->lat, $point2->lat) && $point1->lon != $point2->lon) {
			$crossing = (($user_point->lon - $point1->lon) * ($point2->lat - $point1->lat) / ($point2->lon - $point1->lon)) + $point1->lat;
			if ($user_point->lat <= $crossing || $point1->lat == $point2->lat) {
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

?>

