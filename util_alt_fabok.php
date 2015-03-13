<? 
include("inc/conn.inc.php"); 
verifyAcess("DES_UTIL_ALT_FAB","S");

	$sql=mysql_query("SELECT lanca_numrar FROM rar_lancamento
	                  WHERE lanca_numrar ='".$_POST['lanca_numrar']."'");
		while ($linha=mysql_fetch_array($sql))
		 {	
			mysql_query("UPDATE rar_lancamento SET lanca_fabri_ido = '".$_POST['lanca_fabri_ido_novo']."'
						 WHERE lanca_numrar ='".$_POST['lanca_numrar']."'");
			
			echo '<script language="javascript" type="text/javascript">
			   	   alert("Código do fabricante atualizado com sucesso !");
		           window.history.go(-1);
                  </script>';
			
			exit;      
		
		}
	
	echo '<script language="javascript" type="text/javascript">
		   alert("Erro: Número da reclamação inválido ou não corresponde !");
		   window.history.go(-1);
          </script>';
?>