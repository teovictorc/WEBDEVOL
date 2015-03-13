<? include("inc/conn.inc.php"); 
	
	$ACESS = $_POST['ACESS'];
	$ID = $_POST['ID'];
	verifyAcess("CADVINCSANJOCOORD","S");
	
	$Stmt = mysql_query("DELETE FROM rar_anjo_coordenador WHERE anjco_usuar_ido = '" .$ID. "'");

	if (trim($_POST['ACESS'])) {
		$Ids = explode(",",$ACESS);
		for($x = 0; $x < count($Ids); $x++) {
		    $Sql = "INSERT INTO rar_anjo_coordenador (ANJCO_IDO,ANJCO_USUAR_IDO,ANJCO_PESSOA) VALUES ('" . newIDO() .
			       "','" .$ID. "','" .$Ids[$x]. "')";
			$Stmt = mysql_query($Sql);
		}
	}
	header("Location: pesq_anjoxcoordenador.php?USUAR_IDO=" . $ID);	
?>