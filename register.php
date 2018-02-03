
	<form action="#" method="POST" enctype="multipart/form-data" class="PH">
	
		<span id="boxtitle">Inscription</span>
		
		<input type="text" name="name" placeholder="Entrer votre nom" style="color: black;"/><br>
		<input type="text" name="surname" placeholder="Entrer votre prenom" style="color: black;"/> <br><br>
		
		<input type="email" name="email" placeholder="Email" style="color: black;"/><br><br>
		
		<input type="password" name="passwd" placeholder="Mot de passe" style="color: black;"/><br>
		
		<input type="submit" class="button_inscription" value="S'inscrire"/>
		<input type="button" class="button_inscription" name="cancel" value="Annuler" onclick="closebox()">
		
	</form>
	</div>
	<?php
		if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['surname']) && !empty($_POST['surname']) && isset($_POST['email']) && !empty($_POST['email']) &&
			isset($_POST['email2']) && !empty($_POST['email2']) && isset($_POST['passwd']) && !empty($_POST['passwd']) && isset($_POST['passwd2']) && !empty($_POST['passwd2']) &&
			isset($_POST['adress']) && !empty($_POST['adress']) && isset($_POST['role']) && !empty($_POST['role']) && isset($_POST['rpps'])  &&
			is_string($_POST['name']) && is_string($_POST['surname']) && is_string($_POST['email']) && is_string($_POST['email2']) && is_string($_POST['passwd']) && 
			is_string($_POST['passwd2']) && is_string($_POST['adress']) && is_string($_POST['role'])){
			
			$name=htmlspecialchars($_POST['name']);
			$surname=htmlspecialchars($_POST['surname']);
			$email=htmlspecialchars($_POST['email']);
			$email2=htmlspecialchars($_POST['email2']);
			$passwd=htmlspecialchars($_POST['passwd']);
			$passwd2=htmlspecialchars($_POST['passwd2']);
			$adress=htmlspecialchars($_POST['adress']);
			$role=htmlspecialchars($_POST['role']);
			$rpps=htmlspecialchars($_POST['rpps']);
			
			$groupe=-1;
			$docteur= array("chirurgien","medecin","kinésithérapeute");
			$autreDocteur= array("psychologue");
			$aide= array("soignant");
			
			
			if(in_array($role, $docteur))
				$groupe=2;
			else if(in_array($role, $autreDocteur))
				$groupe=5;
			else if(in_array($role, $aide))
				$groupe=4;
			else
				$groupe=-1;
			
			######################## VERIF ######################
			$flgLen=false;
			$flgOk=false;
			$flgPass=false;
			
			if((ctype_alpha($name) || strstr($name, " ")) && (ctype_alpha($surname) || strstr($surname, " "))  &&  ctype_alpha($role) && 
				(ctype_alnum($adress) || strstr($adress, " ")) && verifEntry($email) && verifEntry($email2) && ctype_alnum($passwd) && ctype_alnum($passwd2) &&
				verifEntry($name) && verifEntry($surname) && verifEntry($adress)){
				$flgOk=true;
				
			}
			else
				$flgOk=false;
			
			if(strlen($name)>=2 && strlen($surname)>=2 && strlen($role)>=2 && strlen($adress)>=2 && strlen($passwd)<=50 && strlen($passwd)>=10 )
				$flgLen=true;
			else
				$flgLen=false;
			
			$i=0;
			
			$checkPass=array(
				"maj" => false,
				"min" => false,
				"num" => false
				);
				
			
			while($i<strlen($passwd) && strlen($passwd)<50){
				
				if($passwd[$i]>='a' && $passwd[$i]<='z' && $checkPass['min']=== false)
					$checkPass['min']=true;
				
				if($passwd[$i]>='A' && $passwd[$i]<='Z' && $checkPass['maj'] === false)
					$checkPass['maj']=true;
				
				if($passwd[$i]>='0' && $passwd[$i]<='9' && $checkPass['num']===false)
					$checkPass['num']=true;
				
				$i=$i+1;
				
			}
			
			if($checkPass['min']===true && $checkPass['maj']===true  && $checkPass['num']===true)
				$flgPass=true;
			else
				$flgPass=false;
			
			
			
			
			######################## VERIF ######################
			
			$extensions_valides = array( 'jpg' , 'png' );
			
			$maxsize=8000000;
			if($flgOk===true && $flgLen===true && $flgPass===true){
				if($groupe!=-1){
					if($email === $email2){
						if(preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email) && preg_match('#^[\w.-]+@[\w.-]+\.[a-z]{2,6}$#i', $email2)){
							if($passwd === $passwd2){
								if(strlen($passwd)>=10 && verifEntry($passwd)){
									if((strlen($rpps)==11 && ctype_digit($rpps))|| strlen($rpps)==0){
										if($_FILES['fileName']['error'] === 0 ){
											$typeFichier=$_FILES['fileName']['type'];
											
											if ($_FILES['fileName']['size'] <= $maxsize && ($typeFichier ==="image/jpeg" || $typeFichier ==="image/png" ) ){
												
												$extension_upload = strtolower( substr( strrchr($_FILES['fileName']['name'], '.')  ,1));
												if (in_array($extension_upload,$extensions_valides) && verifEntry($_FILES['fileName']['name']) && strstr($_FILES['fileName']['name'], 'php') ===false 
													&& strstr($_FILES['fileName']['name'], 'sh') ===false ){
													
													$tmp_fileName=htmlspecialchars($_FILES['fileName']['name']);
													
													
													$passwd=password_hash($passwd, PASSWORD_BCRYPT, ['cost' => 13]);
													
													$fileNameUnique=hash('sha512',uniqid(rand(), true).$passwd.''.$rpps); 
													
													$fileNameUnique=$email.'_'.$fileNameUnique.'.'.$extension_upload; 
													
													
													$path='uploads/'.$fileNameUnique;
													
													$result = move_uploaded_file($_FILES['fileName']['tmp_name'],$path);
													
													if($result){
														
														
														
														include("includes/bdd_connexion.php");
														
														$req = $bdd->prepare("SELECT doctorId FROM doctor WHERE doctorEmail= ? ");
														$req->bindValue(1, $email, PDO::PARAM_STR);
														$flgDouble=true;
														$check=$req->execute();
														if($check){
															if($donnee=$req->fetch())
																$flgDouble=false;
														
														}
														else
															echo "<script>alert('Un problème c'est produit lors de la requete.')</script> <br>";
														
														$req->closeCursor();
														
														
														if($flgDouble === true){
															$uniqToken=password_hash(hash("sha512",uniqid(rand(), true).$fileNameUnique.$passwd),PASSWORD_BCRYPT, ['cost' => 13]);  
																			
															$req = $bdd->prepare("INSERT INTO doctor (doctorName, doctorSurname, doctorEmail, 
																									doctorPass, doctorAdress, doctorRole, doctorRPPS, 
																									doctorFileName, doctorGroup, doctorActivateEmail ,doctorActivate,doctorToken)
																					VALUES(?,?,?,?,?,?,?,?,?,false,false,?) ");
															
															$req->bindValue(1, $name, PDO::PARAM_STR);
															$req->bindValue(2, $surname, PDO::PARAM_STR);
															$req->bindValue(3, $email, PDO::PARAM_STR);
															$req->bindValue(4, $passwd, PDO::PARAM_STR);
															$req->bindValue(5, $adress, PDO::PARAM_STR);
															$req->bindValue(6, $role, PDO::PARAM_STR);
															$req->bindValue(7, $rpps, PDO::PARAM_STR);
															$req->bindValue(8, $fileNameUnique, PDO::PARAM_STR);
															$req->bindValue(9, $groupe, PDO::PARAM_STR);
															$req->bindValue(10, $uniqToken, PDO::PARAM_STR);
																											
															$check=$req->execute();
														
															if($check)
																echo "<script>alert('inscription réussite et terminé !') </script><br>";
															else
																echo "<script>alert('Un problème c'est produit lors de la requete. ')</script><br>";
															
															$req->closeCursor();
														}
														else
															echo "<div id='premierPlan'><script>alert('Adresse mail existe deja.')</script><br> </div>";
														
														
													}
													else
														echo " <div id='premierPlan'><script> alert('Probleme lors du transfert.') </script><br> </div>";
												}
												else
													echo " <div id='premierPlan'><script> alert('Extension incorrecte. ')</script><br> </div>";
											}
											else
												echo " <div id='premierPlan'> <script> alert('Le fichier est trop gros. ')</script><br> </div>";
										}
										else
											echo " <div id='premierPlan'><script>alert(' Erreur lors du transfert.')</script><br> </div>";
									}
									else
										echo " <div id='premierPlan'><script>alert(' Numéro RPPS incorrect.')</script><br> </div>";
								}
								else
									echo " <div id='premierPlan'><script> alert('Le mot de passe est trop court.')</script><br></div>";
							}
							else
								echo " <div id='premierPlan'><script>alert(' Les mots de passe sont différents.')</script><br> </div>";
						}
						else
							echo " <div id='premierPlan'><script> alert('Les adresses mails ne sont pas conformes.')</script><br> </div>";
					}
					else
						echo " <div id='premierPlan'><script>alert(' Les adresses mails sont différentes.')</script><br> </div>";
				}
				else
					echo " <div id='premierPlan'><script>alert(' Cette discipline n'existe pas.')</script> </div>";
			}
			else
				echo " <div id='premierPlan'><script>alert('Mauvaise saisie.')</script><br> </div>";
					
		}
	?>
	<!--</p>

</body>
</html>
-->
