
	<form action="#" method="POST" enctype="multipart/form-data" class="PH">
	
		<span id="boxtitle">Inscription</span>
		
		<input type="text" name="name" placeholder="Nom" style="color: black;"/><br>
		<input type="text" name="firstname" placeholder="Prenom" style="color: black;"/> <br><br>
		
		<input type="email" name="email" placeholder="Email" style="color: black;"/><br><br>
		
		<input type="text" name="phone" placeholder="Telephone" style="color: black;"/><br><br>
		
		<input type="int" name="age" placeholder="Age" style="color: black;"/><br><br>
		
		<input type="password" name="password" placeholder="Mot de passe" style="color: black;"/><br>
		
		<input type="submit" class="button_inscription" value="S'inscrire"/>
		<input type="button" class="button_inscription" name="cancel" value="Annuler" onclick="closebox()">
		
	</form>
	</div>
	<?php
		if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['firstname']) && !empty($_POST['firstname']) && isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['phone']) && !empty($_POST['phone']) && isset($_POST['age']) && !empty($_POST['age'])){
			
			
			
			$name=htmlspecialchars($_POST['name']);
			$firstname=htmlspecialchars($_POST['firstname']);
			$email=htmlspecialchars($_POST['email']);
			$passwd=htmlspecialchars($_POST['password']);
			$phone=htmlspecialchars($_POST['phone']);
			$age=htmlspecialchars($_POST['age']);

			include("connect.php");
			
			$req = $bdd->prepare("INSERT INTO users (name, firstname, phone, email, 
													password, age)
									VALUES(?,?,?,?,?,?) ");
			
			$req->bindValue(1, $name, PDO::PARAM_STR);
			$req->bindValue(2, $firstname, PDO::PARAM_STR);
			$req->bindValue(3, $phone, PDO::PARAM_STR);
			$req->bindValue(4, $email, PDO::PARAM_STR);
			$req->bindValue(5, $passwd, PDO::PARAM_STR);
			$req->bindValue(6, $age, PDO::PARAM_STR);
															
			$check=$req->execute();
		
			if($check)
				echo "<script>alert('inscription réussite et terminé !') </script><br>";
			else
				echo "<script>alert('Un problème s'est produit lors de la requete. ')</script><br>";
			
			$req->closeCursor();
			}

			?>