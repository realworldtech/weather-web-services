<?php
/**
 * Test Case generator for Weather Web Services code
 * Tested on PHP 5.4
 * 
 * This code submits sample data to your Web Services site using the
 * generator.
 * 
 * This requires the PHP CURL library which may not be installed by
 * default in your environment.
 * 
 * Original code written by Andrew Donnellan (ajdlinux)
 *
 */

require_once("library.php");

$ENDPOINT_URL = "YOUR URL HERE";
$AUTH_TOKEN = "INSERT TOKEN HERE"; // assuming you are using drf

$number_of_data_sets = 100;
$start_date = time()-$number_of_data_sets*24*60*60;

$data_points = generate_random_weather_data($number_of_data_sets, $start_date);

echo("<!DOCTYPE html><html><head><title>Web Service Submission Test</title></head><body>");

foreach($data_points as $point) {

  echo("<h1>Request JSON</h1>");
  echo("<pre>" . json_encode($point) . "</pre>");

  $req = new http\Client\Request("POST", $ENDPOINT_URL,
            ['Authorization' => 'Token ' . $AUTH_TOKEN, 'Accept' => 'application/json', 'Content-Type' => 'application/json']);
  $req->getBody()->append(json_encode($point));

  $client = new http\Client;
  $client->addSslOptions(['verifypeer' => false, 'verifyhost' => false]); // Disable SSL certificate verification. Don't do this in production!
  $client->enqueue($req)->send();
  $resp = $client->getResponse($req);

  echo("<h1>Response JSON</h1>");
  echo("<pre>" . $resp->getBody() . "</pre>");

}

echo("</body></html>");