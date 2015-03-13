<? include("inc/conn.inc.php"); 
	$Sql = " UPDATE RAR_USUARIO ";
	$Sql.= "        SET USUAR_SENHA = '".$_POST["SENHA"]."' ";
	$Sql.= " WHERE USUAR_IDO = '" .$_SESSION['sId']. "'";
	$Stmt = mysql_query($Sql);
?>
<script language="javascript" type="text/javascript">
	alert("Senha alterada com sucesso !");
	document.location.href = 'principal.php';
</script>
