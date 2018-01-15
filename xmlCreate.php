<?php
$username="root";
$password="";
$database="test";
?>


<?php

/** create XML file */ 
$mysqli = new mysqli("localhost", "root", "", "test");

/* check connection */
if ($mysqli->connect_errno) {

   echo "Connect failed ".$mysqli->connect_error;

   exit();
}

$query = "SELECT id, name, address, lat, lng, type FROM markers";

$markerArray = array();

if ($result = $mysqli->query($query)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {

       array_push($markerArray, $row);
    }
  
    if(count($markerArray)){

         createXMLfile($markerArray);

     }

    /* free result set */
    $result->free();
}

/* close connection */
$mysqli->close();

function createXMLfile($markerArray){
  
   $filePath = 'marker.xml';

   $dom     = new DOMDocument('1.0', 'utf-8'); 

   $root      = $dom->createElement('markers'); 

   for($i=0; $i<count($markerArray); $i++){
     
     $markerId        =  $markerArray[$i]['id'];  

     $markerName      =  $markerArray[$i]['name']; 

     $markerAddress    =  $markerArray[$i]['address']; 

     $markerlat     =  $markerArray[$i]['lat']; 

     $markerlng      =  $markerArray[$i]['lng']; 

     $markertype  =  $markerArray[$i]['type'];	

     $marker = $dom->createElement('marker');

     $marker->setAttribute('id', $markerId);

     $name     = $dom->createElement('name', $markerName); 

     $marker->appendChild($name); 

     $address   = $dom->createElement('address', $markerAddress); 

     $marker->appendChild($address); 

     $lat    = $dom->createElement('lat', $markerlat); 

     $marker->appendChild($lat); 

     $lng     = $dom->createElement('lng', $markerlng); 

     $marker->appendChild($lng); 
     
     $type = $dom->createElement('type', $markertype); 

     $marker->appendChild($type);
 
     $root->appendChild($marker);

   }

   $dom->appendChild($root); 

   $dom->save($filePath); 

 } 
