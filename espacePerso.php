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
      color: #f5f6f7;
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
		<form action="ajout.php">
			<input type="submit" value="Ajout d'une annonce" class="button_inscription" type="submit">
		</form>
      </ul>
    </div>
  </div>
</nav>

<!-- Body -->

<div id="map"></div>

    <script>
      var customLabel = {
        restaurant: {
          label: 'R'
        },
        bar: {
          label: 'B'
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
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
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

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAA5eSkmcNDH8nw7wGcgNSF83GdN2d9PMU&callback=initMap">
    </script>



<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p>Bootstrap Theme Made By <a href="https://www.w3schools.com">www.w3schools.com</a></p> 
</footer>

</body>
</html>
