<? //include("inc/conn.inc.php");
   include("inc/conn.inc.php");

	$Sql = "SELECT * FROM RAR_USUARIO WHERE USUAR_IDO NOT IN (SELECT USUFOR_USUAR_IDO FROM RAR_USUARIOXFORNECEDOR) AND USUAR_TIPOUSUARIO <> 'F'";
	$Stmt = mysql_query($Sql);
	while($Rs = mysql_fetch_assoc($Stmt)){
		$Stmt2 = mysql_query("SELECT * FROM PESSOA WHERE EFORNECEDOR = 'S'");
		while($Rs2 = mysql_fetch_assoc($Stmt2)){
			$ID = newIDO();
			$Sql = "INSERT INTO RAR_USUARIOXFORNECEDOR (";
			$Sql.= "USUFOR_IDO, USUFOR_USUAR_IDO, USUFOR_PESSOA) VALUES ('" . newIDO() .
						   "','" .$Rs["USUAR_IDO"]. "','" .$Rs2["PESSOA"]. "')";
			echo($Sql."<br>");
			$Stmts = mysql_query($Sql);
		}
	}
?>