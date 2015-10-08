<?php
// Here we will define coordinate maps that can be use as inputs for calculations

// Class that can storage latitude and longitude -pairs for polygon map purpose
class map_point {
	public $lat;
	public $lon;
	function map_point($lat, $lon) {
		$this->lat = $lat;
		$this->lon = $lon;
	}
}

// This simple polygon is just for testing
$polygon_map_test = array(
	new map_point(0.0000, 0.0000),
	new map_point(5.0000, 0.0000),
	new map_point(5.0000, 5.0000),
	new map_point(2.5000, 2.5000),
	new map_point(0.0000, 5.0000),
	new map_point(0.0000, 0,0000)
);

$polygon_map_4points = array(
	new map_point(60.05169, 20.93261),
	new map_point(60.35740, 31.17187),
	new map_point(70.02660, 29.89745),
	new map_point(69.02771, 20.31738)
);

/*
$polygon_map_40points = array(

);

$polygon_map_400points = array(

);
*/

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

?>
