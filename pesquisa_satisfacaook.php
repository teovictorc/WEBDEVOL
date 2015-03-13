<? include("inc/conn.inc.php"); 
	$ID = $_POST["ID"];
	$pesq_pessoa = modifyData($_POST["pesq_pessoa"]);
	$pesq_nome = modifyData($_POST["pesq_nome"]);
	$pesq_responsavel = modifyData($_POST["pesq_responsavel"]);
	$pesq_pergunta1 = modifyData($_POST["pesq_pergunta1"]);
	$pesq_pergunta2 = modifyData($_POST["pesq_pergunta2"]);
	$pesq_pergunta3 = modifyData($_POST["pesq_pergunta3"]);
	$pesq_pergunta4 = modifyData($_POST["pesq_pergunta4"]);
	$pesq_pergunta5 = modifyData($_POST["pesq_pergunta5"]);
	$pesq_pergunta6 = modifyData($_POST["pesq_pergunta6"]);
	$pesq_pergunta7 = modifyData($_POST["pesq_pergunta7"]);
	$pesq_pergunta8 = modifyData($_POST["pesq_pergunta8"]);
	$pesq_pergunta9 = modifyData($_POST["pesq_pergunta9"]);
	$pesq_pergunta10 = modifyData($_POST["pesq_pergunta10"]);
	$pesq_pergunta11 = modifyData($_POST["pesq_pergunta11"]);
	$pesq_comentario = modifyData($_POST["pesq_comentario"]);
	
	$Sql = "INSERT INTO PESQUISA_SATISFACAO (" .
			   "pesq_pessoa,".
			   "pesq_nome,".
			   "pesq_responsavel,".
			   "pesq_pergunta1,".
			   "pesq_pergunta2,".
			   "pesq_pergunta3,".
			   "pesq_pergunta4,".
			   "pesq_pergunta5,".
			   "pesq_pergunta6,".
			   "pesq_pergunta7,".
			   "pesq_pergunta8,".
			   "pesq_pergunta9,".
			   "pesq_pergunta10,".
			   "pesq_pergunta11, pesq_comentario, pesq_data) values (".
			   "'".$pesq_pessoa. "',".
			   "'".$pesq_nome. "',".
			   "'".$pesq_responsavel. "',".
			   "'".$pesq_pergunta1. "',".
			   "'".$pesq_pergunta2. "',".
			   "'".$pesq_pergunta3. "',".
			   "'".$pesq_pergunta4. "',".
			   "'".$pesq_pergunta5. "',".
			   "'".$pesq_pergunta6. "',".
			   "'".$pesq_pergunta7. "',".
			   "'".$pesq_pergunta8. "',".
			   "'".$pesq_pergunta9. "',".
			   "'".$pesq_pergunta10. "',".
			   "'".$pesq_pergunta11. "',".
			   "'".$pesq_comentario. "', now())";
	$Stmt = mysql_query($Sql);
	header("Location: pesquisa_satisfacao.php?msg=1");	
?>
