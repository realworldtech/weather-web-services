<?php

/**
 * Test Case generator for Weather Web Services code
 * This file creates 100 data points and dumps them to the CLI.
 * Tested on PHP 5.4
 * 
 * This code is not designed to generate believable data. Be warned.
 */


require_once("library.php");


$number_of_data_sets = 100;
$start_date = time()-$number_of_data_sets*24*60*60;

$data_points = generate_random_weather_data($number_of_data_sets, $start_date);

foreach($data_points as $point) {
  echo json_encode($point);
  echo "\n";
}