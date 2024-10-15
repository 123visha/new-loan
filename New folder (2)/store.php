<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Log received data for debugging
file_put_contents('debug.log', print_r($_GET, true), FILE_APPEND);

// Check if lat, long, and ip are set
if (isset($_GET["lat"]) && isset($_GET["long"]) && isset($_GET["ip"])) {
    // Sanitize inputs
    $latitude = filter_input(INPUT_GET, 'lat', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $longitude = filter_input(INPUT_GET, 'long', FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $ipAddress = filter_input(INPUT_GET, 'ip', FILTER_SANITIZE_STRING);

    // Prepare text to write
    $txt = "Latitude: $latitude\nLongitude: $longitude\nIP Address: $ipAddress\n\n";

    // Write to file
    $myfile = fopen("location.txt", "a");
    if ($myfile) {
        fwrite($myfile, $txt);
        fclose($myfile);
        echo "Location data saved successfully.";
    } else {
        echo "Failed to open file for writing.";
    }
} else {
    echo "Latitude, Longitude, or IP not provided.";
}
?>
