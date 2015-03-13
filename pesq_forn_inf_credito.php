<? include("inc/headerI.inc.php"); 

	verifyAcess("FORN_CREDITOPEND","S");

	if (trim($_POST['NF'])) {

		$NFL = $_POST['NFL'] . "|" .$_POST['NF']. "|";

		$ID = $_POST['ID'];

	}else

		$ID = $_GET['Id'];



	$Exibe = $_GET['Exibe'];

	if (trim($ID)) {

			$Sql = "SELECT ".

			               " concat(substr(P.cgccpf,1,2),'.',substr(P.cgccpf,3,3),'.',substr(P.cgccpf,6,3),'/',substr(P.cgccpf,9,4), '-',substr(P.cgccpf,13,2)) as CNPJ, ".

			               " concat(substr(PD.cgccpf,1,2),'.',substr(PD.cgccpf,3,3),'.',substr(PD.cgccpf,6,3),'/',substr(PD.cgccpf,9,4), '-',substr(PD.cgccpf,13,2)) as CNPJC, ".

						   " ROUND(PRENF_OPER_IDO,0) AS PRENF_OPER_IDO, PRENF_PESSOA_DESTINATARIO, ".

						   " PRENF_OBSTRANSPORTADORA,".

						   " PRENF_NUMPRENF,".

						   " PRENF_NUMNFDEVOLUCAO,".

						   " PRENF_SERIE,".

						   " PRENF_CFOP,".

						   " CONCAT(ROUND(PRENF_ICMS * 100,0),'%') AS ICMS,".

						   " CONCAT(ROUND(PRENF_IPI * 100,0),'%') AS IPI,".

						   " ROUND(PRENF_QTDEVOLUME,0) PRENF_QTDEVOLUME ,".

			               " date_format(PRENF_DATA_INFNFDEVOLUCACAO,'%d/%m/%Y') DATANF, ".

						   " PRENF_OBSTRANSPORTADORA, ".

					       " PD.NOME NOMECLIENTE, ".

						   " PD.PESSOA CLIENTE, ".

						   " PRENF_CFOP, ".

						   " P.NOME, ".

						   " P.LOGRADOURO RUA,".

						   " P.BAIRRO, ".

						   " P.CEP, ".

						   " null SUFRAMA, ". 

					       "(SELECT round(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALORTOTAL FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALORTOTAL, ".

					       "(SELECT round((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_ICMS),2) VALORICMS FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALORICMS, ".

						   "(SELECT round((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI),2) VALORIPI FROM rar_prenf_item WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALORIPI, ".

					       " P.NM_MUNICIPIO CIDADE, ".

						   " P.SG_UF UF ".

					  " FROM rar_prenf, pessoa P, pessoa PD ".

					  "WHERE PRENF_PESSOA_EMITENTE = P.PESSOA ".

					         " AND PD.PESSOA = PRENF_PESSOA_DESTINATARIO ".

							 " AND PRENF_PESSOA_EMITENTE NOT IN (18800, 19000)".

							 " AND PRENF_NUMPRENF = '" .$ID. "'";

		//die($Sql);

		$Stmt = mysql_query($Sql);

		$Rs = mysql_fetch_assoc($Stmt);

		if (substr($Rs["PRENF_CFOP"],0,1) == "5") {

			$Cfop = "1".substr($Rs["PRENF_CFOP"],1,4);

		}

		

		if (substr($Rs["PRENF_CFOP"],0,1) == "6") {

			$Cfop = "2".substr($Rs["PRENF_CFOP"],1,4);

		}

	}

?><style type="text/css">

<!--

.style1 {font-weight: bold}

-->

</style>

<link href="wfa.css" rel="stylesheet" type="text/css">

<form name="form" method="POST" action="#" enctype="multipart/form-data">

<input type="hidden" name="ID" value="<?=$ID?>">



<table width="100%"  border="0" align="center">

     <tr>

       <td width="49%" class="tab_titulo" colspan="9"><span class=""><h4>Cr&eacute;ditos pendentes</h4></span></td>

     </tr>

  </table></td>

   <td></td>

  </tr>

  <tr>

   <td >&nbsp;</td>

   <td colspan="9">

     <table width="100%"  border="0" class="tab_inclusao">

       <tr>

         <td width="20%" class="style2"><strong>C&oacute;digo</strong></td>

         <td><input name="PESSOA" type="text" class="form" id="PESSOA" value="<?=$Rs["CLIENTE"]?>" size="6" maxlength="6" readonly>

          <input name="PESSOA" type="hidden" id="PESSOA" value="<?=$Rs["CLIENTE"]?>"></td>

         <td class="style2"><div align="right"><strong>N&ordm; Pr&eacute;-Nota</strong></div></td>

         <td><input name="textfield3" type="text" class="form" value="<?=$Rs["PRENF_NUMPRENF"]?>" size="10" maxlength="10" readonly></td>

         <td>&nbsp;</td>
       </tr>

       <tr>

         <td class="style2"><strong>Nome Cliente</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong><strong>&nbsp;</strong></td>
         <td class="style2"><input name="textfield2" type="text" class="form" value="<?=$Rs["NOMECLIENTE"]?>" size="49" maxlength="50" readonly="readonly" /></td>
         <td class="style2"><div align="right"><strong>CNPJ</strong></div></td>
         <td class="style2"><strong>
           <input name="ADFDF3" type="text" class="form" id="ADFDF3" value="<?=$Rs["CNPJC"]?>" size="20" maxlength="18" />
         </strong></td>
         <td class="style2">&nbsp;</td>
       </tr>

       <tr class="">

         <td height="25" colspan="5" class="tab_titulo"><br /><h4>Dados da NF de devolu&ccedil;&atilde;o</h4></td>
        </tr>

       <tr>

         <td class="style2"><strong>N&ordm; NF devolu&ccedil;&atilde;o</strong></td>

         <td><input name="PRENF_NUMNFDEVOLUCAO" type="text" class="form" id="PRENF_NUMNFDEVOLUCAO" value="<?=$Rs["PRENF_NUMNFDEVOLUCAO"]?>" readonly size="20" maxlength="5"></td>

         <td class="style2"><div align="right"><strong>N&ordm; s&eacute;rie</strong></div></td>

         <td width="43%" colspan="2"><input name="PRENF_SERIE" type="text" class="form" id="PRENF_SERIE" value="<?=((trim($Rs["PRENF_SERIE"])) ? $Rs["PRENF_SERIE"] : "U")?>" size="11" maxlength="3" readonly></td>
       </tr>

       <tr>

         <td class="style2"><strong>Data NF devolu&ccedil;&atilde;o</strong></td>

         <td colspan="4"><input name="PRENF_DATA_INFNFDEVOLUCAO" type="text" class="form" id="PRENF_DATA_INFNFDEVOLUCAO" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" readonly value="<?=$Rs["DATANF"]?>" size="11" maxlength="11"></td>
       </tr>

       <tr>

         <td class="style2"><strong>Destinat&aacute;rio</strong></td>

         <td colspan="4"><input name="FORNECEDOR" type="text" class="form" id="FORNECEDOR" value="<?=$Rs["NOME"]?>" size="80" maxlength="80" readonly></td>
       </tr>

       <tr>

         <td class="style2"><strong>Endere&ccedil;o</strong></td>

         <td><input name="textfield23" type="text" class="form" value="<?=$Rs["RUA"]?>" size="45" readonly></td>

         <td class="style2"><div align="right"><strong>Bairro</strong></div></td>

         <td colspan="2"><input name="textfield232" type="text" class="form" value="<?=$Rs["BAIRRO"]?>" size="40" readonly maxlength="40"></td>
       </tr>

       <tr>

         <td class="style2"><strong>Cidade</strong></td>

         <td width="22%"><input name="textfield2322" type="text" class="form" value="<?=$Rs["CIDADE"]?>" size="20" readonly maxlength="20"></td>

         <td width="19%" class="style2"><div align="right"><strong>UF</strong></div></td>

         <td colspan="2"><input name="textfield23232" type="text" class="form" value="<?=$Rs["UF"]?>" size="4" readonly maxlength="2">         </td>
       </tr>

       <tr>

         <td class="style2"><strong>CNPJ</strong></td>

         <td><input name="ADFDF" type="text" class="form" id="ADFDF" value="<?=$Rs["CNPJ"]?>" size="20" maxlength="18"></td>

         <td class="style2">&nbsp;</td>

         <td colspan="2" class="style1">&nbsp;</td>
       </tr>

       <tr>

         <td class="style2"><strong>CFOP Entrada</strong></td>

         <td class="style1"><input name="textfield2323222" type="text" class="form" value="<?=$Cfop?>" readonly size="20" maxlength="20">         </td>

         <td class="style2"><div align="right"><strong>Qtde volumes</strong></div></td>

         <td colspan="2" class="style1"><input name="PRENF_QTDEVOLUME" type="text" class="form" id="PRENF_QTDEVOLUME" readonly onKeyPress="return JSUtilApenasNumero(event);" value="<?=$Rs["PRENF_QTDEVOLUME"]?>" size="3" maxlength="3">         </td>
       </tr>

       <tr>

         <td valign="top" class="style2"><strong>Opera&ccedil;&atilde;o</strong></td>

         <td colspan="3" class="style1">

		 		 <? 

				 $Sql = "SELECT CD_OPER,DS_OPER FROM operacao WHERE CD_OPER = ".$Rs["PRENF_OPER_IDO"];

				 $StmtC = mysql_query($Sql);

	  		     $RsC = mysql_fetch_assoc($StmtC);

			   {$Operacao = $Rs["PRENF_OPER_IDO"].' - '.$RsC["DS_OPER"];}?>

          <input name="textfield23232222" type="text" class="form" value="<?=$Operacao?>" readonly size="60" maxlength="60">          <div align="right" class="style2"></div></td><td class="style1">&nbsp;</td>
       </tr>

       <tr>

         <td valign="top" class="style2"><strong>Observa&ccedil;&otilde;es para transportadora</strong></td>

         <td colspan="4" class="style1"><textarea name="PRENF_OBSTRANSPORTADORA" cols="100%" rows="5" class="txt" readonly id="PRENF_OBSTRANSPORTADORA"><?=$Rs["PRENF_OBSTRANSPORTADORA"]?></textarea></td>
        </tr>

       <tr>

         <td colspan="5">

           <div align="center"></div></td>
       </tr>

       <tr class="">

         <td height="30" colspan="5" class="tab_titulo"><div align="left"><h4>Listagens dos produtos da pr&eacute;-nota</h4></div></td>
       </tr>

       <tr>

         <td colspan="5"><table width="100%"  border="0" align="center">

           <tr class="tab_usuarios" >

             <td width="17%" ><div align="center">Refer&ecirc;ncia</div></td>

             <td width="8%" ><div align="center">Un. Med.</div></td>

             <td width="5%" ><div align="center">Qtde</div></td>

             <td width="12%" ><div align="right">Valor Unit. Prod.</div></td>

             <td width="12%" ><div align="right">Valor Total</div></td>

             <td width="12%" ><div align="right">Valor IPI </div></td>

             <td width="12%" ><div align="right">Valor Royalties</div></td>

             <td width="16%" ><div align="right">Valor geral <br>

               (total + royalties + IPI)</div></td>
             </tr>

<? 

	$Sql = "SELECT PRENFI_IDO,".

 	               " PRENFI_CLASSIFICACAOFISCAL,".

		           " concat(substring(PRENFI_REFERENCIA,1,4),'-',substring(PRENFI_REFERENCIA,5,4),'-',substring(PRENFI_REFERENCIA,9,4),'-',substring(PRENFI_REFERENCIA,13,4)) PRENFI_REFERENCIA, ".

		           " PRENFI_UNIDADE,".

		           " round(PRENFI_QUANTIDADE,0) as PRENFI_QUANTIDADE, ".

				   " round(PRENFI_VALORUNITARIO,2) VALOR_UNITARIO, ".

				   " round(PRENFI_VALORUNITARIO,2) VALOR_UNITARIO, ".

		           " round((PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR, ".

				   " ROUND((PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI,2) VALORIPI,".

				   " round((PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) + ROUND((PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI,2) VALOR_IPI ".

		   " FROM rar_prenf_item, rar_prenf".

		   " WHERE PRENFI_NUMPRENF = '" .$ID. "'".

		   "       AND PRENF_NUMPRENF = PRENFI_NUMPRENF ";

		   //die($Sql);

	$Stmt2 = mysql_query($Sql);

	$NFF = "";

	$ValorTotalRoyal = 0;
	$ValorTotalGeral = 0;
	$ValorTotalGeral2 = 0;
	$ValorTotalIPI = 0;

	$Qtde = 0;
	$ValorTotal = 0;
	while($RsI = mysql_fetch_assoc($Stmt2)) { 

		$Qtde = $Qtde + $RsI["PRENFI_QUANTIDADE"];

		$ValorTotal = $ValorTotal + $RsI["VALOR"];

		$var = strpos($NFL,"|" .str_replace("-","",$RsI["LANCA_NUMRAR"]). "|");

		if ($var === false && $Exibe == "N") { 

			$NFF.= "|" .str_replace("-","",$RsI["LANCA_NUMRAR"]). "|";

		}else{  

		 

		$Sql = " select item_valor_royaltie valor_royal ";

		$Sql.= " from rar_lancamento, rar_item";

		$Sql.= " where lanca_numrar = item_numrar";

		$Sql.= "       and lanca_prenfi_ido = '".$RsI["PRENFI_IDO"]."'";

		$Stmt3 = mysql_query($Sql);

		$ValorRoyal = 0;

		if($RsV = mysql_fetch_assoc($Stmt3)){
			$ValorRoyal = $RsV["valor_royal"] * $RsI["PRENFI_QUANTIDADE"];
		}

		$ValorTotalRoyal = $ValorTotalRoyal + $ValorRoyal;
		$Valor = $ValorRoyal + $RsI["VALOR_IPI"];
		$ValorTotalIPI = $ValorTotalIPI + $RsI["VALORIPI"];
		$ValorTotalGeral = $ValorTotalGeral + $Valor;
		$ValorTotalGeral2 = $ValorTotalGeral2 + $RsI["VALOR"] + $RsI["VALORIPI"];

		?>

           <tr bordercolor="#00CCFF" class="tab_usuarios_info">
             <td> <div align="center"><?=$RsI["PRENFI_REFERENCIA"]?></div></td>
             <td><div align="center"><?=$RsI["PRENFI_UNIDADE"]?></div></td>
             <td><div align="center"><?=$RsI["PRENFI_QUANTIDADE"]?></div></td>
             <td><div align="right"><?=formatCurrency($RsI["VALOR_UNITARIO"])?></div></td>
             <td><div align="right"><?=formatCurrency($RsI["VALOR"])?></div></td>
             <td><div align="right"><?=formatCurrency($RsI["VALORIPI"])?></div></td>
             <td align="right"><?=formatCurrency($ValorRoyal)?></td>
             <td><div align="right"><?=formatCurrency($Valor)?></div></td>
            </tr>

           

<? 	   }

	

	} ?>

		<tr bordercolor="#00CCFF" class="tab_usuarios_info">
			<td colspan="2"><div align="right" class="style1">Totais:</div></td>
			<td align="center"><strong><?=$Qtde?></strong></td>
			<td align="right">&nbsp;</td>
			<td align="right"><strong><?=formatCurrency($ValorTotal)?></strong></td>
			<td align="right"><strong><?=formatCurrency($ValorTotalIPI)?></strong></td>
			<td align="right"><strong><?=formatCurrency($ValorTotalRoyal)?></strong></td>
			<td align="right"><strong><?=formatCurrency($ValorTotalGeral)?></strong></td>
		</tr>

         </table></td>
       </tr>

       <tr>

         <td colspan="5"><table width="100%"  border="0" align="center">

		   <?

		   if ($Rs["SUFRAMA"] == "S"){
				$Sql = "SELECT distinct aliq_icms";
				$Sql.= " FROM rar_prenf_item, item_nota_fiscal, rar_item";
				$Sql.= " WHERE lanca_numrar = item_numrar ";
				$Sql.= " AND num_nf = item_nf ";
				$Sql.= " AND serie_nf = item_serie ";
				$Sql.= " AND cd_item_material = item_referencia ";
				$Sql.= " AND prenfi_numprenf = '" .$_GET['Id']. "'";
				$Stmt = mysql_query($Sql);
				$RsIcms = mysql_fetch_assoc($Stmt);
				$ValorTotal = round($Rs["VALORTOTAL"] * (1-$RsIcms["aliq_icms"]),2);
			}else{
				$ValorTotal = $Rs["VALORTOTAL"];
			}

		   ?>

           <tr class="">
             <td width="25%" >&nbsp;</td>
             <td width="25%" a href="cad_defeitos.htm">&nbsp;</td>
             <td width="25%" a href="cad_defeitos.htm">&nbsp;</td>
             <td width="25%" a href="cad_defeitos.htm">&nbsp;</td>
             <td width="25%" a href="cad_defeitos.htm">&nbsp;</td>
          </tr>

           <tr bgcolor="#FFFFFF">
             <td colspan="5" ><table width="100%" border="0" align="center">
               <tr>
                 <td><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                   <tr>
                     <td width="5%"></td>
                     <td width="94%" class=""><div align="center" class=""><h4>Dados referentes ao cr&eacute;dito do cliente</h4></div><t>
                     <td width="1%"></td>
                  </tr>
                   <tr>
                     <td rowspan="2">&nbsp;</td>
                     <td height="0"></td>
                     <td rowspan="2">&nbsp;</td>
                  </tr>

				   <?
				   	$Sql = "SELECT *";
					$Sql.= " FROM rar_cliente_coleta";
					$Sql.= " WHERE clien_col_pessoa = '" .$Rs["PRENF_PESSOA_DESTINATARIO"]. "'";
					$StmtBanco = mysql_query($Sql);
					$RsBanco = mysql_fetch_assoc($StmtBanco);
					$Banco = $RsBanco["CLIEN_COB_BANCO"];
					$Agencia = $RsBanco["CLIEN_COB_AGENCIA_CODIGO"];
					$Agencia_Nome = $RsBanco["CLIEN_COB_AGENCIA_NOME"];
				    $Conta = $RsBanco["CLIEN_COB_CONTA"];
					$Titular = $RsBanco["CLIEN_COB_TITULAR"];
					
					$Banco2 = $RsBanco["CLIEN_COB2_BANCO"];
					$Agencia2 = $RsBanco["CLIEN_COB2_AGENCIA_CODIGO"];
					$Agencia_Nome2 = $RsBanco["CLIEN_COB2_AGENCIA_NOME"];
				    $Conta2 = $RsBanco["CLIEN_COB2_CONTA"];
					$Titular2 = $RsBanco["CLIEN_COB2_TITULAR"];

				   ?>

                   <tr>
                     <td><table width="100%"  border="0" align="center" bgcolor="#FFFFFF" class="tab_inclusao">
                         <tr class="">
                           <td colspan="5" class="tab_titulo">Dados banc&aacute;rios para dep&oacute;sito</td>
                          </tr>
                         <tr>
                           <td width="17%" class="style2">Banco:</td>
                           <td width="15%">
                             <input name="BancoOrig" type="text" disabled class="form" id="BancoOrig" value="<?=$Banco?>" size="4" maxlength="3"></td>
                           <td width="20%" class="style2"><div align="right" class="">Ag&ecirc;ncia:</div></td>
                           <td colspan="2">
                             <input name="AgenciaOrig" type="text" disabled class="form" id="AgenciaOrig" value="<?=$Agencia?>" size="7" maxlength="5">
- 
<input name="Agencia_NomeOrig" type="text" disabled class="form" id="Agencia_NomeOrig" value="<?=$Agencia_Nome?>" size="30" maxlength="30"></td>
                         </tr>
                         <tr>
                           <td class="style2">N.&deg; da conta:</td>
                           <td >
                             <input name="ContaOrig" type="text" disabled class="form" id="ContaOrig" value="<?=$Conta?>" size="21" maxlength="20"></td>
                           <td><div align="right" class="style2">Titular da conta:</div></td>
                           <td colspan="2">
                             <input name="TitularOrig" type="text" disabled class="form" id="TitularOrig" value="<?=$Titular?>" size="50" maxlength="50"></td>
                         </tr>
                         <tr>
                           <td class="style2">&nbsp;</td>
                           <td>&nbsp;</td>
                           <td class="style1"><div align="right">Valor a creditar: </div></td>
                           <td width="15%" class="listagem_procedente" align="right">
                           <input name="ValorOrig" type="hidden" id="ValorOrig" value="<?=formatCurrency($ValorTotalGeral2)?>"><?=formatCurrency($ValorTotalGeral2)?></td>
                           <td width="33%">&nbsp;</td>
                         </tr>
                         <tr>
                           <td class="style2">&nbsp; </td>
                           <td colspan="4">&nbsp;</td>
                        </tr>
                         <tr class="">
                           <td colspan="5" class="tab_titulo">Dados banc&aacute;rios 2 para dep&oacute;sito</td>
                         </tr>
                         <tr>
                           <td class="style2">Banco:</td>
                           <td><input name="BancoOrig" type="text" disabled="disabled" class="form" id="BancoOrig" value="<?=$Banco?>" size="4" maxlength="3" /></td>
                           <td class="style2"><div align="right" class="">Ag&ecirc;ncia:</div></td>
                           <td colspan="2"><input name="AgenciaOrig" type="text" disabled="disabled" class="form" id="AgenciaOrig" value="<?=$Agencia2?>" size="7" maxlength="5" />
                             -
                             <input name="Agencia_NomeOrig" type="text" disabled="disabled" class="form" id="Agencia_NomeOrig" value="<?=$Agencia_Nome2?>" size="30" maxlength="30" /></td>
                         </tr>
                         <tr>
                           <td class="style2">N.&deg; da conta:</td>
                           <td ><input name="ContaOrig" type="text" disabled="disabled" class="form" id="ContaOrig" value="<?=$Conta2?>" size="21" maxlength="20" /></td>
                           <td><div align="right" class="style2">Titular da conta:</div></td>
                           <td colspan="2"><input name="TitularOrig" type="text" disabled="disabled" class="form" id="TitularOrig" value="<?=$Titular2?>" size="50" maxlength="50" /></td>
                         </tr>
                         <tr>
                           <td class="style2">&nbsp;</td>
                           <td>&nbsp;</td>
                           <td class="style1"><div align="right">Valor a creditar: </div></td>
                           <td class="listagem_procedente" align="right"><input name="ValorOrigRoyaltie" type="hidden" id="ValorOrigRoyaltie" value="<?=formatCurrency($ValorTotalRoyal)?>" />
                               <?=formatCurrency($ValorTotalRoyal)?></td>
                           <td>&nbsp;</td>
                         </tr>
                         
                         <tr>
                           <td class="style2">&nbsp;</td>
                           <td colspan="4">&nbsp;</td>
                         </tr>
                         <tr class="">
                           <td colspan="5" class="tab_titulo">Confirma&ccedil;&atilde;o dos dados de dep&oacute;sito</td>
                           </tr>
                         <tr>
                           <td class="style2 style1">&nbsp;</td>
                           <td >&nbsp;</td>
                           <td class="style2">&nbsp;</td>
                           <td colspan="2">&nbsp;</td>
                        </tr>
                         <tr>
                           <td colspan="5" class="style2 "><table width="70%"  border="0" align="center">
                             <tr class="">
                               <td colspan="2" align="center" class="tab_titulo"><strong>Imagem do comprovante de dep&oacute;sito </stron></td>
                             </tr>
                             <tr>
                               <td colspan="2" class="tab_inclusao"><div align="center" class="">Arquivo em formato JPG, tamanho m&aacute;ximo de 150kb</div></td>
                             </tr>
                             <tr>
                               <td>
                                 <div align="left" class="tab_inclusao">Comprovante:</div></td>

                               <td><input name="fileComprovante" type="file" class="form" id="fileComprovante" onChange="viewImage(this,'1');" size="40"></td>
                             </tr>

                             <tr>

                               <td colspan="2" class="imp_normal_total"><img src="imagens/b.gif" name="imgFile1" width="180" height="150"></td>
                             </tr>

                             <tr>

                               <td colspan="2">&nbsp;</td>
                             </tr>

                             <tr class="">

                               <td colspan="2" align="center" class="tab_titulo"><strong>Confirma&ccedil;&atilde;o da data de dep&oacute;sito</strong></td>
                             </tr>

                             <tr>

                               <td width="25%" align="center"><div align="right" class="tab_inclusao">

                                 <div align="left">Data do dep&oacute;sito: </div>

                               </div></td>

                               <td width="75%" align="center"><div align="left">

                                 <input name="DATA" type="text" class="form" id="DATA2" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$_GET['DATA']?>" size="11" maxlength="11">

                               </div></td>
                             </tr>

                           </table></td>
                           </tr>

                       </table>                         </td>
                   </tr>

                   <tr>

                     <td></td>

                     <td><div align="center"> </div></td>

                     <td></td>
                   </tr>

                 </table></td>
               </tr>

             </table></td>
             </tr>

         </table>

          <p align="center">

		  <a href="javascript:verificaForm(document.form);" ><img src="../img/bts/gravar.jpg" alt="Gravar dados" name="Image351" border="0" id="Image351"></a>

		  <a href="confirmacao_impor_webdevol_devolver.php?Destino=F&Id=<?=$ID?>"><img src="imagens/devolver_nf.jpg" alt="Devolver NF por conter informações incorretas" name="Image352" width="77" height="22" border="0" id="Image352"></a>

		  <a href="pesq_forne_credito.php" ><img src="../img/bts/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" border="0" id="Image361"></a></p></td>
       </tr>
     </table>

<input type="hidden" name="NFF" value="<?=$NFF?>">

<input type="hidden" name="NFL" value="<?=$NFL?>">

</form>







<table width="100%" cellpadding="0" cellspacing="0" border="0" align="center">

	<td>

	<br/ ><br/ >

	</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td height="100%" bgcolor="#333333" class="rodape"><?=$RodapeDesenvolvedor?></td>

    <td bgcolor="#333333" >&nbsp;</td>

  </tr>

</table>



<script language="javascript" type="text/javascript">

<!--

function validaTypeImg(fieldFile) {

	extension = (fieldFile.substring(fieldFile.lastIndexOf(".") + 1)).toLowerCase();

	if (extension == "jpg")

		return true;

	else

		return false;

}



function viewImage(fieldFile,optionValue) {

  if (fieldFile.value != "")

	document.images['imgFile' + optionValue].src = "file://" + fieldFile.value;

}



function verificaForm(formObj) {

	if (formObj.fileComprovante.value == "") {

		alert("Preencha a imagem do comprovante de depósito !");

		return;

	}else if (!validaTypeImg(formObj.fileComprovante.value)) {

		alert("Preencha a imagem do comprovante de depósito no formato incorreto (JPG) !");

		return;

	}

	

	if (formObj.DATA.value == "") {

		alert("DATA DO DEPÓSITO não foi preenchida !");

		formObj.DATA.focus();

		return;

	}



	formObj.action = "pesq_forn_inf_creditook.php";		

	document.form.submit();

}

function confirmIten() {

	if (document.form.NFF.value.indexOf("|" + document.form.NF.value + "|") != -1) {

		document.form.action = "confirmacao_impor_webdevol.php";

		document.form.submit();

	}else{

		if (document.form.NFL.value.indexOf("|" + document.form.NF.value + "|") != -1)

			alert("Item já lido!");

		else

			alert("Item inválido");

	}

}

function clearField() {

	document.form.NF.value = "";

	document.form.NF.focus();

}

<? if (trim($_POST['NF'])) { ?>

	document.form.NF.focus();

<? } ?>



<?	if ($_GET['Erro'] =="1") { ?>

	alert("Não foi possivel realizar a gravação dos dados,\na imagem do comprovante atingiu o tamanho máximo de 150Kb !");

<? } ?>

//-->

</script>