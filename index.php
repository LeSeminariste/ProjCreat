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
  </style>
  
  <?php 
		include("xmlCreate.php"); 
	?>

	<?php
	
	if(isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password2']) 
		&& !empty($_POST['password2']) ){
			
			$email=htmlspecialchars($_POST['email']);
			$pass=htmlspecialchars($_POST['password2']);
			
			include('connect.php');
			$req = $bdd->prepare('SELECT id, name, firstname, password, age, phone, email FROM users WHERE email= ?');
			
			$req->bindValue(1,$email,PDO::PARAM_STR);
			$check=$req->execute();
			
			if($check){
				if($donnee = $req->fetch()){
					if($pass === $donnee['password']){
						$_SESSION['email']=$email;
						$_SESSION['id']=$donnee['id'];
						$_SESSION['name']=$donnee['name'];
						$_SESSION['firstname']=$donnee['firstname'];
						$_SESSION['age']=$donnee['age'];
						$_SESSION['phone']=$donnee['phone'];
						$_SESSION['mail']=$donnee['email'];
						echo "<script>alert('Conenxion reussie.')</script><br>";
						echo "<meta http-equiv='refresh' content='0; URL=espacePerso.php'>";
						
					}
					else
						echo "<script>alert('Mauvais identifiants.')</script><br>";
				}
				else
					echo "<script>alert('Mauvais identifiants.')</script><br>";
			}
			else
				echo "<script>alert('erreur de requete')</script><br>";
				$req->closeCursor();
		}
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
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
		<form action="#" method="POST" enctype="multipart/form-data" class="PH" >
			<input type="email" name="email" placeholder="Email" style="color: black;"/>
			<input type="password" name="password2" placeholder="Mot de passe" style="color: black;"/>
			<input type="submit" value="Connexion" class="button_connexion" type="button">
		</form>
      </ul>
    </div>
  </div>
</nav>

<div id="shadowing"></div>
	<div id="box">
		<span id="boxtitle"></span>	
		<?php
			include("register.php");
		?>
	</div>
</div>

<!-- First Container -->
<div class="container-fluid bg-1 text-center">
  <h3 class="margin">Bienvenue sur DébarraVite</h3>
  <h3>La plateforme collaborative qui met en relation des particuliers afin de faciliter le recyclage d'encombrants. </h3>
  <iframe width="860" height="480" src="https://www.youtube.com/watch?v=XXezrXF40Ks&rel=0"></iframe>
  <br>
  <input onclick="openbox('Inscription', 1)" value="Inscription" class="button_inscription" type="button">
</div>



<!-- Second Container -->
<div class="container-fluid bg-2 text-center">
  <h3 class="margin">What Am I?</h3>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
  <a href="#" class="btn btn-default btn-lg">
    <span class="glyphicon glyphicon-search"></span> Search
  </a>
</div>

<!-- Third Container (Grid) -->
<div class="container-fluid bg-3 text-center">    
  <h3 class="margin">Where To Find Me?</h3><br>
  <div class="row">
    <div class="col-sm-4">
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      <img src="birds1.jpg" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-4"> 
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      <img src="birds2.jpg" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
    <div class="col-sm-4"> 
      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
      <img src="birds3.jpg" class="img-responsive margin" style="width:100%" alt="Image">
    </div>
  </div>
</div>

<!-- Footer -->
<footer class="container-fluid bg-4 text-center">
  <p>Bootstrap Theme Made By <a href="https://www.w3schools.com">www.w3schools.com</a></p> 
</footer>

</body>
</html>
