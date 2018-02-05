<?php	
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <!-- Theme Made By www.w3schools.com - No Copyright -->
  <meta name="description" content="DébarraVite, plateforme collaborative, met en relation des particuliers afin de faciliter le recyclage d'encombrants.">
  <title>Bootstrap Theme Simply Me</title>
  <meta charset="utf-8">
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="lightbox.js" type="text/javascript"></script>
  <style>
  #map {
        height: 100%;
      }
  html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
  body {
      font: 20px Montserrat, sans-serif;
      line-height: 1.8;
  }
  p {font-size: 16px;}
  .margin {margin-bottom: 45px;}
  .bg-1 { 
      background-color: #1abc9c; /* Green */
      color: #ffffff;
  }
  .bg-2 { 
      background-color: #474e5d; /* Dark Blue */
      color: #ffffff;
  }
  .bg-3 { 
      background-color: #ffffff; /* White */
      color: #555555;
  }
  .bg-4 { 
      background-color: #2f2f2f; /* Black Gray */
      color: #fff;
  }
  .container-fluid {
      padding-top: 70px;
      padding-bottom: 70px;
  }
  .navbar {
      padding-top: 15px;
      padding-bottom: 15px;
      border: 0;
      border-radius: 0;
      margin-bottom: 0;
      font-size: 12px;
      letter-spacing: 5px;
  }
  .navbar-nav  li a:hover {
      color: #1abc9c !important;
  }
  .button_connexion {
    background-color: #1400dd;
    line-height: 2;
    color: #FFFFFF;
    margin-top: 3%;
    border-radius: 8px;
    padding: 0 1.5%;
}
.button_inscription {
    background-color: #646600;
    line-height: 2;
    color: #FFFFFF;
    margin-top: 3%;
    border-radius: 8px;
    padding: 0 1.5%;
}
#box {
    display: none;
    position: fixed;
    top: 10%;
    left: 35%;
    margin-left: auto;
    margin-right: auto;
    border: 1px solid black;
    background-color: #C9C9C9;
    z-index: 101;
    overflow: auto;
    line-height: 1.5;
    padding: 5%;
}
#boxtitle {
    position: absolute;
    float: center;
    top: 0;
    left: 0;
    width: 100%;
    padding: 0;
        padding-top: 0px;
    padding-top: 4px;
    left-padding: 8px;
    margin: 0;
    border-bottom: 4px solid #448156;
    background-color: #448156;
    color: white;
    text-align: center;
    font-size: 25px;
}
#shadowing {
    display: none;
    position: fixed;
    top: 0%;
    left: 0%;
    width: 100%;
    height: 100%;
    background-color: #CCA;
    z-index: 10;
    opacity: 0.5;
    filter: alpha(opacity=50);
}
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
  
  <?php 
		include("xmlCreate.php"); 
	?>
	
	<?php 
		$name = $_SESSION['name']; 
		$firstname = $_SESSION['firstname'];
		$owner = $_SESSION['id'];
		//print_r($_SESSION);
	?>

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">DébarraVite</a>
    </div>
	<div>
	</div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
		<a><?php echo $name; ?></a>
		<a><?php echo $firstname; ?></a>
		<form action="logout.php" method="GET" class="PH" >
			<input type="submit" value="Deconnexion" class="button_connexion" type="button">
		</form>
		<input onclick="openbox('Ajout', 1)" value="Ajout d'une annonce" class="button_inscription" type="button">
      </ul>
    </div>
  </div>
</nav>

<div id="shadowing"></div>
	<div id="box">
		<span id="boxtitle"></span>	
		<?php
			include("ajout.php");
		?>
	</div>
</div>

<!-- Body -->

<div id="map"></div>

    <script>
	
	function initialize() {
   initMap();
   initAutoComplete();
}
	
      var customLabel = {
        Dechetterie: {
          icon: 'icons/dechetterie.png'
        },
        Vegetaux: {
          icon: 'icons/vert.png'
        }
		,
        Encombrant: {
          icon: 'icons/encombrant.png'
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: new google.maps.LatLng(47.080355, 2.398645),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl('markers.xml', function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName('marker');
            Array.prototype.forEach.call(markers, function(markerElem) {
              var name = markerElem.getAttribute('name');
			  var ownername = markerElem.getAttribute('ownername');
			  var ownerfirstname = markerElem.getAttribute('ownerfirstname');
			  var ownerage = markerElem.getAttribute('ownerage');
			  var ownerphone = markerElem.getAttribute('ownerphone');
              var address = markerElem.getAttribute('address');
              var type = markerElem.getAttribute('type');
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute('lat')),
                  parseFloat(markerElem.getAttribute('lng')));

              var infowincontent = document.createElement('div');
              var strong = document.createElement('strong');
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement('br'));

              var text = document.createElement('text');
			  text.textContent = address
              infowincontent.appendChild(text);
			  
			  infowincontent.appendChild(document.createElement('br'));
			  
			  var text = document.createElement('text');
              text.textContent = ownername
              infowincontent.appendChild(text);
			  
			  var text = document.createElement('text');
			  text.textContent = ' '
              text.textContent += ownerfirstname
              infowincontent.appendChild(text);
			  
			  infowincontent.appendChild(document.createElement('br'));
			  
			  var text = document.createElement('text');
              text.textContent = ownerage
			  text.textContent += ' ans'
              infowincontent.appendChild(text);
			  
			  infowincontent.appendChild(document.createElement('br'));
			  
			  var text = document.createElement('text');
			  text.textContent = 'Téléphone: '
              text.textContent += ownerphone
              infowincontent.appendChild(text);
  
              var list = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                icon: list.icon
              });
              marker.addListener('click', function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject('Microsoft.XMLHTTP') :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open('GET', url, true);
        request.send(null);
      }
	  
		var placeSearch, autocomplete;
		var componentForm = {
			street_number: 'short_name',
			route: 'long_name',
			locality: 'long_name',
			administrative_area_level_1: 'short_name',
			country: 'long_name',
			postal_code: 'short_name'
};

function initAutoComplete() {
  // Create the autocomplete object, restricting the search to geographical
  // location types.
  autocomplete = new google.maps.places.Autocomplete(
    /** @type {!HTMLInputElement} */
    (document.getElementById('autocomplete')), {
      types: ['geocode']
    });

  // When the user selects an address from the dropdown, populate the address
  // fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();
  if (place.geometry.viewport) {
    map.fitBounds(place.geometry.viewport);
  } else {
    map.setCenter(place.geometry.location);
    map.setZoom(17); // Why 17? Because it looks good.
  }
  if (!marker) {
    marker = new google.maps.Marker({
      map: map,
      anchorPoint: new google.maps.Point(0, -29)
    });
  } else marker.setMap(null);
  marker.setOptions({
    position: place.geometry.location,
    map: map
  });

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details
  // and fill the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];
    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];
      document.getElementById(addressType).value = val;
    }
  }
}

      function doNothing() {}
    </script>
    <script
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA5eSkmcNDH8nw7wGcgNSF83GdN2d9PMU&libraries=places&callback=initialize" defer>
    </script>
	
	



<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p>Bootstrap Theme Made By <a href="https://www.w3schools.com">www.w3schools.com</a></p> 
</footer>

</body>
</html>
