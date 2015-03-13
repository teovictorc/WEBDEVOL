<? include("inc/conn.inc.php"); 
	
	$Stmt = mysql_query("SELECT * FROM rar_usuario WHERE USUAR_EFRANQUEADO = 'S' AND usuar_nome NOT LIKE '%(%'",$Conn);
	while($Rs = mysql_fetch_assoc($Stmt)) {
		$Sql = " INSERT INTO RAR_ACESSO (ACESS_IDO,ACESS_TIPOACESSO,ACESS_USUAR_IDO,ACESS_PROGR_CODIGO) ";
		$Sql.= " VALUES ('".newIDO()."','T'," .$Rs["USUAR_IDO"]. ",'ALTERNAR_TECNICO_MM')";
		$Stmt2 = mysql_query($Sql);
		
		$Sql = " INSERT INTO RAR_ACESSO (ACESS_IDO,ACESS_TIPOACESSO,ACESS_USUAR_IDO,ACESS_PROGR_CODIGO) ";
		$Sql.= " VALUES ('".newIDO()."','T'," .$Rs["USUAR_IDO"]. ",'ALTERNAR_SERVICO')";
		$Stmt2 = mysql_query($Sql);
		
	}
	
?>
<script language="javascript" type="text/javascript">
	alert("Usuários atualizados com sucesso!");
</script>
