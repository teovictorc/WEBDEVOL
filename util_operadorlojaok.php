<? 
include("inc/conn.inc.php"); 
	$Sql = "SELECT distinct NOMEOPERADOR FROM rar_operadorlojacliente order by nomeoperador";
	$Stmt = mysql_query($Sql);
	while ($Rs = mysql_fetch_assoc($Stmt)){
		$ID = newIDO();
		$Sql = "INSERT INTO rar_operadorloja (
						   opelj_ido,
						   opelj_nome) VALUES (".
						   "'".$ID. "',".
						   "'".$Rs["NOMEOPERADOR"]. "')";
		$StmtI = mysql_query($Sql);
		}
	
	echo '<script language="javascript" type="text/javascript">
		   alert("Operadores incluídos com sucesso !");
		   window.history.go(-1);
          </script>';
?>