<? include("inc/conn.inc.php"); 
	$Sql = "SELECT * ";
	$Sql.= "  FROM RAR_USUARIO ";
	$Sql.= " WHERE USUAR_ECONSULTOR = 'S'";
	
	$Stmt = mysql_query($Sql);
	while($Rs = mysql_fetch_assoc($Stmt)){
		$Sql = " DELETE FROM RAR_USUARIOXCLIENTE ";
		$Sql.= " WHERE USUCLI_USUAR_IDO = '" .$Rs['USUAR_IDO']. "'";
		echo($Sql."<br>");
		$Stmt2 = mysql_query($Sql);
		
		$Sql = " SELECT CLIEN_EST_CLIENTE ";
		$Sql.= " FROM rar_cliente_estrutura ";
		$Sql.= " WHERE clien_est_consultor = '".$Rs['USUAR_CONSU_PESSOA']."'";
		$Sql.= " UNION SELECT CLIEN_EST_CLIENTE ";
		$Sql.= " FROM rar_cliente_estrutura ";
		$Sql.= " WHERE clien_est_coordenador = '".$Rs['USUAR_CONSU_PESSOA']."'";
		$Stmt2 = mysql_query($Sql);
		while($Rs2 = mysql_fetch_assoc($Stmt2)){
			$Sql = "insert into rar_usuarioxcliente (USUCLI_IDO, USUCLI_USUAR_IDO, USUCLI_PESSOA) ";
			$Sql.= " values (";
			$Sql.= " '".NewIdo()."',";
			$Sql.= " '".$Rs['USUAR_IDO']."',";
			$Sql.= " '".$Rs2['CLIEN_EST_CLIENTE']."')";
			$Stmt3 = mysql_query($Sql);
		}
	}
	
	
	
	?>
	<script>
	alert("Acessos atualizados com sucesso !");
	</script>
