<? include("inc/conn.inc.php"); 
	$Sql = "SELECT * ";
	$Sql.= "  FROM RAR_USUARIO ";
	$Stmt = mysql_query($Sql);
	while($Rs = mysql_fetch_assoc($Stmt)) {  
		$Sql = "insert into rar_usuarioxcliente (usucli_ido, usucli_usuar_ido, usucli_pessoa) values (";
		$Sql.= "'".newIDO()."',";
		$Sql.= "'".$Rs["USUAR_IDO"]."',";
		$Sql.= "0)";
		$StmtT = mysql_query($Sql);
		echo("usuario: ".$Rs["USUAR_NOME"]."<br>");
	}
	die("fim....");
?>

