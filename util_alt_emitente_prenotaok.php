<? 
include("inc/conn.inc.php"); 
verifyAcess("UTIL_ALTEREMIT_PRENF","S");

	$sql=mysql_query("SELECT prenf_numprenf FROM rar_prenf
	                  WHERE prenf_numnfdevolucao = '".$_POST['prenf_numnfdevolucao']."'
					        and prenf_pessoa_destinatario = '".$_POST['prenf_pessoa_destinatario']."'");
		while ($linha=mysql_fetch_array($sql))
		 {	
			mysql_query("UPDATE rar_prenf 
			                SET prenf_pessoa_emitente = '".$_POST['prenf_pessoa_emitente']."'
						  WHERE prenf_numnfdevolucao = '".$_POST['prenf_numnfdevolucao']."'
					            and prenf_pessoa_destinatario = '".$_POST['prenf_pessoa_destinatario']."'");
			
			echo '<script language="javascript" type="text/javascript">
			   	   alert("C�digo do emitente da pr�-nota atualizado com sucesso !");
		           window.history.go(-1);
                  </script>';
			
			exit;      
		
		}
	
	echo '<script language="javascript" type="text/javascript">
		   alert("Erro: Pr�-nota n�o localizada com os crit�rios informados !");
		   window.history.go(-1);
          </script>';
?>