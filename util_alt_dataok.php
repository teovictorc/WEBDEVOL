<? 
include("inc/conn.inc.php"); 
verifyAcess("DES_UTIL_ALT_DATA","S");

	$sql=mysql_query("SELECT prenf_numnfdevolucao,prenf_pessoa_destinatario FROM rar_prenf 
	                  WHERE prenf_numnfdevolucao ='".$_POST['nf']."' AND
			                prenf_pessoa_destinatario ='".$_POST['cod_cli']."'");
		while ($linha=mysql_fetch_array($sql))
		 {
        	
			$PRENF_DATA_INFNFDEVOLUCACAO=$_POST['PRENF_DATA_INFNFDEVOLUCACAO'];
			$dia=strval(substr($PRENF_DATA_INFNFDEVOLUCACAO,0,2)); 
    		$mes=strval(substr($PRENF_DATA_INFNFDEVOLUCACAO,3,2)); 
    		$ano=strval(substr($PRENF_DATA_INFNFDEVOLUCACAO,6,5)); 
    		$PRENF_DATA_INFNFDEVOLUCACAO1=$ano."-".$mes."-".$dia;
			
			mysql_query("UPDATE rar_prenf SET PRENF_DATA_INFNFDEVOLUCACAO = '$PRENF_DATA_INFNFDEVOLUCACAO1'
						 where prenf_pessoa_destinatario ='".$_POST['cod_cli']."' and 
						       prenf_numnfdevolucao ='".$_POST['nf']."'");
			
			echo '<script language="javascript" type="text/javascript">
			   	   alert("Data atualizada com sucesso !");
		           window.history.go(-1);
                  </script>';
			
			exit;      
		}
	
	echo '<script language="javascript" type="text/javascript">
		   alert("Erro: Nota fiscal e código do cliente inválidos ou não correspondem !");
		   window.history.go(-1);
          </script>';
?>