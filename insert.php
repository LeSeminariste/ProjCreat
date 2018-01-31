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

$url = 'index.php';

//header('Location: https://debarravite.000webhostapp.com/index.php');
//exit();

if (!headers_sent())
    {    
        header('Location: '.$url);
        exit;
        }
    else
        {  
        echo '<script type="text/javascript">';
        echo 'window.location.href="'.$url.'";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
        echo '</noscript>'; exit;
    }


?>