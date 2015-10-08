<?php

// Here is mostly user interface related stuff

// Include input maps and calculation algorithm
include("maps.php");
include("base.php");

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

		// Calculates with: 1, 10, 100, 1 000, 10 000 and 100 000 times..
		for ($i = 1; $i <= 100000; $i=$i*10) {
			$results = performance_test($count=$i, $user_point, $polygon_map);
			echo '		Calculations: '.$results['count'].'. All seeks: '.$results['all_seeks'].'. One seek: '.$results['one_seek'].'.<br/>';
		}

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
