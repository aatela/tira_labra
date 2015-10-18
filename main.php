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

	if (isset($_GET['lat']) && isset($_GET['lon']) && $_GET['lat'] == "" && $_GET['lon'] == "") {
		echo '<span class="red">Please give coordinates..</span><br/><br/>';
	} else if (isset($_GET['lat']) && isset($_GET['lon']) && $_GET['lat'] != "" && $_GET['lon'] != "") {
		// Create map points from given coordinates
		$user_point = new map_point($lat, $lon);

		// Try to seek coordinates from map
		if (seek_point($user_point, $polygon_map) == TRUE) {
			echo '<span class="green">Given coordinates on polygon map.</span><br/><br/>';
		} else {
			echo '<span class="pink">Given coordinates not on polygon map.</span><br/><br/>';
		}
	}

	echo '		<form action="main.php">';
	echo '			GPS Coordinates:<br/>';
	echo '			Latitude: <input class="right" type="text" name="lat" placeholder="eg. 60.1708"'; if (isset($_GET['lat']) && $_GET['lat'] != "") { echo ' value="'.$_GET['lat'].'"'; } echo '><br/>';
	echo '			Longitude: <input class="right" type="text" name="lon" placeholder="eg. 24.9375"'; if (isset($_GET['lon']) && $_GET['lon'] != "") { echo ' value="'.$_GET['lon'].'"'; } echo '"><br/>';
	echo '			<br/>';
	echo '			Polygon level for seeking:<br/>';
	echo '			<input id="map4" type="radio" name="map" value="4"'; if (isset($_GET['map']) && $_GET['map'] == "4") { echo ' checked'; } echo '> <label for="map4">Map with 4 points</label><br/>';
	echo '			<input id="map40" type="radio" name="map" value="40"'; if ((isset($_GET['map']) && $_GET['map'] == "40") || !(isset($_GET['map']))) { echo ' checked'; } echo '> <label for="map40">Map with 40 points</label><br/>';
	echo '			<input id="map400" type="radio" name="map" value="400"'; if (isset($_GET['map']) && $_GET['map'] == "400") { echo ' checked'; } echo '> <label for="map400">Map with 400 points</label><br/>';

	echo '			<br>';
	echo '			Performance testing:<br>';
	echo '			<input id="test" type="checkbox" name="test" value="1"'; if (isset($_GET['test'])) { echo ' checked'; } echo '> <label for="test">Run performance tests</label><br/>';
	echo '			<input class="right" type="submit" value="Submit">';
	echo '		</form>';
	echo '	</div>';

	// Run performance tests if its activated
	if (($perf_test == TRUE || isset($_GET['test'])) && isset($_GET['lat']) && isset($_GET['lon'])) {
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
if (isset($_GET['map']) && $_GET['map'] == "4") {
	$polygon_map = $polygon_map_4points;
} else if (isset($_GET['map']) && $_GET['map'] == "40") {
        $polygon_map = $polygon_map_40points;
} else if (isset($_GET['map']) && $_GET['map'] == "400") {
        $polygon_map = $polygon_map_400points;
}

// Set performance testing to true / false
// $perf_test = TRUE;

// Execute main program
main_page($polygon_map, $perf_test);

?>
