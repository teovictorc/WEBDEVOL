<? include("inc/headerI.inc.php"); 
	verifyAcess("ARZ_GERAIMPORTACAO","S");
	if (trim($_POST['NF'])) {
		$NFL = $_POST['NFL'] . "|" .$_POST['NF']. "|";
		$ID = $_POST['ID'];
	}else
		$ID = $_GET['Id'];

	$Exibe = $_GET['Exibe'];
	if (trim($ID)) {
			$Sql = "SELECT ".
						   " ROUND(PRENF_OPER_IDO,0) AS PRENF_OPER_IDO, ".
						   " PRENF_OBSTRANSPORTADORA,".
						   " PRENF_NUMPRENF,".
						   " PRENF_NUMNFDEVOLUCAO,".
						   " PRENF_SERIE,".
						   " PRENF_CFOP,".
						   " CONCAT(ROUND(PRENF_ICMS * 100,0),'%') AS ICMS,".
						   " ROUND(PRENF_QTDEVOLUME,0) PRENF_QTDEVOLUME ,".
			               " date_format(PRENF_DATA_INFNFDEVOLUCACAO,'%d/%m/%Y') DATANF, ".
						   " PRENF_OBSTRANSPORTADORA, ".
					       " PD.NOME NOMECLIENTE, ".
						   " concat(substr(PD.cgccpf,1,2),'.',substr(PD.cgccpf,3,3),'.',substr(PD.cgccpf,6,3),'/',substr(PD.cgccpf,9,4), '-',substr(PD.cgccpf,13,2)) as CNPJCLIENTE, ".
						   " PD.PESSOA CLIENTE, ".
						   " PRENF_CFOP, ".
						   " P.NOME, ".
						   " P.LOGRADOURO RUA,".
						   " P.BAIRRO, ".
						   " P.CEP, ".
						   " PD.SUFR_BENF_ICMS SUFRAMA, ". 
					       "(SELECT round(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALORTOTAL FROM RAR_PRENF_ITEM WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALORTOTAL, ".
					       "(SELECT round((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_ICMS),2) VALORICMS FROM RAR_PRENF_ITEM WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) VALORICMS, ".
					       " P.NM_MUNICIPIO CIDADE, ".
						   " P.SG_UF UF ".
					  " FROM rar_prenf, pessoa P, pessoa PD ".
					  "WHERE PRENF_PESSOA_EMITENTE = P.PESSOA ".
					         " AND PD.PESSOA = PRENF_PESSOA_DESTINATARIO ".
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
<form name="form" method="POST" action="#">
<input type="hidden" name="ID" value="<?=$ID?>">
<table width="100%"  border="0" align="center">
<table width="100%"  border="0" align="center">
     <tr>
       <td width="49%" class="tab_titulo" style="padding-top:15px;"><span class=""><h4>Pend&ecirc;ncias de NF a ser importada</h4></span></td>
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
         <td><input name="textfield" type="text" class="form" value="<?=$Rs["CLIENTE"]?>" size="6" maxlength="6" readonly></td>
         <td class="style2"><div align="right"><strong>N&ordm; Pr&eacute;-Nota</strong></div></td>
         <td><input name="textfield3" type="text" class="form" value="<?=$Rs["PRENF_NUMPRENF"]?>" size="10" maxlength="10" readonly></td>
         <td>&nbsp;</td>
       </tr>
       <tr>
         <td class="style2"><strong>Nome Cliente</strong></td>
         <td colspan="4"><input name="textfield2" type="text" class="form" value="<?=$Rs["NOMECLIENTE"]?>" size="50" maxlength="50" readonly></td>
       </tr>
       <tr>
         <td class="style2 style1">CNPJ</td>
         <td colspan="4"><input name="textfield22" type="text" class="form" value="<?=$Rs["CNPJCLIENTE"]?>" size="18" maxlength="18" readonly></td>
       </tr>
       <tr class="">
         <td height="25" colspan="5" class="tab_titulo" style="padding-top:15px;"><h4>Dados da NF de devolu&ccedil;&atilde;o</h4></td>
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
         <td colspan="4"><input name="ADFDF" type="text" class="form" id="ADFDF" value="<?=$Rs["NOME"]?>" size="80" maxlength="80" readonly></td>
       </tr>
       <tr>
         <td class="style2"><strong>Endere&ccedil;o</strong></td>
         <td><input name="textfield23" type="text" class="form" value="<?=$Rs["RUA"]?>" size="30" maxlength="30" readonly></td>
         <td class="style2"><div align="right"><strong>Bairro</strong></div></td>
         <td colspan="2"><input name="textfield232" type="text" class="form" value="<?=$Rs["BAIRRO"]?>" size="40" readonly maxlength="40"></td>
       </tr>
       <tr>
         <td class="style2"><strong>Cidade</strong></td>
         <td width="22%"><input name="textfield2322" type="text" class="form" value="<?=$Rs["CIDADE"]?>" size="20" readonly maxlength="20"></td>
         <td width="19%" class="style2"><div align="right"><strong>UF</strong></div></td>
         <td colspan="2"><input name="textfield23232" type="text" class="form" value="<?=$Rs["UF"]?>" size="4" readonly maxlength="2">
         </td>
       </tr>
       <tr>
         <td class="style2"><strong>CFOP Entrada</strong></td>
         <td class="style1"><input name="textfield2323222" type="text" class="form" value="<?=$Cfop?>" readonly size="20" maxlength="20">
         </td>
         <td class="style2"><div align="right"><strong>Qtde volumes</strong></div></td>
         <td colspan="2" class="style1"><input name="PRENF_QTDEVOLUME" type="text" class="form" id="PRENF_QTDEVOLUME" readonly onKeyPress="return JSUtilApenasNumero(event);" value="<?=$Rs["PRENF_QTDEVOLUME"]?>" size="3" maxlength="3">
         </td>
       </tr>
       <tr>
         <td valign="top" class="style2"><strong>Opera&ccedil;&atilde;o</strong></td>
         <td colspan="3" class="style1">
		 		 <? $StmtC = mysql_query("SELECT CD_OPER,DS_OPER FROM operacao WHERE CD_OPER = ".$Rs["PRENF_OPER_IDO"]);
			   $RsC = mysql_fetch_assoc($StmtC);
			   {$Operacao = $Rs["PRENF_OPER_IDO"].' - '.$RsC["DS_OPER"];}?>
          <input name="textfield23232222" type="text" class="form" value="<?=$Operacao?>" readonly size="60" maxlength="60">          <div align="right" class="style2"></div></td><td class="style1">&nbsp;</td>
       </tr>
       <tr>
         <td valign="top" class="style2"><strong>Observa&ccedil;&otilde;es para transportadora</strong></td>
         <td colspan="4" class="style1"><textarea name="PRENF_OBSTRANSPORTADORA" cols="100%" rows="5" class="text_form" readonly id="PRENF_OBSTRANSPORTADORA"><?=$Rs["PRENF_OBSTRANSPORTADORA"]?></textarea></td>
        </tr>
       <tr>
         <td colspan="5">
           <div align="center"></div></td>
       </tr>
       <tr class="">
         <td height="30" colspan="5" class="tab_titulo" style="padding-top:15px;"><div align="left"><h4>&nbsp;Listagens dos produtos da pr&eacute;-nota</h4></div></td>
       </tr>
       <tr>
         <td colspan="5"><table width="100%"  border="0" align="center">
           <tr class="tab_usuarios" >
             <td width="28%" ><div align="center">Refer&ecirc;ncia</div></td>
             <td width="12%" ><div align="center">Unidade Medida </div></td>
             <td width="12%" ><div align="center">Class. fiscal </div></td>
             <td width="12%" ><div align="right">Quantidade</div></td>
             <td width="12%" ><div align="right">Valor Unit&aacute;rio </div></td>
             <td width="12%" ><div align="right">Valor Total</div></td>
             <td width="12%" ><div align="right">% ICMS</div></td>
           </tr>
<? 
	$Sql = "SELECT LANCA_NUMRAR,".
 	               " PRENFI_CLASSIFICACAOFISCAL,".
		           " concat(substring(PRENFI_REFERENCIA,1,4),'-',substring(PRENFI_REFERENCIA,5,4),'-',substring(PRENFI_REFERENCIA,9,4),'-',substring(PRENFI_REFERENCIA,13,4)) PRENFI_REFERENCIA, ".
		           " PRENFI_UNIDADE,".
		           " round(PRENFI_QUANTIDADE,0) as PRENFI_QUANTIDADE, ".
				   " round(PRENFI_VALORUNITARIO,2) VALOR_UNITARIO, ".
		           " round((PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR 
		   FROM rar_prenf_item WHERE PRENFI_NUMPRENF = '" .$ID. "'";
	$Stmt2 = mysql_query($Sql);
	$NFF = "";
	while($RsI = mysql_fetch_assoc($Stmt2)) { 
		$var = strpos($NFL,"|" .str_replace("-","",$RsI["LANCA_NUMRAR"]). "|");
		if ($var === false && $Exibe == "N") { 
			$NFF.= "|" .str_replace("-","",$RsI["LANCA_NUMRAR"]). "|";
		}else{  ?>
           <tr bordercolor="#00CCFF" class="tab_usuarios_info">
             <td width="20%" > <div align="center"><?=$RsI["PRENFI_REFERENCIA"]?></div></td>
             <td width="12%"><div align="center"><?=$RsI["PRENFI_UNIDADE"]?></div></td>
             <td width="12%"><div align="center"><?=$RsI["PRENFI_CLASSIFICACAOFISCAL"]?></div></td>
             <td width="12%"><div align="right"><?=$RsI["PRENFI_QUANTIDADE"]?></div></td>
             <td width="12%"><div align="right"><?=formatCurrency($RsI["VALOR_UNITARIO"])?></div></td>
             <td width="12%"><div align="right"><?=formatCurrency($RsI["VALOR"])?></div></td>
             <td width="12%"><div align="right"><?=$Rs["ICMS"]?></div></td>
           </tr>
<? 	   }
	
	} ?>
         </table></td>
       </tr>
       <tr>
         <td colspan="5"><table width="100%"  border="0" align="center">
           <tr class="tab_inclusao">
             <td width="25%" >
               <div align="right"><strong>Valor do ICMS: </strong></div></td>
             <td width="25%" a href="cad_defeitos.htm"><div align="left"><span class="style1">
                 <input name="txt" type="text" disabled class="form" id="txt" value="<?=formatCurrency($Rs["VALORICMS"])?>" size="10" maxlength="10">
             </span></div></td>
             <td width="25%" a href="cad_defeitos.htm"><div align="center"></div></td>
             <td width="25%" a href="cad_defeitos.htm"><div align="right"><strong>Valor total dos produtos</strong></div></td>
             <td width="25%" a href="cad_defeitos.htm"><div align="left"><span class="style1">
                 <input name="textfield232322222" type="text" disabled class="form" value="<?=formatCurrency($Rs["VALORTOTAL"])?>" size="10" maxlength="10">
             </span></div></td>
           </tr>
		   <?
		   if ($Rs["SUFRAMA"] == "S"){
				$Sql = "SELECT distinct aliq_icms";
				$Sql.= " FROM rar_lancamento l, rar_prenf_item i, item_nota_fiscal, rar_item";
				$Sql.= " WHERE l.lanca_numrar = item_numrar ";
				$Sql.= "       AND num_nf = item_nf ";
				$Sql.= "       AND prenfi_ido = lanca_prenfi_ido";
				$Sql.= "       AND serie_nf = item_serie ";
				$Sql.= "       AND cd_item_material = item_referencia ";
				$Sql.= "       AND prenfi_numprenf = '" .$_GET['Id']. "'";
				$Stmt = mysql_query($Sql);
				$RsIcms = mysql_fetch_assoc($Stmt);
				$ValorTotal = round(($Rs["VALORTOTAL"] * (1-$RsIcms["aliq_icms"]))+ $Rs["VALORIPI"],2);
			}else{
				$ValorTotal = $Rs["VALORTOTAL"];
			}
		   ?>
		   
		   
		   
		   
           <tr class="tab_inclusao">
             <td >&nbsp;</td>
             <td a href="cad_defeitos.htm">&nbsp;</td>
             <td a href="cad_defeitos.htm">&nbsp;</td>
             <td a href="cad_defeitos.htm"><div align="right">
               <div align="right" class=""><strong>Valor total da NF</strong></span></div></td>
             <td a href="cad_defeitos.htm"><span class="style1">
               <input name="textfield2323222222" type="text" disabled class="form" value="<?=formatCurrency($ValorTotal)?>" size="10" maxlength="20">
             </span></td>
           </tr>
           <tr class="listagem">
             <td >&nbsp;</td>
             <td a href="cad_defeitos.htm">&nbsp;</td>
             <td a href="cad_defeitos.htm">&nbsp;</td>
             <td a href="cad_defeitos.htm">&nbsp;</td>
             <td a href="cad_defeitos.htm">&nbsp;</td>
           </tr>
           <tr class="listagem">
             <td colspan="5" ><table width="95%" border="0" align="center">
               <tr>
                 <td><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">
                   <tr>
                     <td width="5%"></td>
                     <td width="94%" class="tab_titulo"><div align="center"><h4>&Iacute;tem a ser confirmado</h4></div></td>
                     <td width="1%"></td>
                   </tr>
                   <tr>
                     <td rowspan="2" >&nbsp;</td>
                     <td height="0"></td>
                     <td rowspan="2" >&nbsp;</td>
                   </tr>
                   <tr>
                     <td><table width="100%"  border="0" align="center" class="tab_inclusao">
                         <tr>
                           <td width="16%" class="style2"><strong>&Iacute;tem da NF </strong></td>
                           <td width="84%"><input name="NF" type="text" class="form" id="NF" maxlength="11">
&nbsp;                             <input name="Button" type="button" class="campo_texto" value="Confirmar sele&ccedil;&atilde;o" onClick="confirmIten();">
                             <input name="Submit2" type="button" class="campo_texto" value="Cancelar" onClick="clearField();"></td>
                         </tr>
                         <tr>
                           <td colspan="2"><div align="center">
                           </div></td>
                         </tr>
                       </table>
                         </td>
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
		  <a href="javascript:verificaForm(document.form);"><img src="../img/bts/gravar.jpg" alt="Gravar dados" name="Image351" border="0" id="Image351"></a>
		  <a href="confirmacao_impor_arezzo_devolver.php?Id=<?=$ID?>" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Image352','','imagens/devolver_nf2.jpg',1)"><img src="imagens/devolver_nf.jpg" alt="Devolver NF por conter informações incorretas" name="Image352" width="87" height="20" border="0" id="Image352"></a>
		  <a href="pesq_impor_arezzo.php"><img src="../img/bts/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" border="0" id="Image361"></a></p></td>
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
function verificaForm(formObj) {
	if (formObj.NFF.value != "") {
		alert("Importação da NF não pode ser processada.\nExistem ítens em aberto !");
		formObj.NF.focus();
		return;
	}

	formObj.action = "confirmacao_impor_arezzook.php";		
	document.form.submit();
}
function confirmIten() {
	if (document.form.NFF.value.indexOf("|" + document.form.NF.value + "|") != -1) {
		document.form.action = "confirmacao_impor_arezzo.php";
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
//-->
</script>
