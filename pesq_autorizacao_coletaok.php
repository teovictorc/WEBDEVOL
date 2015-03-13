<? 
	ob_start();
	set_time_limit(0);  //indeterminado o tempo do script da página
	
	include("inc/conn.inc.php"); ?>
	<form action="pesq_autorizacao_confirma.php" method="post" name="form">
	  <input type="hidden" name="Ids" id="Ids">
	</form>

	<?
	verifyAcess("ARZ_AUTORIZACAOCOLET","S");
	$menos14 = $_GET['Menos14'];
	$Ids = str_replace("\'","'",$_POST['Ids']);
	if ($_SESSION['Menu'] == "3"){
		$Tipo = "M";
	}else{
		$Tipo = "F";
	}

	$Sql = "SELECT PESSOA, SUM(ITEM_QTDE) QTDE ".
			" FROM rar_lancamento, pessoa, rar_item ".
			" WHERE LANCA_NUMRAR IN(" .$Ids. ") AND LANCA_NUMRAR = ITEM_NUMRAR".
			"        AND LANCA_PESSOA = PESSOA GROUP BY PESSOA";
	$StmtI = mysql_query($Sql);
	$VarMenos14 = "";
	$Pessoas = "";
	$NumRows = 0;

	$Sql = "SELECT * FROM rar_config ";
	$StmtC = mysql_query($Sql);

	if ($RsC = mysql_fetch_assoc($StmtC)) {
		$CONFIG_MM_LIMITECOLETA = $RsC["CONFIG_MM_LIMITECOLETA"];
		$CONFIG_FR_LIMITECOLETA = $RsC["CONFIG_FR_LIMITECOLETA"];
	}



	while($Rs = mysql_fetch_assoc($StmtI)) {
		$Rar = arrumaPessoa($Rs["PESSOA"]);
		if ($_SESSION["Menu"] == "3"){
			$Qtde = $CONFIG_MM_LIMITECOLETA;
		}else{
			$Qtde = $CONFIG_FR_LIMITECOLETA;
		}

		if ($Rs["QTDE"] >= $Qtde ) {
			$Pessoas = ((strlen($Pessoas) == 0) ? "" : ",") .$Rs["PESSOA"];
			$Sql = "select CODIGO_EMITENTE, NOME_EMITENTE, LOGRADOURO, CGCCPF, INSC_ESTADUAL ".
					  ",BAIRRO ".
					  ",CEP ".
					  ",MUNICIPIO ".
					  ",UF ".
					  ",CATEGORIA ".
					  ",UFD ".
					  ",SIMPLES ".
					  ",SUFRAMA ".
					  ",PRODUTO ".
					  //",DESCRICAO_PRODUTO ".
					  ",VL_UNITARIO ".
					  ",UN_MEDIDA ".
					  ",CLASS_FISCAL ".
					  ",ALIQ_ICMS ".
					  ",ALIQ_IPI ".
					  ",NUM_NF ".
					  ",SERIE_NF ".
					  ",DT_EMISSAO_NF ".
					  ",Sum(ITEM_QTDE) ITEM_QTDE ".
					  ",PESSOA_EMITENTE ".
					  ",PESSOA_DESTINATARIO ".
					  " FROM ( ".
								"select distinct ".
								      " L.lanca_numrar ".
								      ",nofi.pessoa_emitente         CODIGO_EMITENTE".
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
									  //",pede.optt_simples_estd          SIMPLES ".
									  ",null          					SIMPLES ".
									  //",pede.SUFR_BENF_ICMS             SUFRAMA ".
									  ",null             				SUFRAMA ".
									  ",itnf.cd_item_material           PRODUTO ".
									  //",itma.ds_resumida_item           DESCRICAO_PRODUTO ".
									  ",itnf.vl_unitario_item           VL_UNITARIO ".
									  ",itnf.unidade_medida             UN_MEDIDA ".
									  ",itnf.classificacao_fiscal       CLASS_FISCAL ".
									  ",itnf.aliq_icms                  ALIQ_ICMS ".
									  ",itnf.aliq_ipi                   ALIQ_IPI ".
									  ",nofi.num_nf                     NUM_NF ".
									  ",nofi.serie_nf                   SERIE_NF ".
									  ",nofi.dt_emis_nf                 DT_EMISSAO_NF ".
									  ",I.ITEM_QTDE                   ITEM_QTDE ".
									  ",nofi.PESSOA_EMITENTE ".
									  ",nofi.PESSOA_DESTINATARIO ".
									  "from item_nota_fiscal     itnf ".
										   ",nota_fiscal          nofi ".
										   ",pessoa               peem ".
										   ",pessoa               pede ".
										   ",item_material        itma ".
										   ",rar_lancamento L ".
										   ",rar_item I ".
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
											 " AND L.LANCA_NUMRAR IN(" .$Ids. ") ";
											 if ($Tipo == "M"){
												$Sql.= " AND L.LANCA_NUMRAR LIKE 'M" .substr($Rar,0,5). "%' ";
											}else{	
												$Sql.= " AND L.LANCA_NUMRAR LIKE '" .substr($Rar,0,5). "%' ";
											}
											 $Sql.= " AND LANCA_CATEGORIA IN (".$_POST['Categoria'].") ";
							$Sql.= " union ";
							$Sql.= "select distinct ".
							          " L.lanca_numrar ".
									  ",nofi.pessoa_emitente            CODIGO_EMITENTE".
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
									  //",pede.optt_simples_estd          SIMPLES ".
									  ",null          					SIMPLES ".
									  //",pede.SUFR_BENF_ICMS             SUFRAMA ".
									  ",null             				SUFRAMA ".
									  ",itnf.cd_item_material           PRODUTO ".
									  //",itma.ds_resumida_item           DESCRICAO_PRODUTO ".
									  ",itnf.vl_unitario_item           VL_UNITARIO ".
									  ",itnf.unidade_medida             UN_MEDIDA ".
									  ",itnf.classificacao_fiscal       CLASS_FISCAL ".
									  ",itnf.aliq_icms                  ALIQ_ICMS ".
									  ",itnf.aliq_ipi                   ALIQ_IPI ".
									  ",nofi.num_nf                     NUM_NF ".
									  ",nofi.serie_nf                   SERIE_NF ".
									  ",nofi.dt_emis_nf                 DT_EMISSAO_NF ".
									  ",I.ITEM_QTDE                     ITEM_QTDE ".
									  ",nofi.PESSOA_EMITENTE ".
									  ",CC.CLIEN_COL_PESSOA PESSOA_DESTINATARIO".
									  " from item_nota_fiscal     itnf ".
										   ",nota_fiscal          nofi ".
										   ",pessoa               peem ".
										   ",pessoa               pede ".
										   ",item_material        itma ".
										   ",rar_lancamento L ".
										   ",rar_item I ".
										   ",rar_cliente_coleta CC ".
									  "where nofi.pessoa_emitente = itnf.pessoa_emitente ".
											 " and nofi.serie_nf        = itnf.serie_nf ".
											 " and nofi.num_nf          = itnf.num_nf ".
											 " and nofi.pessoa_emitente = peem.pessoa ".
											 " and itnf.cd_item_material = itma.cd_item_material ".
											 " and (".
											 "     (nofi.pessoa_destinatario = CC.clien_col_lojaant".
											 "     and CC.clien_col_pessoa = L.lanca_pessoa) ".
											 " or (nofi.pessoa_destinatario = CC.clien_col_lojaant_1".
											 "    and CC.clien_col_pessoa = L.lanca_pessoa) ".
											 " or (nofi.pessoa_destinatario = CC.clien_col_lojaant_2".
											 "    and CC.clien_col_pessoa = L.lanca_pessoa) ".
											 " or (nofi.pessoa_destinatario = CC.clien_col_lojaant_3".
											 "    and CC.clien_col_pessoa = L.lanca_pessoa) ".
											 " or (nofi.pessoa_destinatario = CC.clien_col_lojaant_4".
											 "    and CC.clien_col_pessoa = L.lanca_pessoa) ".
											 "     ) ".
											 " and nofi.pessoa_destinatario = pede.pessoa ".
											 " AND L.lanca_numrar = I.item_numrar ".
											 " and nofi.num_nf          = I.item_nf ".
											 " and nofi.pessoa_emitente = I.item_pessoa_emitente ".
											 " and nofi.serie_nf        in ('U','UN','UNI','1') ".
											 " and itnf.cd_item_material = I.ITEM_REFERENCIA ".
											 " AND L.LANCA_NUMRAR IN(" .$Ids. ") ";
											if ($Tipo == "M"){
												$Sql.= " AND L.LANCA_NUMRAR LIKE 'M" .substr($Rar,0,5). "%' ";
											}else{	
												$Sql.= " AND L.LANCA_NUMRAR LIKE '" .substr($Rar,0,5). "%' ";
											}
											 $Sql.= " AND LANCA_CATEGORIA IN (".$_POST['Categoria'].") ";
									  $Sql.= " ) as dados ".
			          " GROUP BY CODIGO_EMITENTE, NOME_EMITENTE, LOGRADOURO, CGCCPF, INSC_ESTADUAL ".
					  ",BAIRRO ".
					  ",CEP ".
					  ",MUNICIPIO ".
					  ",UF ".
					  ",CATEGORIA ".
					  ",UFD ".
					  ",SIMPLES ".
					  ",SUFRAMA ".
					  ",PRODUTO ".
					  //",DESCRICAO_PRODUTO ".
					  ",VL_UNITARIO ".
					  ",UN_MEDIDA ".
					  ",CLASS_FISCAL ".
					  ",ALIQ_ICMS ".
					  ",ALIQ_IPI ".
					  ",NUM_NF ".
					  ",SERIE_NF ".
					  ",DT_EMISSAO_NF ".
					  ",PESSOA_EMITENTE ".
					  ",PESSOA_DESTINATARIO ";
			$Sql.= " ORDER BY CODIGO_EMITENTE ";
			//die($Sql);
			$Stmt = mysql_query($Sql);
			$NF = "";
			$rollBack = false;
			$IdA = newIDO();
			$Sql = "INSERT INTO rar_autorizacao VALUES (" .$IdA. ",NOW())";
			$StmtTemp = mysql_query($Sql);
			$LOOP = 0;
			$NumRows = 0;
			while($Rs = mysql_fetch_assoc($Stmt)) {
				if ($NF != $Rs["CODIGO_EMITENTE"] || $LOOP >= $NumRows) {
					$StmtRow = mysql_query("SELECT CLIEN_COL_PESSOA,CLIEN_QTDELINHANF FROM rar_cliente_coleta WHERE CLIEN_COL_PESSOA = '" .$Rs["PESSOA_DESTINATARIO"]. "'");
					if ($RsR = mysql_fetch_assoc($StmtRow))
						$NumRows = (trim($RsR["CLIEN_QTDELINHANF"])) ? $RsR["CLIEN_QTDELINHANF"] : 9999;
					else
						$NumRows = 9999;
						$LOOP = 0;
	     				$NF = $Rs["CODIGO_EMITENTE"];
						if ($NF != 18800 && $NF != 19000)  //emitente = fabrica
							{
							if ($Rs["CATEGORIA"] == 8 || $Rs["CATEGORIA"] == 9) //cliente = franquia
							{
								if ($Rs["UFD"] == $Rs["UF"])  //UF cliente = uf Fabrica
									{
									$Cfop = "5.202";
									$Operacao = "12";
									$Emitente = $NF;
									}
								else   //uf cliente <> uf fábrica
									{
									$Cfop = "6.202";
									$Operacao = "12";
									$Emitente = $NF;
									}
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
					$AliqIcms = 0;
					if ($Rs["SUFRAMA"] != "S") {
						$AliqIcms = $Rs["ALIQ_ICMS"];
					}

					$AliqIpi = $Rs["ALIQ_IPI"];
					if (($Rs["CATEGORIA"] == 8 || $Rs["CATEGORIA"] == 9) && $Rs["SIMPLES"] == "S" ){
						$AliqIcms = 0;
					}

					$Sql = "INSERT INTO rar_prenf (PRENF_DATA_ENVIO, PRENF_NUMPRENF,PRENF_PESSOA_EMITENTE,PRENF_PESSOA_EMITENTE_ORIGINAL,PRENF_PESSOA_DESTINATARIO,".
							"PRENF_AUTOR_NUMAUT,PRENF_OPER_IDO,PRENF_CFOP,PRENF_ICMS,PRENF_IPI, PRENF_CATEGORIA, PRENF_TIPO".
							") VALUES (now(), " .$IdPre. "," .$Emitente. ", ". $Emitente. ", ".
							$Rs["PESSOA_DESTINATARIO"]. ",'" .$IdA. "','" .$Operacao. "','" .$Cfop. "', '".
							$AliqIcms. "','".$AliqIpi."','" .(($_POST['Categoria'] == "1") ? "1" : "2"). "','" .$Tipo. "')";
					$StmtTemp = mysql_query($Sql);
					echo ("Pré-Nota ".$IdPre." gerada com sucesso !<br>");
					ob_flush();
					flush();
				}

				$IdoItem = newIDO();
				$Sql =	"INSERT INTO rar_prenf_item  (PRENFI_IDO, PRENFI_NUMPRENF, PRENFI_REFERENCIA, ";
				$Sql.= "                              PRENFI_UNIDADE, PRENFI_QUANTIDADE, PRENFI_VALORUNITARIO, ";
				$Sql.= "                              PRENFI_ClASSIFICACAOFISCAL ";
				$Sql.= " ) VALUES (";
				$Sql.= $IdoItem. ",'";
				$Sql.= $IdPre. "', '";
				$Sql.= $Rs["PRODUTO"]. "', '";
				$Sql.= $Rs["UN_MEDIDA"]. "', '";
				$Sql.= $Rs["ITEM_QTDE"]. "', '";
				$Sql.= $Rs["VL_UNITARIO"]. "', '";
				$Sql.= $Rs["CLASS_FISCAL"]. "')";
                $StmtTemp = mysql_query($Sql);

				$Sql = "select L.LANCA_NUMRAR ".
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
							" AND LANCA_CATEGORIA IN (".$_POST['Categoria'].") ";
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
					         " and nofi.pessoa_destinatario = CC.clien_col_lojaant".
						     " and CC.clien_col_pessoa = L.lanca_pessoa ".
					         " and nofi.pessoa_destinatario = pede.pessoa ".
					         " AND L.lanca_numrar = I.item_numrar ".
					         " and nofi.num_nf          = I.item_nf ".
					         " and nofi.pessoa_emitente = I.item_pessoa_emitente ".
					         " and nofi.serie_nf        in ('U','UN','UNI','1') ".
					         " and itnf.cd_item_material = I.ITEM_REFERENCIA ".
					         " AND L.LANCA_NUMRAR IN(" .$Ids. ") ".
							 " AND i.ITEM_REFERENCIA  = '" .$Rs["PRODUTO"]. "' ".
							 " AND nofi.pessoa_destinatario  = " .$Rs["PESSOA_DESTINATARIO"]. "  ".
							 " AND LANCA_CATEGORIA IN (".$_POST['Categoria'].") ";
							 
				$Sql = " select L.LANCA_NUMRAR ";
			    $Sql.= " from rar_lancamento L, rar_item I ";
				$Sql.= " where lanca_numrar = item_numrar ";
				$Sql.= "       AND LANCA_NUMRAR IN(" .$Ids. ") ";
				$Sql.= "       AND ITEM_REFERENCIA  = '" .$Rs["PRODUTO"]. "' ";
				$Sql.= "       AND lanca_pessoa  = " .$Rs["PESSOA_DESTINATARIO"];
				$Sql.= "       AND item_pessoa_emitente  = " .$Rs["CODIGO_EMITENTE"];
				$Sql.= "       AND item_nf  = " .$Rs["NUM_NF"];
				$Sql.= "       AND LANCA_CATEGORIA IN (".$_POST['Categoria'].") ";
				$QueryUpdates = mysql_query($Sql);
				while ($RsUpdates = mysql_fetch_assoc($QueryUpdates)) {
					mysql_query("UPDATE rar_lancamento SET LANCA_PRENFI_IDO = " .$IdoItem. " WHERE LANCA_NUMRAR = '" .$RsUpdates['LANCA_NUMRAR'] . "'");
					mysql_query("UPDATE rar_avaliacao SET AVALI_AUTOR_NUMAUT = " .$IdA. " WHERE AVALI_NUMRAR = '" .$RsUpdates["LANCA_NUMRAR"]. "'");
				}
				flush();  //limpa memória do buffer e descarrega na tela
				$LOOP++;
			}
		}else{
			$VarMenos14.= ((strlen($VarMenos14) > 0) ? "," : "") .urlencode($Rs["PESSOA"]);
		}
	}

	if (trim($VarMenos14)) { ?>
		<script language="javascript" type="text/javascript">
			if (confirm("Gerar autorização de coleta para clientes com menos de 20 pares reclamados ?")) {
				document.form.Ids.value = "<?=$Ids?>";
				document.form.action = "pesq_autorizacao_confirma.php?PESSSOAN=<?=$VarMenos14?>&PESSOA=<?=urlencode($Pessoas)?>&Categoria=<?=$_POST['Categoria']?>";
				document.form.submit();
			}else{
				document.location.href = "pesq_autorizacao_coleta.php?Categoria=<?=$_POST['Categoria']?>" ;
			}
		</script>
<?	}else{ ?>
		<? header("Location: pesq_autorizacao_coleta.php?Erro=0&Categoria=" .$_POST['Categoria']);
	}
?>

