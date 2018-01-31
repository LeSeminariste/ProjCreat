<?php

include('connect.php');

$name = mysqli_real_escape_string($connexion, $_REQUEST['name']);
$address = mysqli_real_escape_string($connexion, $_REQUEST['address']);
$type = mysqli_real_escape_string($connexion, $_REQUEST['type']);

//echo $address;

$addressLink = str_replace(' ', '+', $address);

//echo $addressLink;

include('addressConvert.php');

$sql = "INSERT INTO markers (id, name, address, lat, lng, type) VALUES (NULL, '$name', '$address', '$lat', '$lng', '$type')";
if(mysqli_query($connexion, $sql)){

    echo "Records added successfully.";

} else{

    echo "ERROR: Could not able to execute $sql. " . mysqli_error($connexion);

}
mysqli_close($connexion);

header('Location: index.php');
exit();
//print_r($_REQUEST);

?>