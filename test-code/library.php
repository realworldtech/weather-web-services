<?php

/**
 * Test Case generator for Weather Web Services code
 * Tested on PHP 5.4
 * 
 * This code is not designed to generate believable data. Be warned.
 */

/**
 * Given a $centre (latitude, longitude) co-ordinates and a
 * distance $radius (miles), returns a random point (latitude,longtitude)
 * which is within $radius miles of $centre.
 * 
 * Code taken from Stack Overflow
 * http://stackoverflow.com/questions/5460838/php-select-a-random-lon-lat-within-a-certain-radius
 *
 * @param  array $centre Numeric array of floats. First element is 
 *                       latitude, second is longitude.
 * @param  float $radius The radius (in miles).
 * @return array         Numeric array of floats (lat/lng). First 
 *                       element is latitude, second is longitude.
 */
 function generate_random_point( $centre, $radius ){

      $radius_earth = 3959; //miles

      //Pick random distance within $distance;
      $distance = lcg_value()*$radius;

      //Convert degrees to radians.
      $centre_rads = array_map( 'deg2rad', $centre );

      //First suppose our point is the north pole.
      //Find a random point $distance miles away
      $lat_rads = (pi()/2) -  $distance/$radius_earth;
      $lng_rads = lcg_value()*2*pi();


      //($lat_rads,$lng_rads) is a point on the circle which is
      //$distance miles from the north pole. Convert to Cartesian
      $x1 = cos( $lat_rads ) * sin( $lng_rads );
      $y1 = cos( $lat_rads ) * cos( $lng_rads );
      $z1 = sin( $lat_rads );


      //Rotate that sphere so that the north pole is now at $centre.

      //Rotate in x axis by $rot = (pi()/2) - $centre_rads[0];
      $rot = (pi()/2) - $centre_rads[0];
      $x2 = $x1;
      $y2 = $y1 * cos( $rot ) + $z1 * sin( $rot );
      $z2 = -$y1 * sin( $rot ) + $z1 * cos( $rot );

      //Rotate in z axis by $rot = $centre_rads[1]
      $rot = $centre_rads[1];
      $x3 = $x2 * cos( $rot ) + $y2 * sin( $rot );
      $y3 = -$x2 * sin( $rot ) + $y2 * cos( $rot );
      $z3 = $z2;


      //Finally convert this point to polar co-ords
      $lng_rads = atan2( $x3, $y3 );
      $lat_rads = asin( $z3 );

      return array_map( 'rad2deg', array( $lat_rads, $lng_rads ) );
 }


/**
 * 
 * Generate a set of random data points and return as an array.
 * 
 * @param  integer      $number_of_data_sets Number of data points to
 *                      generate.
 * @param  timestamp    $start_date The start date/time of the data.
 * @return array        An array of $number_of_data_sets data points
 *                      that have been randomly generated.
 * 
 **/
function generate_random_weather_data($number_of_data_sets, $start_date) {
  $last_rainfall_measured = null;
  $rain_unit_types = array(
    "mm",
    "cm",
    "inches"
    );
  $wind_unit_types = array(
    "m/s", // meters per second - 3.6 kilometers per hour
    "km/h", // kilometers per hour
    "mph", // miles per hour - 1.609344 kilometers per hour
    "kn" // knots (nautical miles per hour) - 1.852 kilometers per hour
    );
  $temperature_units = array(
    "celsius",
    "fahrenheit"
    );

  $i = 0;

  $data_sets = array();

  while ($i < $number_of_data_sets) {
    $data = array();
    // get the time for this data set. Move but some approximation of
    // an hour.

    $time = $start_date + $i * rand(3500,3630);
    $time_for_write = new DateTime('@'.$time);
    $data['time'] = $time_for_write->format(DateTime::ISO8601);

    $point = generate_random_point(array(-33.785288, 151.129386,17), 100);
    $data['location'] = array(
      'lat'=>$point[0],
      'lon'=>$point[1]
      );

    //Randomly include windspeed
    if (rand(0,1)) {
      $data['windspeed'] = array(
        'speed' => rand(0,100),
        'units' => $wind_unit_types[array_rand($wind_unit_types)]
      );
    }

    //Randomly include rainfall
    if (rand(0,1)) {

      //we need to indicate the time period this rain gauge measurement is for
      $last_rainfall_measured_for_display = $last_rainfall_measured!==NULL?new DateTime('@'.$last_rainfall_measured):NULL;
      $data['rainfall'] = array(
        'quantity' => rand(0,500),
        'units' => $rain_unit_types[array_rand($rain_unit_types)],
        'since' => $last_rainfall_measured!==NULL?$last_rainfall_measured_for_display->format(DateTime::ISO8601):'null',
      );
      $last_rainfall_measured = $time;
    }

    //Randomly include temperture
    if (rand(0,1)) {
      $data['temperature'] = array(
        'quantity' => rand(-50,100),
        'units' => $temperature_units[array_rand($temperature_units)],
      );
    }

    $data_sets[] = $data;
    $i++;
  }
  return $data_sets;
}
