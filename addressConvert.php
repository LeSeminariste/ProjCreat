<?php

//$geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address='.$addressLink.'&sensor=false');
//$geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address=avenida+gustavo+paiva,maceio,alagoas,brasil&sensor=false');
$geocode = file_get_contents('https://maps.google.com/maps/api/geocode/json?address='.$addressLink.'&key=AIzaSyAA5eSkmcNDH8nw7wGcgNSF83GdN2d9PMU');

//echo json_encode($geocode);

$output= json_decode($geocode);

$lat = $output->results[0]->geometry->location->lat;
$lng = $output->results[0]->geometry->location->lng;

echo $lat;
echo $lng;

?>