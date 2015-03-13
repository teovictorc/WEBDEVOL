<? 
include("inc/conn.inc.php"); 
verifyAcess("DES_UTIL_ALT_NNF","S");

	$sql=mysql_query("SELECT PRENF_NUMPRENF FROM rar_prenf 
	                  WHERE PRENF_NUMPRENF ='".$_POST['prenf']."'");
		while ($linha=mysql_fetch_array($sql))
		 {	
			mysql_query("UPDATE rar_prenf SET PRENF_NUMNFDEVOLUCAO = '".$_POST['novon']."'
						 where PRENF_NUMPRENF ='".$_POST['prenf']."'");
			
			echo '<script language="javascript" type="text/javascript">
			   	   alert("Número da Nota Fiscal atualizado com sucesso !");
		           window.history.go(-1);
                  </script>';
			
			exit;      
		
		}
	
	echo '<script language="javascript" type="text/javascript">
		   alert("Erro: Esse número de nota fiscal não existe !");
		   window.history.go(-1);
          </script>';
?>