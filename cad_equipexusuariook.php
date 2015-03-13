<? include("inc/conn.inc.php"); 
	
	$ACESS = $_POST['ACESS'];
	$ID = $_POST['ID'];
	verifyAcess("CADVINCULOEQUIPE","S");
	
	//$Stmt = mysql_query("DELETE FROM RAR_equipexusuario WHERE equsu_equip_IDO = '" .$ID. "'");

	if (trim($_POST['ACESS'])) {
		$Ids = explode(",",$ACESS);
		for($x = 0; $x < count($Ids); $x++) {
			//verifica se usuario ja nao está vinculado para a equipe
			$Sql = " select * from rar_equipexusuario ";
			$Sql.= " where equsu_equip_ido = '".$ID."'";
			$Sql.= "       and equsu_usuar_ido = '".$Ids[$x]."'";
			$Stmt = mysql_query($Sql);
			if (!$Rs = mysql_fetch_assoc($Stmt)){
		    	$Sql = "INSERT INTO RAR_equipexusuario (EQUSU_IDO,EQUSU_EQUIP_IDO,EQUSU_USUAR_IDO) VALUES ('" . newIDO() .
			       "','" .$ID. "','" .$Ids[$x]. "')";
				$Stmt = mysql_query($Sql);
			}
		}
	}
	header("Location: pesq_equipexusuario.php?EQUIP_IDO=" . $ID);	
?>