<!DOCTYPE html>
<html>
  <head>
    <title>Place Autocomplete Address Form</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500">
    <style>
      #locationField, #controls {
        position: relative;
        width: 480px;
      }
      #autocomplete {
        position: absolute;
        top: 0px;
        left: 0px;
        width: 99%;
      }
      .label {
        text-align: right;
        font-weight: bold;
        width: 100px;
        color: #303030;
      }
      #address {
        border: 1px solid #000090;
        background-color: #f0f0ff;
        width: 480px;
        padding-right: 2px;
      }
      #address td {
        font-size: 10pt;
      }
      .field {
        width: 99%;
      }
      .slimField {
        width: 80px;
      }
      .wideField {
        width: 200px;
      }
      #locationField {
        height: 20px;
        margin-bottom: 2px;
      }
    </style>
  </head>

  <body>
  <form action="insert.php" method="post">
    <div id="name">
		<input name="name" placeholder="Description" type="text" style="color: black"/>
	</div>
	<div id="locationField">
		<input id="autocomplete" name="address" placeholder="Adresse" onFocus="geolocate()" type="text" style="color: black "/>
	</div>
	<br>

	 <select name="type">
		<option value="Encombrant">Encombrant</option>
		<option value="Vegetaux">Vegetaux</option>
	</select> 
	<br>
	
	<input type="submit" value="OK" class="button_inscription">
	<input type="button" class="button_inscription" name="cancel" value="Annuler" onclick="closebox()">
  </form>

  </body>
</html>