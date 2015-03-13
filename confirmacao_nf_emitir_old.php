<? include("inc/headerI.inc.php");

verifyAcess("CLINFEEMITIR","S");
	$dia = date(d); 
	$mes = date(m); 
	$ano = date(Y); 
	$hoje = $dia."/".$mes."/".$ano;
	if (trim($_GET['Id'])) {
			$Sql = "SELECT rar_prenf.*, ".
			               " concat(substr(P.cgccpf,1,2),'.',substr(P.cgccpf,3,3),'.',substr(P.cgccpf,6,3),'/',substr(P.cgccpf,9,4), '-',substr(P.cgccpf,13,2)) as CNPJ, ".
			               " concat(substr(PD.cgccpf,1,2),'.',substr(PD.cgccpf,3,3),'.',substr(PD.cgccpf,6,3),'/',substr(PD.cgccpf,9,4), '-',substr(PD.cgccpf,13,2)) as CNPJC, ".
			               " date_format(PRENF_DATA_INFNFDEVOLUCACAO,'%d/%m/%Y') DATANF, ".
						   " PRENF_OBSTRANSPORTADORA, ".
						   " ROUND(PRENF_QTDEVOLUME,0) AS QTDEVOLUME, ".
						   " CONCAT(ROUND(PRENF_ICMS*100,0),'%') AS ICMS, ".
						   " CONCAT(ROUND(PRENF_IPI*100,0),'%') AS IPI, ".
					       " PD.NOME NOMECLIENTE, ".
						   " PD.PESSOA CLIENTE, ".
						   " PRENF_CFOP, ".
						   " PRENF_ICMS, ".
						   " P.NOME, ".
						   " P.IE AS INSCRICAOESTADUAL,".
						   " P.CEP AS CEP,".
						   " P.LOGRADOURO RUA, ".
						   " P.BAIRRO, ".
						   " P.CEP, ".
						   " null SUFRAMA, ".
						   " null SIMPLES, ".
					       " (SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) + ROUND((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI),2) VALORTOTAL ".
						   "    FROM rar_prenf_item ".
					       "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".
						   "GROUP BY PRENF_PESSOA_EMITENTE) VALORTOTAL, ".
						   " (SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) BASEICMS ".
						   "    FROM rar_prenf_item ".
					       "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".
						   "GROUP BY PRENF_PESSOA_EMITENTE) BASEICMS, ".
					       " (SELECT ROUND((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_ICMS),2) VALORICMS ".
						   "    FROM rar_prenf_item ".
					       "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".
						   "GROUP BY PRENF_PESSOA_EMITENTE) VALORICMS, ".
						   " (SELECT ROUND((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_IPI),2) VALORIPI ".
						   "    FROM rar_prenf_item ".
					       "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".
						   "GROUP BY PRENF_PESSOA_EMITENTE) VALORIPI, ".
					       " O.DS_OPER, ".
						   " P.NM_MUNICIPIO CIDADE, ".
						   " P.SG_UF UF, PRENF_MOTIVODEVOLUCAO, PRENF_TRANSP_IDO ".
					" FROM rar_prenf, pessoa P, pessoa PD, operacao O".
					" WHERE PRENF_PESSOA_EMITENTE = P.PESSOA ".
					"      AND CD_OPER = PRENF_OPER_IDO".
					"      AND PD.PESSOA = PRENF_PESSOA_DESTINATARIO ".
					"      AND PRENF_NUMPRENF = '" .$_GET['Id']. "'";
		$Stmt = mysql_query($Sql);
		$ID = $_GET["Id"];
		$DESTINO = $_GET["Destino"];
		$Rs = mysql_fetch_assoc($Stmt);
		$PRENF_MOTIVODEVOLUCAO = $Rs["PRENF_MOTIVODEVOLUCAO"];

		//verificar se base de calculo é reduzida
		if ($Rs["PRENF_CATEGORIA"] == "2"){
			if ($Rs["UF"] == "RS" && $Rs["PRENF_CFOP"] == "5.201"){
				$BaseIcms = $Rs["BASEICMS"] * 0.70589;
				$Icms = $BaseIcms * $Rs["PRENF_ICMS"];
			}else{
				$BaseIcms = $Rs["BASEICMS"];
				$Icms = $Rs["VALORICMS"];
			}
		}else{
			$BaseIcms = $Rs["BASEICMS"];
			$Icms = $Rs["VALORICMS"];
		}
		
		$Sql = "select * from rar_transportadoras where transp_ido = '".$Rs["PRENF_TRANSP_IDO"]."'";
		$StmtTrans = mysql_query($Sql);
		$RsTransp = mysql_fetch_assoc($StmtTrans);
		$Transportadora = $RsTransp["transp_nome"];
		if ($Transportadora == "") { 
			$Transportadora = "Não informada";
		};
		
	}

?><style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
	var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.01
	var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
	var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   	if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}

//-->

</script>
<script type="text/javascript" src="js/validacao.js"></script>
<link href="wfa.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style3 {color: #FFFFFF}
-->
</style>

<body onLoad="MM_preloadImages('imagens/imprimir2.jpg','imagens/gravar2.jpg','imagens/cancelar2.jpg')">
<form name="form" method="post" action="#">
<input type="hidden" name="ID" value="<?=$ID?>">

<input type="hidden" name="DESTINO" value="<?=$DESTINO?>">

<tr>

    <td height="100%" valign="top" class="tab_conteudo">

    <table width="100%" border="0" cellspacing="0" cellpadding="0">

      <tr>

        <td height="100%" class="tab_titulo"><h4>Pend&ecirc;ncias de NF a emitir</h4></td>

      </tr>

    </table>



     <table width="100%"  border="0" class="tab_inclusao">

       <tr>

         <td width="15%" class=""><strong>C&oacute;digo</strong></td>

         <td width="30%"><input name="CODPESSOA" type="text" class="form" id="CODPESSOA" value="<?=$Rs["CLIENTE"]?>" size="6" maxlength="6">

          <input name="PESSOA" type="hidden" class="form" id="PESSOA" value="<?=$Rs["CLIENTE"]?>" size="6" maxlength="6"></td>

         <td colspan="2" class=""><div align="right"><strong>N&ordm; Pr&eacute;-Nota</strong></div></td>

         <td colspan="3"><input name="prenf" type="text" class="form" id="prenf" value="<?=$Rs["PRENF_NUMPRENF"]?>" size="10" maxlength="10"></td>
        </tr>

		<tr>

         <td width="15%" class=""><strong>Nome Cliente</strong></td>

         <td width="30%">

         	<input name="textfield2" type="text" class="form" value="<?=$Rs["NOMECLIENTE"]?>" size="50" maxlength="50">		 </td>

         <td colspan="2" class=""><div align="right"><strong>CNPJ</strong></div></td>

         <td colspan="3">

		 	<input name="ADFDF3" type="text" class="form" id="ADFDF3" value="<?=$Rs["CNPJC"]?>" size="20" maxlength="18">		 </td>
        </tr>

	   <? if ($PRENF_MOTIVODEVOLUCAO != ""){ ?>

		   <tr>

		     <td height="25" colspan="7" class=""><table width="70%"  border="0" align="center" class="">

               <tr>

                 <td colspan="2"><div align="center" class=""><strong>:: NOTA FISCAL DEVOLVIDA ::</strong></div></td>
               </tr>

               <tr>

                 <td width="14%" class=""><div align="left"><strong>Motivo:</strong></div></td>

                 <td width="86%" class=""><?=$PRENF_MOTIVODEVOLUCAO?></td>
               </tr>

             </table></td>
        </tr>

		<? } ?>

       <tr class="">

         <td height="25" colspan="7" class="tab_titulo" style="padding-top:10px;"><strong>Dados da NF de devolu&ccedil;&atilde;o</strong></td>
        </tr>

       <tr>

         <td class=""><strong>N&ordm; NF devolu&ccedil;&atilde;o*</strong></td>

         <td><input name="PRENF_NUMNFDEVOLUCAO" type="text" class="form" id="PRENF_NUMNFDEVOLUCAO" value="<?=$Rs["PRENF_NUMNFDEVOLUCAO"]?>" size="7" maxlength="6"></td>

         <td colspan="2" class=""><div align="right"><strong>N&ordm; s&eacute;rie*</strong></div></td>

         <td colspan="3"><input name="PRENF_SERIE" type="text" class="form" id="PRENF_SERIE" value="<?=((trim($Rs["PRENF_SERIE"])) ? $Rs["PRENF_SERIE"] : "U")?>" size="11" maxlength="3"></td>
       </tr>

       <tr>

         <td class=""><strong>Data NF devolu&ccedil;&atilde;o*</strong></td>

         <td colspan="6"><input name="PRENF_DATA_INFNFDEVOLUCAO" type="text" class="form" id="PRENF_DATA_INFNFDEVOLUCAO" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$Rs["DATANF"]?>" size="11" maxlength="11"></td>
       </tr>

       <tr>

         <td class=""><strong>CFOP</strong></td>

         <td colspan="6"><span class="style1">

           <input name="textfield2323222" type="text" class="form" value="<?=$Rs["PRENF_CFOP"].' - '.$Rs["DS_OPER"]?>" size="80" maxlength="80">

         </span></td>
       </tr>

       <tr>

         <td class=""><strong>Destinat&aacute;rio</strong></td>

         <td colspan="6"><input name="ADFDF" type="text" class="form" id="ADFDF" value="<?=$Rs["NOME"]?>" size="80" maxlength="80"></td>
       </tr>

       <tr>

         <td class=""><strong>Endere&ccedil;o</strong></td>

         <td colspan="2"><input name="textfield23" type="text" class="form" value="<?=$Rs["RUA"]?>" size="80">           <div align="right"></div></td>

         <td width="5%" class=""><div align="right"><strong>Bairro</strong></div></td>

         <td colspan="3"><input name="textfield232" type="text" class="form" value="<?=$Rs["BAIRRO"]?>" size="40" maxlength="40"></td>
       </tr>

       <tr>

         <td class=""><strong>Cidade</strong></td>

         <td><input name="textfield2322" type="text" class="form" value="<?=$Rs["CIDADE"]?>"></td>

         <td colspan="2" class=""><div align="right"><strong>UF</strong></div></td>

         <td width="3%"><input name="textfield23232" type="text" class="form" value="<?=$Rs["UF"]?>" size="4" maxlength="2">         </td>

         <td width="5%"  class=""><div align="right"><strong>CEP</strong></div></td>

         <td width="23%"><input name="textfield232322" type="text" class="form" value="<?=$Rs["CEP"]?>" size="10" maxlength="10"></td>
       </tr>

       <tr>

         <td class=""><strong>CNPJ</strong></td>

         <td><input name="ADFDF" type="text" class="form" id="ADFDF" value="<?=$Rs["CNPJ"]?>" size="20" maxlength="18"></td>

         <td colspan="2"><div align="right" class=""><strong>Inscri&ccedil;&atilde;o estadual </strong></div></td>

         <td colspan="3"><input name="ADFDF2" type="text" class="form" id="ADFDF2" value="<?=$Rs["INSCRICAOESTADUAL"]?>" size="30" maxlength="30"></td>
       </tr>
       <tr>
         <td><strong>Transportadora</strong></td>
         <td colspan="6"><input name="ADFDF4" type="text" class="form" id="ADFDF4" value="<?=$Transportadora?>" size="50"></td> 
        </tr>

       <tr>

         <td class=""><strong>Qtde volumes*</strong></td>

         <td class=""><input name="PRENF_QTDEVOLUME" type="text" class="form" id="PRENF_QTDEVOLUME" onKeyPress="return JSUtilApenasNumero(event);" value="<?=$Rs["QTDEVOLUME"]?>" size="3" maxlength="3">         </td>

         <td colspan="2" class=""><div align="right"></div></td>

         <td colspan="3" class="">&nbsp;</td>
       </tr>

       <tr>

         <td valign="top" class=""><strong>Observa&ccedil;&otilde;es para transportadora</strong></td>

         <td colspan="6" class=""><textarea name="PRENF_OBSTRANSPORTADORA" cols="100%" class="txt" rows="5" class="text" id="PRENF_OBSTRANSPORTADORA"><?=$Rs["PRENF_OBSTRANSPORTADORA"]?></textarea></td>
        </tr>

       <tr>

         <td colspan="7">

           <div align="center"></div></td>
       </tr>

       <tr class="">

         <td height="30" colspan="7" class="tab_titulo" style="margin-top:10px;"><div align="left"><strong>Listagens dos produtos da pr&eacute;-nota</strong></div></td>
       </tr>

       <tr>

         <td colspan="7"><table width="100%"  border="0" align="center" cellpadding="0" cellspacing="0">

           <tr class="tab_usuarios" >

             <td width="17%" ><div align="center">Refer&ecirc;ncia</div></td>

             <td width="16%" ><div align="left">Descri&ccedil;&atilde;o</div></td>

             <td width="19%" ><div align="center">N&ordm; RAR - NF/S&eacute;rie Origem</div>               </td>

             <td width="11%" ><div align="center">Class. fiscal</div></td>

             <td width="6%" ><div align="center">U.M.</div></td>

             <td width="6%" ><div align="center">Qtde</div></td>

             <td width="9%" ><div align="center">Valor Unit.</div></td>

             <td width="7%" ><div align="center">Valor Total</div></td>

             <td width="5%" ><div align="center">% ICMS </div></td>

             <td width="4%" ><div align="center">% IPI </div></td>
           </tr>

<?

	$Sql = "SELECT PRENFI_IDO, PRENFI_CLASSIFICACAOFISCAL, ".
	             " concat(substring(PRENFI_REFERENCIA,1,4), '-',substring(PRENFI_REFERENCIA,5,4), '-',substring(PRENFI_REFERENCIA,9,4), '-',substring(PRENFI_REFERENCIA,13,4)) PRENFI_REFERENCIA, ".
				 " PRENFI_UNIDADE, ".
				 " ROUND(PRENFI_QUANTIDADE,0) AS PRENFI_QUANTIDADE,  ".
				 " ROUND(PRENFI_VALORUNITARIO,2) VALOR_UNITARIO,  ".
				 " ROUND((PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR".
		    " FROM rar_prenf_item, rar_prenf ".
			"WHERE PRENFI_NUMPRENF = '" .$ID. "'".
			"      AND PRENFI_NUMPRENF = PRENF_NUMPRENF".
			" ORDER BY PRENFI_IDO";
	$Stmt2 = mysql_query($Sql);
	while ($RsI = mysql_fetch_assoc($Stmt2)) { 
	
		$Sql = "SELECT * from item_material where cd_item_material = '".$RsI["PRENFI_REFERENCIA"]."'";
		$Stmt4 = mysql_query($Sql);
		if ($RsD = mysql_fetch_assoc($Stmt4)){
			$Descricao = $RsD["DS_RESUMIDA_ITEM"];
		}else{
			$Descricao = "";
		}

	
		$Sql = "SELECT lanca_numrar, item_serie, item_nf FROM rar_lancamento, rar_item ";
		$Sql.= " WHERE lanca_numrar = item_numrar and lanca_prenfi_ido='".$RsI["PRENFI_IDO"]."'";
		$Stmt3 = mysql_query($Sql);
		$NUMRARS = "";
		while ($RsR = mysql_fetch_assoc($Stmt3))
			$NUMRARS.= $RsR["lanca_numrar"]." - ".$RsR["item_nf"]."/".$RsR["item_serie"]."<BR>";
			$NUMRARS = substr($NUMRARS,0,strlen($NUMRARS)-4);
		
			?>
           <tr valign="top" bordercolor="#00CCFF" class="tab_usuarios_info">
             <td><div align="center"><?=$RsI["PRENFI_REFERENCIA"]?></div></td>
             <td><?=$Descricao?></td>
			<?
			
			?>

             <td><div align="center"><?=$NUMRARS?></div>               </td>
             <td width="11%"><div align="center"><?=$RsI["PRENFI_CLASSIFICACAOFISCAL"]?></div></td>
			 <td width="6%"><div align="center"><?=$RsI["PRENFI_UNIDADE"]?></div></td>
             <td width="6%"><div align="right"><?=$RsI["PRENFI_QUANTIDADE"]?></div></td>
             <td width="9%"><div align="right"><?=formatCurrency($RsI["VALOR_UNITARIO"])?></div></td>
             <td width="7%" align="right"><?=formatCurrency($RsI["VALOR"])?></td>
             <td width="5%" align="center"><?=$Rs["ICMS"]?></td>
             <td width="4%" align="center"><?=$Rs["IPI"]?></td>
           </tr>

<? } ?>

         </table></td>
       </tr>

       <tr>

         <td colspan="7"><table width="100%"  border="0" align="center">

           <tr class="tab_usuario">

             <td width="20%" >

               <div align="right" class="">Base c&aacute;lculo ICMS </div></td>

             <td width="10%" ><div align="left"><span class="">

                   <input name="textfield2323222223" type="text" disabled class="form" value="<?=formatCurrency($BaseIcms)?>" size="10" maxlength="20">

             </span></div></td>

             <td width="25%" a href="cad_defeitos.htm"><div align="right"><strong>Valor do ICMS</strong></div></td>

             <td width="11%" a href="cad_defeitos.htm"><div align="left"><span class="style1">

                   <input name="txt" type="text" disabled class="form" id="txt2" value="<?=formatCurrency($Icms)?>" size="10" maxlength="20">

             </span></div></td>

             <td width="30%" a href="cad_defeitos.htm"><div align="right"><strong>Valor total dos produtos</strong></div></td>

             <td width="11%" a href="cad_defeitos.htm"><div align="left"><span class="style1">

                 <input name="textfield232322222" type="text" disabled class="form" value="<?=formatCurrency($Rs["BASEICMS"])?>" size="10" maxlength="20">

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

				$ValorTotal = round($Rs["VALORTOTAL"] * (1-$RsIcms["aliq_icms"]),2) + $Rs["VALORIPI"];

				//echo(round($ValorTotal,2));

			}else{

				$ValorTotal = $Rs["VALORTOTAL"];

			}

			//$ValorTotal = $Rs["VALORIPI"] + $ValorTotal;

			$ValorTotal = str_replace(".",",",$ValorTotal);

			//echo($ValorTotal);

			//$ValorTotal = number_format($ValorTotal, 2, ',', '');



		   ?>



           <tr class="">

             <td >&nbsp;</td>

             <td >&nbsp;</td>

             <td class=""><div align="right">Valor do IPI</div></td>

             <td><span class="style1">

               <input name="txt2" type="text" disabled class="form" id="txt" value="<?=formatCurrency($Rs["VALORIPI"])?>" size="10" maxlength="20">

             </span></td>

             <td><div align="right" class="style1">Valor total da NF</div></td>

             <td><div align="left"><span class="style1">

                   <input name="textfield2323222222" type="text" disabled class="form" value="<?=$ValorTotal?>" size="10" maxlength="20">

             </span></div></td>
           </tr>

         </table>

		 <?

		 if ($Rs["SIMPLES"] == "S"){
		 	//Busca primeiro a aliq de ICMS
			$sql = " SELECT distinct it.aliq_icms aliq_icms";
			$sql.= " FROM rar_prenf_item p, rar_lancamento l, rar_item i, item_nota_fiscal it ";
			$sql.= " WHERE PRENFI_NUMPRENF = '" .$_GET['Id']. "'";
			$sql.= " AND l.lanca_prenfi_ido = prenfi_ido ";
			$sql.= " AND i.item_numrar = l.lanca_numrar ";
			$sql.= " AND it.num_nf = i.item_nf ";
			$sql.= " AND it.serie_nf = i.item_serie ";
			$sql.= " AND it.cd_item_material = item_referencia ";
			$Stmt = mysql_query($sql);
			$Rs = mysql_fetch_assoc($Stmt);
			$PercIcms = str_replace(",",".",$Rs["aliq_icms"]);
		
			//Multiplica somatório de ítens da pré-nota x Percentual ICMS
		 	$sql = " SELECT sum( (item_valor * item_qtde) * " . $PercIcms .") AS valor";
			$sql.= " FROM rar_prenf_item p, rar_lancamento l, rar_item i";
			$sql.= " WHERE PRENFI_NUMPRENF = '" .$_GET['Id']. "'";
			$sql.= " AND l.lanca_prenfi_ido = prenfi_ido ";
			$sql.= " AND i.item_numrar = l.lanca_numrar ";
			$Stmt = mysql_query($sql);
			$Rs = mysql_fetch_assoc($Stmt);
			$Icms = $Rs["valor"];
		 ?>

           <table width="100%"  border="0" align="center" class="">
             <tr>
               <td width="100%"><div align="center">
                 <p class="style3">Caro franqueado, por sua empresa estar enquadrada como ME/EPP, favor inserir nos <strong>“Dados Adicionais”</strong><br>
  					da nota fiscal a base de c&aacute;lculo e o valor de ICMS, conforme segue abaixo:<br>
Base de C&aacute;lculo: R$ <?=formatCurrency($BaseIcms)?> <br>
Valor do ICMS: R$ <?=formatCurrency($Icms)?>
<br>
<br>
Obrigado!</p>

                 </div></td>
              </tr>
           </table>

		   <?

		   }

		   ?>

		 <?

		 if ($Rs["SUFRAMA"] == "S"){

		 ?>

           <table width="100%"  border="0" align="center">

             <tr>

               <td width="107%" class="tab_inclusao"><div align="center" class="listagem_autorgerada style1">Mencionar o texto abaixo no campo de observa&ccedil;&otilde;es da nota fiscal:<br>

                Desconto referente ao ICMS (Zona Franca): <?=$RsIcms["aliq_icms"]*100?>%</div></td>
              </tr>
           </table>

		   <?

		   }

		   ?>

		   <p align="center"><a href="javascript:verificaForm(document.form);" ><img src="../img/bts/gravar.jpg" alt="Gravar dados" name="Image351" width="52" height="22" border="0" id="Image351"></a><a href="javascript: voltar();"><img src="../img/bts/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" width="52" height="22" border="0" id="Image361"></a><a href="javascript:Imprimir();"><img src="imagens/imprimir.jpg" name="Image2" width="52" height="22" border="0"></a><a href="javascript:Email();"><img src="imagens/enviar.jpg" alt="Encaminhar pr&eacute;-nota via email" width="52" height="22" border="0"></a></p></td>
       </tr>
     </table>

</form>

	<br/ ><br/ >

	</td>

    <td>&nbsp;</td>

  </tr>

  <tr>

    <td height="100%" bgcolor="#333333" class="rodape"><?=$RodapeDesenvolvedor?></td>

    <td bgcolor="#333333">&nbsp;</td>

  </tr>

</table>



<script language="javascript" type="text/javascript">
<!--
function voltar(){
	if (document.form.DESTINO.value == "1"){
		document.location.href = "pesq_retaguarda_prenota.php";
	}else{
		document.location.href = "pesq_nf_emitir.php";
	}
}

function Email(){
	abrir_janela_popup('prenf_email.php?Id='+document.form.prenf.value,'email_prenota','width=500,height=350,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes')
}

function Imprimir(){
	abrir_janela_popup('imp_prenota.php?Id='+document.form.prenf.value,'impressao_prenota','width=800,height=600,top=0,left=0, scrollbars=yes,status=no,resizable=yes,dependent=yes')
	//abrir_janela_popup('imp_prenota.php?Id='+document.form.prenf.value,'impressao_prenota','fullscreen=yes, scrollbars=yes,dependent=yes')	
}

function verificaForm(formObj) {
	if (formObj.PRENF_NUMNFDEVOLUCAO.value == "") {
		alert("Preencha o campo \"Nº NF devolução\"");
		formObj.PRENF_NUMNFDEVOLUCAO.focus();
		return;
	}
	if (formObj.PRENF_SERIE.value == "") {
		alert("Preencha o campo \"Nº série\"");
		formObj.PRENF_SERIE.focus();
		return;
	}
	if (!JSUtilValidaData(formObj.PRENF_DATA_INFNFDEVOLUCAO.value,true)) {
		alert("Campo \"Data NF devolução\" não informado ou inválido !");
		formObj.PRENF_DATA_INFNFDEVOLUCAO.focus();
		return;
	}else{
		//hoje=new Date();
		//hoje=""+ hoje.getDate()+"/"+(hoje.getMonth()+1)+"/"+hoje.getYear();
		hoje = '<?=$hoje?>';
		
		//if (ComparaDatas(hoje,formObj.PRENF_DATA_INFNFDEVOLUCAO.value) == false){
		if (JSUtilDataMaior(formObj.PRENF_DATA_INFNFDEVOLUCAO.value, hoje) == true){
			alert("O campo \"Data NF devolução\" não pode conter uma data superior a data de hoje !");
			return;
		}
		
		/*if (DateDiff('d',hoje,formObj.PRENF_DATA_INFNFDEVOLUCAO.value,'','') > 0) {
			alert("O campo \"Data NF devolução\" não pode conter uma data superior a data de hoje !");
			return;
		}*/
	}

	if (formObj.PRENF_QTDEVOLUME.value == "" || formObj.PRENF_QTDEVOLUME.value == 0) {
		alert("Campo \"Qtde volumes\" deve estar preenchido e deve ser maior que zero !");
		formObj.PRENF_QTDEVOLUME.focus();
		return;
	}

	formObj.action = "confirmacao_nf_emitirok.php";
	document.form.submit();
}

// REQUIRES: isDate()
// NOT SUPPORTED: firstdayofweek and firstweekofyear (defaults for both)
function dateDiff(p_Interval, p_Date1, p_Date2, p_firstdayofweek, p_firstweekofyear){
    if(!isDate(p_Date1)){return "invalid date: '" + p_Date1 + "'";}
    if(!isDate(p_Date2)){return "invalid date: '" + p_Date2 + "'";}
    var dt1 = new Date(p_Date1);
    var dt2 = new Date(p_Date2);

    // get ms between dates (UTC) and make into "difference" date
    var iDiffMS = dt2.valueOf() - dt1.valueOf();
    var dtDiff = new Date(iDiffMS);

    // calc various diffs
    var nYears  = dt2.getUTCFullYear() - dt1.getUTCFullYear();
    var nMonths = dt2.getUTCMonth() - dt1.getUTCMonth() + (nYears!=0 ? nYears*12 : 0);
    var nQuarters = parseInt(nMonths/3);    //<<-- different than VBScript, which watches rollover not completion

    var nMilliseconds = iDiffMS;
    var nSeconds = parseInt(iDiffMS/1000);
    var nMinutes = parseInt(nSeconds/60);
    var nHours = parseInt(nMinutes/60);
    var nDays  = parseInt(nHours/24);
    var nWeeks = parseInt(nDays/7);


    // return requested difference
    var iDiff = 0;
    switch(p_Interval.toLowerCase()){
        case "yyyy": return nYears;
        case "q": return nQuarters;
        case "m": return nMonths;
        case "y":         // day of year
        case "d": return nDays;
        case "w": return nDays;
        case "ww":return nWeeks;        // week of year    // <-- inaccurate, WW should count calendar weeks (# of sundays) between
        case "h": return nHours;
        case "n": return nMinutes;
        case "s": return nSeconds;
        case "ms":return nMilliseconds;    // millisecond    // <-- extension for JS, NOT available in VBScript
        default: return "invalid interval: '" + p_Interval + "'";
    }
}

function DateDiff(p_interval, p_date1, p_date2, p_firstdayofweek, p_firstweekofyear){
    return dateDiff(p_interval, p_date1, p_date2, p_firstdayofweek, p_firstweekofyear);
}

function isDate(p_Expression){
    return !isNaN(new Date(p_Expression));        // <<--- this needs checking
}

//-->
</script>
