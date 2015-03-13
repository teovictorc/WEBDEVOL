<? 
include("inc/conn.inc.php"); 
	$Sql = "SELECT * FROM rar_operadorlojacliente order by nomeoperador";
	$Stmt = mysql_query($Sql);
	while ($Rs = mysql_fetch_assoc($Stmt)){
		$Sql = " SELECT * ";
		$Sql.= " FROM RAR_PDV_REGISTRO ";
		$Sql.= " WHERE PDVRG_PESSOA = '".$Rs["CODIGOLOJA"]."'";
		$Sql.= "       and PDVRG_CODATIVIDADE = '1'";
		$Sql.= " ORDER BY PDVRG_DATAINCLUSAO DESC";
		$StmtI = mysql_query($Sql); //busca ultimo registro de RV Cliente para o cliente selecionado
		if ($RsI = mysql_fetch_assoc($StmtI)){
			if (verificar_email($RsI["PDVRG_OPERADOR_EMAIL"]) == 1){  //verifica se o email informado é valido
				$Email = $RsI["PDVRG_OPERADOR_EMAIL"];  //se for valido
			}else{
				$Email = $Rs["EMAILOPERADOR"];         //se nao for válido, pega da tabela auxiliar
			}
		}else{
			$Email = $Rs["EMAILOPERADOR"];   //se nao achar registro de rv, pega da tabela auxiliar
		}
		
//		die("Email = ".$Email);
		
		$Sql = " UPDATE rar_operadorloja SET ";
		if (verificar_email($Email) == 1){   //valida novamente se email é valido
			$Sql.= "        OPELJ_EMAIL = '".$Email."'";
		}else{
			$Sql.= "        OPELJ_EMAIL = null";
		}
		$Sql.= " where opelj_nome = '".$Rs["NOMEOPERADOR"]."'";
		echo($Sql."<BR>");
		$StmtO = mysql_query($Sql);
	}
	
	echo '<script language="javascript" type="text/javascript">
		   alert("Operadores atualizados com sucesso !");
          </script>';
?>