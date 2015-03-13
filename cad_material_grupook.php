<? include("inc/conn.inc.php"); 
	verifyAcess("CADMATERIALGRUPO","S");
	$ID = $_POST["ID"];
	$MATERG_DESCRICAO = modifyData($_POST["MATERG_DESCRICAO"]);
	$MATERG_CATEGORIA = modifyData($_POST["MATERG_CATEGORIA"]);
	
	if (!trim($_POST["ID"])) {
		$ID = newIDO();
		$Sql = "INSERT INTO rar_material_grupo (" .
			   "MATERG_IDO,MATERG_DESCRICAO, MATERG_CATEGORIA) VALUES ('" .
			   $ID. "', '" .$MATERG_DESCRICAO. "','".$MATERG_CATEGORIA."')";
	}else{
		$Sql = "UPDATE rar_material_grupo SET " .
			   " MATERG_DESCRICAO = '" .$MATERG_DESCRICAO. "', ".
			   " MATERG_CATEGORIA = '" .$MATERG_CATEGORIA. "' ".
			   " WHERE MATERG_IDO = '" .$ID. "'";
	}
	
	$Stmt = mysql_query($Sql);
	header("Location: pesq_material_grupo.php");	
?>