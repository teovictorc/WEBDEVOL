<? include("inc/conn.inc.php"); 
	ini_set('session.cookie_lifetime', 0);
	ini_set('session.gc_maxlifetime', 3600);
	
	$Sql = "SELECT * ";
	$Sql.= "  FROM RAR_USUARIO ";
	$Sql.= " WHERE USUAR_RECEBEAUTOVINCULACAO  = 'S'";
	
	$Stmt = mysql_query($Sql);
	while($Rs = mysql_fetch_assoc($Stmt)){
		$Sql = " DELETE FROM RAR_USUARIOXCLIENTE ";
		$Sql.= " WHERE USUCLI_USUAR_IDO = '" .$Rs['USUAR_IDO']. "'";
		//echo($Sql."<br>");
		$Stmt2 = mysql_query($Sql);
		
		$Sql = " SELECT * from pessoa where ecliente in ('S',1)";
		$Stmt2 = mysql_query($Sql);
		while($Rs2 = mysql_fetch_assoc($Stmt2)){
			$Sql = "insert into rar_usuarioxcliente (USUCLI_IDO, USUCLI_USUAR_IDO, USUCLI_PESSOA) ";
			$Sql.= " values (";
			$Sql.= " '".NewIdo()."',";
			$Sql.= " '".$Rs['USUAR_IDO']."',";
			$Sql.= " '".$Rs2['PESSOA']."')";
			$Stmt3 = mysql_query($Sql);
		}
	}
	
	$Sql = "update rar_config set CONFIG_VINC_USUARIOXCLIENTE = now()";
	$St = mysql_query($Sql);
	
	
	?>
	<script>
	alert("Acessos atualizados com sucesso !");
	document.location.href = "util_usuariosxloja.php";
	</script>
