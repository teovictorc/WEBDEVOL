<? include("inc/conn.inc.php"); 

	verifyAcess("CADFABRICANTE","S");

	$ID = modifyData($_POST["ID"]);

	$FABRI_PESSOA = modifyData($_POST["FABRI_PESSOA"]);

	$FABRI_CODSOLA = modifyData($_POST["FABRI_CODSOLA"]);

	$FABRI_AGENT_IDO = modifyData($_POST["FABRI_AGENT_IDO"]);
	$FABRI_EMAIL = modifyData($_POST["FABRI_EMAIL"]);

	

	if (!trim($_POST["ID"])) {

		$ID = newIDO();

		$Sql = "INSERT INTO rar_fabrica (FABRI_IDO," .

			   "FABRI_PESSOA,FABRI_AGENT_IDO,FABRI_CODSOLA,FABRI_EMAIL) VALUES ('" .

			   $ID . "', '" .$FABRI_PESSOA. "', '" .$FABRI_AGENT_IDO. "', '" .$FABRI_CODSOLA. "', '" .$FABRI_EMAIL. "')";

	}else{

		$Sql = "UPDATE rar_fabrica SET " .

			   "FABRI_PESSOA = '" .$FABRI_PESSOA. "' ".

			   ",FABRI_AGENT_IDO = '" .$FABRI_AGENT_IDO. "' ".
			   
			   ",FABRI_EMAIL = '" .$FABRI_EMAIL. "' ".

			   ",FABRI_CODSOLA = '" .$FABRI_CODSOLA. "' WHERE FABRI_IDO = '" .$ID. "'";

	}



	$Stmt = mysql_query($Sql);

	header("Location: pesq_fabricante.php");	

?>