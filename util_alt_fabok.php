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
			   	   alert("C�digo do fabricante atualizado com sucesso !");
		           window.history.go(-1);
                  </script>';
			
			exit;      
		
		}
	
	echo '<script language="javascript" type="text/javascript">
		   alert("Erro: N�mero da reclama��o inv�lido ou n�o corresponde !");
		   window.history.go(-1);
          </script>';
?>