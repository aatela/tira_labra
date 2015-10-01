<?php

// Here is mostly user interface related stuff

// Include base functions
include("base.php");

// performance testing function
function performance_test($count, $user_point, $polygon_map) {

	$results = Array();
	$before = microtime(true);

	for ($i=0 ; $i<$count ; $i++) {
		seek_point($user_point, $polygon_map);
	}

	$after = microtime(true);

	// calculate all seeks and one seek per second
	$results['count'] = $count;
	$results['one_seek'] = (($after-$before)/$count)." sec / seek";
	$results['all_seeks'] = $after-$before." sec";

	return $results;
}

// Main page that outputs html code
function main_page($polygon_map, $perf_test) {

	// If user have given coordinates; safe them to variables
	if ($_GET['lat'] != "") {
		$lat = (float) $_GET['lat'];
	}

	if ($_GET['lon'] != "") {
		$lon = (float) $_GET['lon'];
	}

	echo '<html>';
	echo '<head>';
	echo '<link href="styles.css" rel="stylesheet" type="text/css" />';
	echo '</head>';
	echo '<body>';

	echo '<div class="main">';

	echo '	<div class="user_form">';

	// If user have entered coordinates
	if (isset($_GET['lat']) && isset($_GET['lon'])) {

		// Create map points from given coordinates
		$user_point = new map_point($lat, $lon);

		// Try to seek coordinates from map
		if (seek_point($user_point, $polygon_map) == TRUE) {
			echo '<span class="green">Given coordinates on polygon map.</span><br/>';
		} else {
			echo '<span class="pink">Given coordinates not on polygon map.</span><br/>';
		}
	} else {
		echo 'Please give coordinates..';
	}

	echo '		<form action="main.php">';
	echo '			Latitude: <input type="text" name="lat"><br>';
	echo '			Longitude: <input type="text" name="lon"><br>';
	echo '			<input type="submit" value="Submit">';
	echo '		</form>';
	echo '	</div>';

	// Run performance tests if its activated
	if ($perf_test == TRUE && isset($_GET['lat']) && isset($_GET['lon'])) {
		echo '	<div class="performance">';
		echo '		Performance test results.<br/><br/>';

		$results = performance_test($count=1, $user_point, $polygon_map);
		echo '          Calculations: '.$results['count'].'. All seeks: '.$results['all_seeks'].'. One seek: '.$results['one_seek'].'.<br/>';
		$results = performance_test($count=10, $user_point, $polygon_map);
		echo '          Calculations: '.$results['count'].'. All seeks: '.$results['all_seeks'].'. One seek: '.$results['one_seek'].'.<br/>';
		$results = performance_test($count=100, $user_point, $polygon_map);
		echo '		Calculations: '.$results['count'].'. All seeks: '.$results['all_seeks'].'. One seek: '.$results['one_seek'].'.<br/>';
		$results = performance_test($count=1000, $user_point, $polygon_map);
		echo '		Calculations: '.$results['count'].'. All seeks: '.$results['all_seeks'].'. One seek: '.$results['one_seek'].'.<br/>';
		$results = performance_test($count=10000, $user_point, $polygon_map);
		echo '		Calculations: '.$results['count'].'. All seeks: '.$results['all_seeks'].'. One seek: '.$results['one_seek'].'.<br/>';
		$results = performance_test($count=100000, $user_point, $polygon_map);
		echo '          Calculations: '.$results['count'].'. All seeks: '.$results['all_seeks'].'. One seek: '.$results['one_seek'].'.<br/>';

		echo '	</div>';
	}

	echo '</div>';
	echo '</body>';
	echo '</html>';
}

// Polygon map that our seek will use
$polygon_map = $polygon_map_finland;

// Set performance testing to true / false
$perf_test = TRUE;

// Execute main program
main_page($polygon_map, $perf_test);

?>
