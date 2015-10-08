<?php
// Here are the algorithm and some base functions

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

// Performance testing function
function performance_test($count, $user_point, $polygon_map) {

	$results = Array();

	// Check time before calculations
	$before = microtime(true);

	for ($i=0 ; $i<$count ; $i++) {
		seek_point($user_point, $polygon_map);
	}

	// Check time again after calculations
	$after = microtime(true);

	// Calculate all seeks and one seek per second
	$results['count'] = $count;
	$results['one_seek'] = (($after-$before)/$count)." sec / seek";
	$results['all_seeks'] = $after-$before." sec";

	// Return results on array
	return $results;
}

?>

