<? 
include("inc/conn.inc.php"); 
verifyAcess("DES_UTIL_ALT_SERIE","S");

	$sql=mysql_query("SELECT prenf_numnfdevolucao,prenf_pessoa_destinatario FROM rar_prenf 
	                  WHERE prenf_numnfdevolucao ='".$_POST['nf']."' AND
			                prenf_pessoa_destinatario ='".$_POST['cod_cli']."'");
		while ($linha=mysql_fetch_array($sql))
		 {	
			mysql_query("UPDATE rar_prenf SET PRENF_SERIE = '".$_POST['PRENF_SERIE']."'
						 where prenf_pessoa_destinatario ='".$_POST['cod_cli']."' and 
						       prenf_numnfdevolucao ='".$_POST['nf']."'");
			
			echo '<script language="javascript" type="text/javascript">
			   	   alert("Série atualizada com sucesso !");
		           window.history.go(-1);
                  </script>';
			
			exit;      
		
		}
	
	echo '<script language="javascript" type="text/javascript">
		   alert("Erro: Nota fiscal e código do cliente inválidos ou não correspondem !");
		   window.history.go(-1);
          </script>';
?>