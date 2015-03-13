<?
	if (!trim($_SESSION['sId'])	|| !trim($_SESSION['sNome']))
		header("Location: login.php?Error=3");


?>