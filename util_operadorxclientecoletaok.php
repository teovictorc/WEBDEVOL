<? 
include("inc/conn.inc.php"); 
	$Sql = "SELECT * FROM rar_operadorlojacliente order by CODIGOLOJA";
	$Stmt = mysql_query($Sql);
	while ($Rs = mysql_fetch_assoc($Stmt)){
		$Sql = " SELECT * ";
		$Sql.= " FROM RAR_operadorloja ";
		$Sql.= " WHERE opelj_nome = '".$Rs["NOMEOPERADOR"]."'";
		$StmtI = mysql_query($Sql); //busca IDO do operador na tabela operadorloja
		if ($RsI = mysql_fetch_assoc($StmtI)){
			$Sql = " UPDATE rar_cliente_coleta SET ";
			$Sql.= "        CLIEN_OPELJ_IDO = '".$RsI["OPELJ_IDO"]."'";
			$Sql.= " where CLIEN_COL_PESSOA = '".$Rs["CODIGOLOJA"]."'";
			echo($Sql."<BR>");
			$StmtO = mysql_query($Sql);
		}
	}
	
	echo '<script language="javascript" type="text/javascript">
		   alert("Cliente x Coleta atualizados com sucesso !");
          </script>';
?>