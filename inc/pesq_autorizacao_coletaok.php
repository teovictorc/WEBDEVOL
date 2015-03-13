<? 

	include("inc/conn.inc.php"); ?>
	<form action="pesq_autorizacao_confirma.php" method="post" name="form">
	  <input type="hidden" name="Ids" id="Ids">
	</form>
	<?
	verifyAcess("ARZ_AUTORIZACAOCOLET","S");
	$menos14 = $_GET['Menos14'];
	//$Ids = str_replace("\'","'",$_GET['Ids']); -> alterado pela linha abaixo em 10/03/2006. motivo: estava estourando o tamanho do href.
	$Ids = str_replace("\'","'",$_POST['Ids']);
	
	$Sql = "SELECT PESSOA, SUM(ITEM_QTDE) QTDE ".
			" FROM RAR_LANCAMENTO, PESSOA, RAR_ITEM ".
			" WHERE LANCA_NUMRAR IN(" .$Ids. ") AND LANCA_NUMRAR = ITEM_NUMRAR".
			"        AND LANCA_PESSOA = PESSOA GROUP BY PESSOA";
	//die($Sql);
	$StmtI = mysql_query($Sql);
	$VarMenos14 = "";
	$Pessoas = "";
	$NumRows = 0;
	while($Rs = mysql_fetch_assoc($StmtI)) {
		$Rar = $Rs["PESSOA"];
		die $Rs["QTDE"];
		//alterado parametro de 14 para 20 pares em 25/05/2006 - conforme solicitacao Alcindo via email 25/05 09:42
		if ($Rs["QTDE"] >= 1) {
			$Pessoas = ((strlen($Pessoas) == 0) ? "" : ",") .$Rs["PESSOA"];
			$Sql = "select nofi.pessoa_emitente         CODIGO_EMITENTE".
					  ",peem.nome                       NOME_EMITENTE ".
					  ",peem.logradouro                 LOGRADOURO ".
					  ",peem.cgccpf                     CGCCPF ".
					  ",peem.ie                         INSC_ESTADUAL ".
					  ",peem.bairro                     BAIRRO ".
					  ",peem.cep                        CEP ".
					  ",peem.nm_municipio               MUNICIPIO ".
					  ",peem.sg_uf                      UF ".
					  ",pede.categoria_cliente          CATEGORIA ".
					  ",pede.sg_uf                      UFD ".
					  ",pede.optt_simples_estd          SIMPLES ".
					  ",pede.SUFR_BENF_ICMS             SUFRAMA ".
					  ",itnf.cd_item_material           PRODUTO ".
					  ",itma.ds_resumida_item           DESCRICAO_PRODUTO ".
					  ",itnf.vl_unitario_item           VL_UNITARIO ".
					  //",itnf.tl_item                    TOTAL_ITEM ".
					  ",itnf.unidade_medida             UN_MEDIDA ".
					  ",itnf.classificacao_fiscal       CLASS_FISCAL ".
					  ",itnf.aliq_icms                  ALIQ_ICMS ".
					  ",nofi.num_nf                     NUM_NF ".
					  ",nofi.serie_nf                   SERIE_NF ".
					  ",nofi.dt_emis_nf                 DT_EMISSAO_NF ".
					  ",I.ITEM_QTDE                ".
					  ",nofi.PESSOA_EMITENTE ".
					  ",nofi.PESSOA_DESTINATARIO ".
					  "from item_nota_fiscal     itnf ".
					       ",nota_fiscal          nofi ".
					       ",pessoa               peem ".
					       ",pessoa               pede ".
					       ",item_material        itma ".
					       //",referencia_material  rfma ".
					       ",RAR_LANCAMENTO L ".
					       ",RAR_ITEM I ".
					  "where nofi.pessoa_emitente = itnf.pessoa_emitente ".
					         " and nofi.serie_nf        = itnf.serie_nf ".
					         " and nofi.num_nf          = itnf.num_nf ".
					         " and nofi.pessoa_emitente = peem.pessoa ".
					         " and itnf.cd_item_material = itma.cd_item_material ".
					         //"and itma.rf_material      = rfma.rf_material(+) ".
					         " and nofi.pessoa_destinatario = L.lanca_pessoa ".
					         " and nofi.pessoa_destinatario = pede.pessoa ".
					         " AND L.lanca_numrar = I.item_numrar ".
					         " and nofi.num_nf          = I.item_nf ".
					         " and nofi.pessoa_emitente = I.item_pessoa_emitente ".
					         " and nofi.serie_nf        in ('U','UN','UNI','1') ".
					         " and itnf.cd_item_material = I.ITEM_REFERENCIA ".
					         " AND L.LANCA_NUMRAR IN(" .$Ids. ") ".
							 " AND L.LANCA_NUMRAR LIKE '" .substr($Rar,0,5). "%' ".
							" AND LANCA_CATEGORIA IN (".$_GET['Categoria'].") ".
					  "GROUP BY nofi.pessoa_emitente ".
						  ",peem.nome ".
						  ",peem.logradouro ".
						  ",peem.cgccpf ".
						  ",peem.ie ".
						  ",peem.bairro ".
						  ",peem.cep ".
						  ",peem.nm_municipio ".
						  ",peem.sg_uf ".
						  ",pede.categoria_cliente ".
						  ",pede.sg_uf ".
						  ",pede.optt_simples_estd ".
						  ",pede.SUFR_BENF_ICMS ".
						  ",itnf.cd_item_material ".
						  ",itma.ds_resumida_item ".
						  ",itnf.vl_unitario_item ".
						  ",itnf.unidade_medida ".
						  ",itnf.classificacao_fiscal ".
						  ",itnf.aliq_icms ".
						  ",nofi.num_nf ".
						  ",nofi.serie_nf ".
						  ",nofi.dt_emis_nf ".
						  ",I.ITEM_QTDE ".
						  ",nofi.PESSOA_EMITENTE ".
						  ", nofi.PESSOA_DESTINATARIO ";
					  
			$Sql.= " union ";
			
			$Sql.= "select ".
			          " nofi.pessoa_emitente            CODIGO_EMITENTE".
					  ",peem.nome                       NOME_EMITENTE ".
					  ",peem.logradouro                 LOGRADOURO ".
					  ",peem.cgccpf                     CGCCPF ".
					  ",peem.ie                         INSC_ESTADUAL ".
					  ",peem.bairro                     BAIRRO ".
					  ",peem.cep                        CEP ".
					  ",peem.nm_municipio               MUNICIPIO ".
					  ",peem.sg_uf                      UF ".
					  ",pede.categoria_cliente          CATEGORIA ".
					  ",pede.sg_uf                      UFD ".
					  ",pede.optt_simples_estd          SIMPLES ".
					  ",pede.SUFR_BENF_ICMS             SUFRAMA ".
					  ",itnf.cd_item_material           PRODUTO ".
					  ",itma.ds_resumida_item           DESCRICAO_PRODUTO ".
					  ",itnf.vl_unitario_item           VL_UNITARIO ".
					  //",itnf.tl_item                    TOTAL_ITEM ".
					  ",itnf.unidade_medida             UN_MEDIDA ".
					  ",itnf.classificacao_fiscal       CLASS_FISCAL ".
					  ",itnf.aliq_icms                  ALIQ_ICMS ".
					  ",nofi.num_nf                     NUM_NF ".
					  ",nofi.serie_nf                   SERIE_NF ".
					  ",nofi.dt_emis_nf                 DT_EMISSAO_NF ".
					  ",I.ITEM_QTDE                ".
					  ",nofi.PESSOA_EMITENTE".
					  ",cc.CLIEN_COL_PESSOA".
					  "from item_nota_fiscal     itnf ".
					       ",nota_fiscal          nofi ".
					       ",pessoa               peem ".
					       ",pessoa               pede ".
					       ",item_material        itma ".
					       //",referencia_material  rfma ".
					       ",RAR_LANCAMENTO L ".
					       ",RAR_ITEM I ".
						   ",RAR_CLIENTE_COLETA CC ".
					  "where nofi.pessoa_emitente = itnf.pessoa_emitente ".
					         " and nofi.serie_nf        = itnf.serie_nf ".
					         " and nofi.num_nf          = itnf.num_nf ".
					         " and nofi.pessoa_emitente = peem.pessoa ".
					         " and itnf.cd_item_material = itma.cd_item_material ".
					         //"and itma.rf_material      = rfma.rf_material(+) ".
					         " and nofi.pessoa_destinatario = cc.clien_col_lojaant".
						     " and cc.clien_col_pessoa = L.lanca_pessoa ".
					         " and nofi.pessoa_destinatario = pede.pessoa ".
					         " AND L.lanca_numrar = I.item_numrar ".
					         " and nofi.num_nf          = I.item_nf ".
					         " and nofi.pessoa_emitente = I.item_pessoa_emitente ".
					         " and nofi.serie_nf        in ('U','UN','UNI','1') ".
					         " and itnf.cd_item_material = I.ITEM_REFERENCIA ".
					         " AND L.LANCA_NUMRAR IN(" .$Ids. ") ".
							 " AND L.LANCA_NUMRAR LIKE '" .substr($Rar,0,5). "%' ".							 
							 " AND LANCA_CATEGORIA IN (".$_GET['Categoria'].") ".
			          " GROUP BY nofi.pessoa_emitente ".
					  ",peem.nome ".
					  ",peem.logradouro ".
					  ",peem.cgccpf ".
					  ",peem.ie ".
					  ",peem.bairro ".
					  ",peem.cep ".
					  ",peem.nm_municipio ".
					  ",peem.sg_uf ".
					  ",pede.categoria_cliente ".
					  ",pede.sg_uf ".
					  ",pede.optt_simples_estd ".
					  ",pede.SUFR_BENF_ICMS ".
					  ",itnf.cd_item_material ".
					  ",itma.ds_resumida_item ".
					  ",itnf.vl_unitario_item ".
					  ",itnf.unidade_medida ".
					  ",itnf.classificacao_fiscal ".
					  ",itnf.aliq_icms ".
					  ",nofi.num_nf ".
					  ",nofi.serie_nf ".
					  ",nofi.dt_emis_nf ".
					  ",I.ITEM_QTDE ".
					  ",nofi.PESSOA_EMITENTE ".
					  ",cc.CLIEN_COL_PESSOA ";
							 
				$Sql.= " ORDER BY CODIGO_EMITENTE ";	  
			
			die($Sql);
			$Stmt = mysql_query($Sql);
			$NF = "";
			$rollBack = false;
			$IdA = newIDO();
			$Sql = "INSERT INTO RAR_AUTORIZACAO VALUES (" .$IdA. ",NOW())";
			$StmtTemp = mysql_query($Sql);
			//if (!$rollBack) 
			//	$rollBack = (ociexecute($StmtTemp,OCI_DEFAULT)) ? false : true;
			$LOOP = 0;
			$NumRows = 0;
			while($Rs = mysql_fetch_assoc($Stmt)) {
				if ($NF != $Rs["CODIGO_EMITENTE"] || $LOOP >= $NumRows) {
					$StmtRow = mysql_query("SELECT CLIEN_COL_PESSOA,CLIEN_QTDELINHANF FROM RAR_CLIENTE_COLETA WHERE CLIEN_COL_PESSOA = '" .$Rs["PESSOA_DESTINATARIO"]. "'");
					if ($RsR = mysql_fetch_assoc($StmtRow))
						$NumRows = (trim($RsR["CLIEN_QTDELINHANF"])) ? $RsR["CLIEN_QTDELINHANF"] : 9999;
					else
						$NumRows = 9999;
					$LOOP = 0;
     				$NF = $Rs["CODIGO_EMITENTE"];
					
					/*incluido em 29/09/2005
					motivo: quando emitente = fabrica e não for simples SP, considera como emitente 18800
					        para juntar ítens na mesma pré-nota */
					if ($NF != 18800 && $NF != 19000)
						{
						  if (($Rs["CATEGORIA"] == 8 || $Rs["CATEGORIA"] == 9) && $Rs["SIMPLES"] == "S"  && $Rs["UFD"] == "SP") //Franquia Simples SP
						      $NF = $Rs["CODIGO_EMITENTE"];
						  else
						      $NF = "18800";
						}
					/*fim da inclusão - 29/09/2005*/
					  
					if ($NF != 18800 && $NF != 19000)  //emitente = fabrica
						{
							if ($Rs["CATEGORIA"] == 10) //cliente = multimarca
								{
									if ($Rs["UFD"] == $Rs["UF"])  //UF cliente = uf Fabrica
										{$Cfop = "5.102";        //alterado em 16/01/2006 - antes era: $Cfop = "5.202";
										$Operacao = "222";       //alterado em 16/01/2006 - antes era: $Operacao = "13";
										$Emitente = "18800";}    //alterado em 16/01/2006 - antes era: $Emitente = $NF;
									else   //uf cliente <> uf fábrica
										{$Cfop = "6.102";        //alterado em 16/01/2006 - antes era: $Cfop = "6.202";
										$Operacao = "222";       //alterado em 16/01/2006 - antes era: $Operacao = "13"; 
										$Emitente = "18800";}    //alterado em 16/01/2006 - antes era: $Emitente = $NF;
								}
							else if (($Rs["CATEGORIA"] == 8 || $Rs["CATEGORIA"] == 9) && $Rs["SIMPLES"] == "S"  && $Rs["UFD"] == "SP")  //cliente = franquia e simples SP
								{
									$Cfop = "6.202";             
									$Operacao = "202";           
									$Emitente = $NF;         
								}
							else if (($Rs["CATEGORIA"] == 8 || $Rs["CATEGORIA"] == 9)) //cliente = franquia
								{
									if ($Rs["UFD"] == $Rs["UF"])  //UF cliente = uf Fabrica
										{$Cfop = "5.102";
										$Operacao = "222";
										$Emitente = "18800";}
									else   //uf cliente <> uf fábrica
										{$Cfop = "6.102";
										$Operacao = "222";
										$Emitente = "18800";}
								}
							
						}else if ($NF == 19000) //se emitente = Arezzo SC
						{
							if ($Rs["UFD"] == $Rs["UF"])  //UF cliente = UF Emitente (SC)
								{$Cfop = "5.202";
								$Operacao = "13";
								$Emitente = $NF;}
							else   //UF Cliente <> UF Emitente (SC)
								{$Cfop = "6.202";
								$Operacao = "13";
								$Emitente = $NF;}
						}else if ($NF == 18800) //se emitente = Arezzo RS
						{
							if ($Rs["CATEGORIA"] == 10) //cliente = multimarca
								{
									if ($Rs["UFD"] == $Rs["UF"])  //UF cliente = UF Emitente (RS)
										{$Cfop = "5.202";
										$Operacao = "13";
										$Emitente = $NF;}
									else   //uf cliente <> UF Emitente (RS)
										{$Cfop = "6.202";
										$Operacao = "13";
										$Emitente = $NF;}
								}
							else if (($Rs["CATEGORIA"] == 8 || $Rs["CATEGORIA"] == 9) && $Rs["SIMPLES"] == "S"  && $Rs["UFD"] == "SP")  //cliente = franquia e simples SP
								{
									$Cfop = "6.202";
									$Operacao = "13";
									$Emitente = $NF;
								}
							else if (($Rs["CATEGORIA"] == 8 || $Rs["CATEGORIA"] == 9)) //cliente = franquia
								{
									if ($Rs["UFD"] == $Rs["UF"])  //UF cliente = UF Emitente (RS)
										{$Cfop = "5.202";   //alterado em 16/01/2006 - antes era: $Cfop = "5.102";
										$Operacao = "13";   //alterado em 16/01/2006 - antes era: $Operacao = "222";
										$Emitente = $NF;}
									else   //uf cliente <> uf fábrica
										{$Cfop = "6.202";   //alterado em 16/01/2006 - antes era: $Cfop = "6.102"; 
										$Operacao = "13";   //alterado em 16/01/2006 - antes era: $Operacao = "222"; 
										$Emitente = $NF;}
								}
					}						
					$IdPre = newIDO();
					//Verifica se cliente é SUFRAMA ou nao
					$AliqIcms = 0;
					if ($Rs["SUFRAMA"] != "S") {
						$AliqIcms = $Rs["ALIQ_ICMS"];
					}
					
					//Incluido em 14/03/2006
					//motivo: estava destacando ICMS para Franquias de SP que pertencem ao simples
					//if (($Rs["CATEGORIA"] == 8 || $Rs["CATEGORIA"] == 9) && $Rs["SIMPLES"] == "S"  && $Rs["UFD"] == "SP"){
					//alterado em 08/05/2006 - solicitado por Alcindo.
					//Motivo: para todas as franquias assinaladas como SIMPLES nao destaca ICMS, independente do estado
					if (($Rs["CATEGORIA"] == 8 || $Rs["CATEGORIA"] == 9) && $Rs["SIMPLES"] == "S" ){
						$AliqIcms = 0;
					}
					//fim da inclusao - 14/03/2006
				
					$Sql = "INSERT INTO RAR_PRENF (PRENF_DATA_ENVIO, PRENF_NUMPRENF,PRENF_PESSOA_EMITENTE,PRENF_PESSOA_DESTINATARIO,".
							"PRENF_AUTOR_NUMAUT,PRENF_OPER_IDO,PRENF_CFOP,PRENF_ICMS".
							") VALUES (now(), " .$IdPre. "," .$Emitente. ", ".
							$Rs["PESSOA_DESTINATARIO"]. ",'" .$IdA. "','" .$Operacao. "','" .$Cfop. "', '".
							$AliqIcms. "')";
					//echo ("<br>"."<br>".$Sql);
					$StmtTemp = mysql_query($Sql);
					//if (!$rollBack) 
					//	$rollBack = (ociexecute($StmtTemp,OCI_DEFAULT)) ? false : true;
				}
				$IdoItem = newIDO();
				$Sql =	"INSERT INTO RAR_PRENF_ITEM (PRENFI_IDO,PRENFI_NUMPRENF,PRENFI_REFERENCIA,PRENFI_UNIDADE,PRENFI_QUANTIDADE,PRENFI_VALORUNITARIO,PRENFI_ClASSIFICACAOFISCAL,LANCA_NUMRAR) VALUES (" .$IdoItem. ",'".
						$IdPre. "', '" .$Rs["PRODUTO"]. "', '" .$Rs["UN_MEDIDA"]. "', '".
						$Rs["ITEM_QTDE"]. "', '" .$Rs["VL_UNITARIO"]. "', '" .$Rs["CLASS_FISCAL"]. "', '" .$Rs["LANCA_NUMRAR"]. "')";
				//echo ("<br>".$Sql);
                $StmtTemp = mysql_query($Sql);
				
				
				$Sql = "select R.LANCA_NUMRAR "
					  "from item_nota_fiscal     itnf ".
					       ",nota_fiscal          nofi ".
					       ",pessoa               peem ".
					       ",pessoa               pede ".
					       ",item_material        itma ".
					       ",RAR_LANCAMENTO L ".
					       ",RAR_ITEM I ".
					  "where nofi.pessoa_emitente = itnf.pessoa_emitente ".
					         " and nofi.serie_nf        = itnf.serie_nf ".
					         " and nofi.num_nf          = itnf.num_nf ".
					         " and nofi.pessoa_emitente = peem.pessoa ".
					         " and itnf.cd_item_material = itma.cd_item_material ".
					         " and nofi.pessoa_destinatario = L.lanca_pessoa ".
					         " and nofi.pessoa_destinatario = pede.pessoa ".
					         " AND L.lanca_numrar = I.item_numrar ".
					         " and nofi.num_nf          = I.item_nf ".
					         " and nofi.pessoa_emitente = I.item_pessoa_emitente ".
					         " and nofi.serie_nf        in ('U','UN','UNI','1') ".
					         " and itnf.cd_item_material = I.ITEM_REFERENCIA ".
					         " AND L.LANCA_NUMRAR IN(" .$Ids. ") ".
							 " AND i.ITEM_REFERENCIA  = '" .$Rs["PRODUTO"]. "' ".
							 " AND nofi.pessoa_destinatario  = " .$Rs["PESSOA_DESTINATARIO"]. "  ".
							" AND LANCA_CATEGORIA IN (".$_GET['Categoria'].") ";
 
 			$Sql.= " union ";
			
			$Sql.= "select L.LANCA_NUMRAR ".
					  "from item_nota_fiscal     itnf ".
					       ",nota_fiscal          nofi ".
					       ",pessoa               peem ".
					       ",pessoa               pede ".
					       ",item_material        itma ".
					       ",RAR_LANCAMENTO L ".
					       ",RAR_ITEM I ".
						   ",RAR_CLIENTE_COLETA CC ".
					  "where nofi.pessoa_emitente = itnf.pessoa_emitente ".
					         " and nofi.serie_nf        = itnf.serie_nf ".
					         " and nofi.num_nf          = itnf.num_nf ".
					         " and nofi.pessoa_emitente = peem.pessoa ".
					         " and itnf.cd_item_material = itma.cd_item_material ".
					         " and nofi.pessoa_destinatario = cc.clien_col_lojaant".
						     " and cc.clien_col_pessoa = L.lanca_pessoa ".
					         " and nofi.pessoa_destinatario = pede.pessoa ".
					         " AND L.lanca_numrar = I.item_numrar ".
					         " and nofi.num_nf          = I.item_nf ".
					         " and nofi.pessoa_emitente = I.item_pessoa_emitente ".
					         " and nofi.serie_nf        in ('U','UN','UNI','1') ".
					         " and itnf.cd_item_material = I.ITEM_REFERENCIA ".
					         " AND L.LANCA_NUMRAR IN(" .$Ids. ") ".
							 " AND i.ITEM_REFERENCIA  = '" .$Rs["PRODUTO"]. "' ".
							 " AND nofi.pessoa_destinatario  = " .$Rs["PESSOA_DESTINATARIO"]. "  ".
							 " AND LANCA_CATEGORIA IN (".$_GET['Categoria'].") ".
							 
				$QueryUpdates = mysql_query($Sql);
				while ($RsUpdates = mysql_fetch_assoc($QueryUpdates)) {
					mysql_query("UPDATE rar_lancamento SET LANCA_PRENFI_IDO = " .$IdoItem. " WHERE LANCA_NUMRAR = " .$RsUpdates['LANCA_NUMRAR']);
				}
				//if (!$rollBack) 
				//		$rollBack = (ociexecute($StmtTemp,OCI_DEFAULT)) ? false : true;
						
				$Sql = "UPDATE RAR_AVALIACAO SET AVALI_AUTOR_NUMAUT = " .$IdA. " WHERE AVALI_NUMRAR = '" .$Rs["LANCA_NUMRAR"]. "'";
				$StmtTemp = mysql_query($Sql);
				//if (!$rollBack) 
				//		$rollBack = (ociexecute($StmtTemp,OCI_DEFAULT)) ? false : true;
				$LOOP++;
			}
		}else{
			$VarMenos14.= ((strlen($VarMenos14) > 0) ? "," : "") .urlencode($Rs["PESSOA"]);
		}
	}
	if (trim($VarMenos14)) { ?>
		<script language="javascript" type="text/javascript">
		<!--
			if (confirm("Gerar autorização de coleta para clientes com menos de 20 pares reclamados ?")) {
				document.form.Ids.value = "<?=$Ids?>";
				document.form.action = "pesq_autorizacao_confirma.php?PESSSOAN=<?=$VarMenos14?>&PESSOA=<?=urlencode($Pessoas)?>";
				document.form.submit();
				//document.location.href = "pesq_autorizacao_confirma.php?PESSSOAN=<?=$VarMenos14?>&IDS=<?=urlencode($Ids)?>&PESSOA=<?=urlencode($Pessoas)?>";
			}else{
				document.location.href = "pesq_autorizacao_coleta.php";
			}
		//-->
		</script>
<?	}else{
		header("Location: pesq_autorizacao_coleta.php");
	}
?>
