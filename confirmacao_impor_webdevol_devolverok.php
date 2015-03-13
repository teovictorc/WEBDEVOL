<? include("inc/conn.inc.php"); 

	verifyAcess("FORN_CREDITOPEND","S");

	

	if (trim($_POST['ID'])) {

			$Sql = "UPDATE rar_prenf SET ".

					" PRENF_MOTIVODEVOLUCAO = '" .$_POST['PRENF_MOTIVODEVOLUCAO']. "',".

					" PRENF_NUMNFDEVOLUCAO = NULL, ".

					" PRENF_DATA_NFDEVOLUCAO = NULL, ".

					" PRENF_DATA_INFNFDEVOLUCACAO = NULL, ".

					" PRENF_QTDEVOLUME = NULL, ".

					" PRENF_DATA_COLETA = NULL, ".

					" PRENF_DATA_SOLIC_COLETA = NULL, ".

					" PRENF_DATA_RECEBTO_COLETA = NULL, ".

					" PRENF_DATA_RECEBTO_AREZZO = NULL ".

					" WHERE PRENF_NUMPRENF = '" .$_POST['ID']. "'";

		$Stmt = mysql_query($Sql);

		

	}

	if ($_POST["Destino"] == "F"){

		header("Location: pesq_forne_credito.php");

	}else{

		header("Location: pesq_impor_webdevol.php");

	}

?>