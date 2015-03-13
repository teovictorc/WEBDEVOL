<? include("inc/conn.inc.php"); 

	verifyAcess("INCRECLAMACAO","S");

	$Sql = "DELETE FROM rar_item WHERE ITEM_NUMRAR IN ('".$_GET['IdDel']."')";

	$Stmt = mysql_query($Sql);

	$Sql = "DELETE FROM rar_lancamento WHERE LANCA_NUMRAR IN('".$_GET['IdDel']."')";

	$Stmt = mysql_query($Sql);
	
	
	$Sql = "DELETE FROM RAR_AVALIACAO WHERE AVALI_NUMRAR IN ('".$_GET['IdDel']."')";

	$Stmt = mysql_query($Sql);

?>
<?

	header("Location: pesq_cancelamento.php");
?>