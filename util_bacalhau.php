<? include("inc/conn.inc.php"); 
	$Sql = "SELECT PDVRG_IDO, date_format( pdvrg_hora_inicio, '%H:%i' ) PDVRG_HORA_INICIO, ";
	$Sql.= "       date_format( pdvrg_hora_fim, '%H:%i' ) PDVRG_HORA_FIM ";
	$Sql.= " FROM rar_pdv_registro ";
	$Sql.= " WHERE pdvrg_inccelular = 'S' ";
	//$Sql.= "       AND pdvrg_usuar_ido = 1779694";
	$Stmt = mysql_query($Sql);
	while($Rs = mysql_fetch_assoc($Stmt)) {
		$Sql = "UPDATE RAR_PDV_REGISTRO SET ";
		$Sql.= "       PDVRG_HORA_INICIO = date_format('2005-01-01 " .EncaixaHorario($Rs['PDVRG_HORA_INICIO']). ":00','%d/%m/%y %H:%i:%s'),";
		$Sql.= "       PDVRG_HORA_FIM = date_format('2005-01-01 " .EncaixaHorario($Rs['PDVRG_HORA_FIM']). ":00','%d/%m/%y %H:%i:%s')";
		$Sql.= " where pdvrg_ido = '".$Rs['PDVRG_IDO']."'";
		echo($Rs['PDVRG_HORA_INICIO']." - ".$Rs['PDVRG_HORA_FIM']."<br>".$Sql."<br><br><br>");
		$Stmt2 = mysql_query($Sql);
	}
?>

