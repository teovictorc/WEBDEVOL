<? 
include("inc/conn.inc.php"); 
verifyAcess("DES_UTIL_ICMS","S");

	$sql=mysql_query("SELECT prenf_numnfdevolucao,prenf_pessoa_destinatario FROM rar_prenf 
	                  WHERE prenf_numnfdevolucao ='".$_POST['nf']."' AND
			                prenf_pessoa_destinatario ='".$_POST['cod_cli']."'");
		while ($linha=mysql_fetch_array($sql))
		 {
		    $icms=($_POST['icms']/100);
		 	
			mysql_query("UPDATE rar_prenf SET prenf_icms='$icms'
						 where prenf_pessoa_destinatario ='".$_POST['cod_cli']."' and 
						       prenf_numnfdevolucao ='".$_POST['nf']."'");
			
			echo '<script language="javascript" type="text/javascript">
			   	   alert("ICMS atualizado com sucesso !");
		           window.history.go(-1);
                  </script>';
			
			exit;      
		}
	
	echo '<script language="javascript" type="text/javascript">
		   alert("Erro: Nota fiscal e código do cliente inválidos ou não correspondem !");
		   window.history.go(-1);
          </script>';
?>