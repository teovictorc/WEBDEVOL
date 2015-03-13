<? include("inc/conn.inc.php"); 
	$Sql = "SELECT * ";
	$Sql.= "  FROM RAR_USUARIO ";
	$Sql.= " WHERE USUAR_ECONSULTOR = 'S'";
	echo($Sql);
	$Stmt = mysql_query($Sql);
	while($Rs = mysql_fetch_assoc($Stmt)){
		$Sql = " DELETE FROM RAR_ACESSO ";
		$Sql.= " WHERE ACESS_USUAR_IDO = '" .$Rs['USUAR_IDO']. "'";
		$Sql.= "       AND ACESS_PROGR_CODIGO IN ('ALTERNAR_RV','PDV_CONS_CONS_ATIV', 'PDV_CONS_INCLUSAO')";
		echo($Sql."<br>");
		$Stmt1 = mysql_query($Sql);
		
		$Sql = "insert into rar_acesso (ACESS_IDO, ACESS_TIPOACESSO, ACESS_USUAR_IDO, ACESS_PROGR_CODIGO) ";
		$Sql.= " values (";
		$Sql.= " '".NewIdo()."',";
		$Sql.= " 'T',";
		$Sql.= " '".$Rs['USUAR_IDO']."',";
		$Sql.= " 'ALTERNAR_RV')";
		echo($Sql."<br>");
		$Stmt1 = mysql_query($Sql);
		
		$Sql = "insert into rar_acesso (ACESS_IDO, ACESS_TIPOACESSO, ACESS_USUAR_IDO, ACESS_PROGR_CODIGO) ";
		$Sql.= " values (";
		$Sql.= " '".NewIdo()."',";
		$Sql.= " 'T',";
		$Sql.= " '".$Rs['USUAR_IDO']."',";
		$Sql.= " 'PDV_CONS_CONS_ATIV')";
		echo($Sql."<br>");
		$Stmt1 = mysql_query($Sql);
		
		$Sql = "insert into rar_acesso (ACESS_IDO, ACESS_TIPOACESSO, ACESS_USUAR_IDO, ACESS_PROGR_CODIGO) ";
		$Sql.= " values (";
		$Sql.= " '".NewIdo()."',";
		$Sql.= " 'T',";
		$Sql.= " '".$Rs['USUAR_IDO']."',";
		$Sql.= " 'PDV_CONS_INCLUSAO')";
		echo($Sql."<br>");
		$Stmt1 = mysql_query($Sql);
	}
	
	
	
	?>
	<script>
	alert("Acessos atualizados com sucesso !");
	</script>
