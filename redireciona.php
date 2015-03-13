<? include("inc/conn_externa.inc.php"); 
	$_SESSION['Menu'] = $_GET['Menu'];
	header("Location: principal.php");
?>