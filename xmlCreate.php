<?php

include('connect.php');

$query = "SELECT * FROM markers";

$markerArray = array();

if ($result = $connexion->query($query)) {

    /* fetch associative array */
    while ($row = $result->fetch_assoc()) {

       array_push($markerArray, $row);
	   //print_r($row);
    }
  
    if(count($markerArray)){

        createXMLfile($markerArray);

     }
	 else {
		file_put_contents('markers.xml', '');
	 
	 }

    /* free result set */
    $result->free();
}

/* close connection */
$connexion->close();

function createXMLfile($markerArray){
  
   $filePath = 'markers.xml';

   $dom     = new DOMDocument('1.0', 'utf-8'); 

   $root      = $dom->createElement('markers'); 

   for($i=0; $i<count($markerArray); $i++){
     
     $markerId        =  $markerArray[$i]['id'];  
     $markerName      =  $markerArray[$i]['name']; 
     $markerAddress    =  $markerArray[$i]['address']; 
     $markerlat     =  $markerArray[$i]['lat']; 
     $markerlng      =  $markerArray[$i]['lng']; 
     $markertype  =  $markerArray[$i]['type'];
	 $markerownername  =  $markerArray[$i]['ownername'];	 
	 $markerownerfirstname  =  $markerArray[$i]['ownerfirstname'];
	 $markerownerphone  =  $markerArray[$i]['ownerphone'];
	 $markerownermail  =  $markerArray[$i]['ownermail'];
	 $markerownerage  =  $markerArray[$i]['ownerage'];

     $marker = $dom->createElement('marker');

     $marker->setAttribute('id', utf8_encode($markerId));
	 $marker->setAttribute('name', utf8_encode($markerName));
	 $marker->setAttribute('address', utf8_encode($markerAddress));
	 $marker->setAttribute('lat', utf8_encode($markerlat));
	 $marker->setAttribute('lng', utf8_encode($markerlng));
	 $marker->setAttribute('type', utf8_encode($markertype));
	 $marker->setAttribute('ownername', utf8_encode($markerownername));
	 $marker->setAttribute('ownerfirstname', utf8_encode($markerownerfirstname));
	 $marker->setAttribute('ownerphone', utf8_encode($markerownerphone));
	 $marker->setAttribute('ownermail', utf8_encode($markerownermail));
	 $marker->setAttribute('ownerage', utf8_encode($markerownerage));
	 
     $root->appendChild($marker);

   }

   $dom->appendChild($root); 

   $dom->save($filePath); 

 } 
