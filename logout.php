<?php
	session_start();
	session_destroy();
	echo "<script>alert('déconnexion réussie.') </script><br>";
	header('Location: index.php');
	exit;
?>