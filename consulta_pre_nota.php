<? include("inc/headerI.inc.php"); 
verifyAcess("CLINFEEMITIR","S");
	if (trim($_GET['Id'])) {
			$Sql = "SELECT RAR_PRENF.*, ".
			               " concat(substr(P.cgccpf,1,2),'.',substr(P.cgccpf,3,3),'.',substr(P.cgccpf,6,3),'/',substr(P.cgccpf,9,4), '-',substr(P.cgccpf,13,2)) as CNPJ, ".
			               " date_format(PRENF_DATA_INFNFDEVOLUCACAO,'%d/%m/%Y') DATANF, ".
						   " date_format(PRENF_INATIVADO_DATA,'%d/%m/%Y') DATA_INATIVACAO, ".
						   " PRENF_OBSTRANSPORTADORA, ".
						   " ROUND(PRENF_QTDEVOLUME,0) AS QTDEVOLUME, ".
						   " CONCAT(ROUND(PRENF_ICMS*100,0),'%') AS ICMS, ".
					       " PD.NOME NOMECLIENTE, ".
						   " PD.PESSOA CLIENTE, ".
						   " PRENF_CFOP, ".
						   " P.NOME, ".
						   " P.IE AS INSCRICAOESTADUAL,".
						   " P.CEP AS CEP,".
						   " P.LOGRADOURO RUA, ".
						   " P.BAIRRO, ".
						   " P.CEP, ".
						   " PD.SUFR_BENF_ICMS SUFRAMA, ". 
					       " (SELECT ROUND(SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALORTOTAL ".
						   "    FROM rar_prenf_item ".
					       "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".
						   "GROUP BY PRENF_PESSOA_EMITENTE) VALORTOTAL, ".
					       " (SELECT ROUND((SUM(PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO) * PRENF_ICMS),2) VALORICMS ".
						   "    FROM rar_prenf_item ".
					       "   WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF ".
						   "GROUP BY PRENF_PESSOA_EMITENTE) VALORICMS, ".
					       " O.DS_OPER, ".
						   " P.NM_MUNICIPIO CIDADE, ".
						   " P.SG_UF UF, PRENF_MOTIVODEVOLUCAO ".
					" FROM rar_prenf, pessoa P, pessoa PD, operacao O".
					" WHERE PRENF_PESSOA_EMITENTE = P.PESSOA ".
					"      AND CD_OPER = PRENF_OPER_IDO".
					"      AND PD.PESSOA = PRENF_PESSOA_DESTINATARIO ".
					"      AND PRENF_NUMPRENF = '" .$_GET['Id']. "'";

		$Stmt = mysql_query($Sql);
		$ID = $_GET["Id"];
		$DESTINO = $_GET["Destino"];
		$cliente = $_GET["cliente"];
		$Rs = mysql_fetch_assoc($Stmt);
		$PRENF_MOTIVODEVOLUCAO = $Rs["PRENF_MOTIVODEVOLUCAO"];
		$PRENF_STATUS = $Rs["PRENF_STATUS"];
		
		$Sql = "SELECT RAR_USUARIO.* ".
					" FROM RAR_USUARIO".
					" WHERE USUAR_IDO = '" .$Rs['PRENF_INATIVADO_USUARIO']. "'";

		$Stmt2 = mysql_query($Sql);
		$RsU = mysql_fetch_assoc($Stmt2);
		$Usuario = $RsU["USUAR_NOME"];
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
<link href="wfa.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.style3 {color: #FFFFFF}
-->
</style>
<body onLoad="MM_preloadImages('imagens/cancelar2.jpg')">
<form name="form" method="post" action="#">
<input type="hidden" name="ID" value="<?=$ID?>">
<input type="hidden" name="DESTINO" value="<?=$DESTINO?>">
<tr>
    <td height="100%" valign="top" class="tab_conteudo">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td height="32" class="tab_titulo"><h4>Consulta de pr&eacute;-nota</h4></td>
      </tr>
      </table>
	  
     <table width="100%"  border="0" class="tab_cadastro">
       <tr>
         <td width="20%" class=""><strong>C&oacute;digo</strong></td>
         <td width="29%"><input name="CODPESSOA" type="text" class="form" id="CODPESSOA" value="<?=$Rs["CLIENTE"]?>" size="6" maxlength="6" readonly>
          <input name="PESSOA" type="hidden" class="form" id="PESSOA" value="<?=$Rs["CLIENTE"]?>" size="6" maxlength="6" readonly></td>
         <td colspan="2" class=""><div align="right"><strong>N&ordm; Pr&eacute;-Nota</strong></div></td>
         <td colspan="3"><input name="textfield3" type="text" class="form" value="<?=$Rs["PRENF_NUMPRENF"]?>" size="10" maxlength="10" readonly></td>
        </tr>
       <tr>
         <td class=""><strong>Nome Cliente</strong></td>
         <td colspan="6"><input name="textfield2" type="text" class="form" value="<?=$Rs["NOMECLIENTE"]?>" size="50" maxlength="50" readonly></td>
       </tr>
	   <? if ($PRENF_MOTIVODEVOLUCAO != ""){ ?>
		   <tr>
		     <td height="25" colspan="7" class=""><table width="70%"  border="0" align="center" class="">
               <tr>
                 <td colspan="2" class="tab_titulo"><div align="center" class=""><strong>NOTA FISCAL DEVOLVIDA</strong></div></td>
               </tr>
               <tr>
                 <td width="14%" class="tab_usuarios"><div align="left"><strong>Motivo:</strong></div></td>
                 <td width="86%" class="tab_usuarios_info"><?=$PRENF_MOTIVODEVOLUCAO?></td>
               </tr>
             </table></td>
        </tr>
		<? } ?>
		<? if ($PRENF_STATUS == "I"){ ?>
		   <tr>
		     <td height="25" colspan="7" class="">
			 
			 <table width="70%"  border="0" align="center" class="">
               <tr>
                 <td colspan="2"><div align="center" class="tab_titulo"><strong>PR&Eacute;-NOTA INATIVA</strong></div></td>
               </tr>
               <tr>
                 <td width="25%" class="tab_usuarios"><div align="left"><strong>Data da inativa&ccedil;&atilde;o:</strong></div></td>
                 <td width="75%" class="tab_usuarios_info"><?=$Rs["DATA_INATIVACAO"]?></td>
               </tr>
			   <? if ($cliente !="S"){?>
				   <tr>
					 <td width="25%" class="tab_usuarios"><strong>Usu&aacute;rio respons&aacute;vel: </strong></td>
					 <td width="75%" class="tab_usuarios_info"><?=$Usuario?></td>
				   </tr>
			   <? } ?>
             </table></td>
        </tr>
		<? } ?>
       <tr class="">
         <td height="25" colspan="7" class="tab_titulo"><strong>Dados da NF de devolu&ccedil;&atilde;o</strong></td>
        </tr>
       <tr>
         <td class=""><strong>N&ordm; NF devolu&ccedil;&atilde;o*</strong></td>
         <td><input name="PRENF_NUMNFDEVOLUCAO" type="text" class="form" id="PRENF_NUMNFDEVOLUCAO" value="<?=$Rs["PRENF_NUMNFDEVOLUCAO"]?>" size="20" maxlength="5" readonly></td>
         <td colspan="2" class=""><div align="right"><strong>N&ordm; s&eacute;rie*</strong></div></td>
         <td colspan="3"><input name="PRENF_SERIE" type="text" class="form" id="PRENF_SERIE" value="<?=((trim($Rs["PRENF_SERIE"])) ? $Rs["PRENF_SERIE"] : "U")?>" size="11" maxlength="3" readonly></td>
       </tr>
       <tr>
         <td class=""><strong>Data NF devolu&ccedil;&atilde;o*</strong></td>
         <td colspan="6"><input name="PRENF_DATA_INFNFDEVOLUCAO" type="text" class="form" id="PRENF_DATA_INFNFDEVOLUCAO" onKeyPress="return JSUtilApenasNumero(event);" onKeyUp="JSUtilMascara(this,event,'__/__/____');" value="<?=$Rs["DATANF"]?>" size="11" maxlength="11" readonly></td>
       </tr>
       <tr>
         <td class=""><strong>CFOP</strong></td>
         <td colspan="6"><span class="">
           <input name="textfield2323222" type="text" class="form" value="<?=$Rs["PRENF_CFOP"].' - '.$Rs["DS_OPER"]?>" size="80" maxlength="80" readonly>
         </span></td>
       </tr>
       <tr>
         <td class=""><strong>Destinat&aacute;rio</strong></td>
         <td colspan="6"><input name="ADFDF" type="text" class="form" id="ADFDF" value="<?=$Rs["NOME"]?>" size="80" maxlength="80" readonly></td>
       </tr>
       <tr>
         <td class=""><strong>Endere&ccedil;o</strong></td>
         <td colspan="2"><input name="textfield23" type="text" class="form" value="<?=$Rs["RUA"]?>" size="50" maxlength="30" readonly>           <div align="right"></div></td>
         <td width="7%" class=""><div align="right"><strong>Bairro</strong></div></td>
         <td colspan="3"><input name="textfield232" type="text" class="form" value="<?=$Rs["BAIRRO"]?>" size="40" maxlength="40" readonly></td>
       </tr>
       <tr>
         <td class=""><strong>Cidade</strong></td>
         <td><input name="textfield2322" type="text" class="form" value="<?=$Rs["CIDADE"]?>" size="20" maxlength="20" readonly></td>
         <td colspan="2" class=""><div align="right"><strong>UF</strong></div></td>
         <td width="3%"><input name="textfield23232" type="text" class="form" value="<?=$Rs["UF"]?>" size="4" maxlength="2" readonly>
         </td>
         <td width="7%"  class=""><div align="right"><strong>CEP</strong></div></td>
         <td width="25%"><input name="textfield232322" type="text" class="form" value="<?=$Rs["CEP"]?>" size="10" maxlength="10" readonly></td>
       </tr>
       <tr>
         <td class=""><strong>CNPJ</strong></td>
         <td><input name="ADFDF" type="text" class="form" id="ADFDF" value="<?=$Rs["CNPJ"]?>" size="20" maxlength="18" readonly></td>
         <td colspan="2"><div align="right" class=""><strong>Inscri&ccedil;&atilde;o estadual </strong></div></td>
         <td colspan="3"><input name="ADFDF2" type="text" class="form" id="ADFDF2" value="<?=$Rs["INSCRICAOESTADUAL"]?>" size="30" maxlength="30" readonly></td>
       </tr>
       <tr>
         <td class=""><strong>Qtde volumes*</strong></td>
         <td class=""><input name="PRENF_QTDEVOLUME" type="text" class="form" id="PRENF_QTDEVOLUME" onKeyPress="return JSUtilApenasNumero(event);" value="<?=$Rs["QTDEVOLUME"]?>" size="3" maxlength="3" readonly>
         </td>
         <td colspan="2" class=""><div align="right"></div></td>
         <td colspan="3" class="">&nbsp;</td>
       </tr>
       <tr>
         <td valign="top" class=""><strong>Observa&ccedil;&otilde;es para transportadora</strong></td>
         <td colspan="6" class=""><textarea name="PRENF_OBSTRANSPORTADORA" cols="100%"  readonly rows="5" class="text" id="PRENF_OBSTRANSPORTADORA"><?=$Rs["PRENF_OBSTRANSPORTADORA"]?></textarea></td>
        </tr>
       <tr>
         <td colspan="7">
           <div align="center"></div></td>
       </tr>
       <tr class="">
         <td height="30" colspan="7" class="tab_titulo"><div align="left"><strong>Listagens dos produtos da pr&eacute;-nota</strong></div></td>
       </tr>
       <tr>
         <td colspan="7"><table width="100%"  border="0" align="center">
           <tr class="tab_usuarios" >
             <td width="17%" ><div align="center">Refer&ecirc;ncia</div></td>
             <td width="19%" ><div align="left">Descri&ccedil;&atilde;o</div></td>
             <td width="10%" ><div align="center">N&ordm; RAR</div></td>
             <td width="9%" ><div align="center">NF/S&eacute;rie Origem</div></td>
             <td width="9%" ><div align="center">Class. fiscal</div></td>
             <td width="6%" ><div align="center">U.M.</div></td>
             <td width="6%" ><div align="center">Qtde</div></td>
             <td width="9%" ><div align="center">Valor Unit.</div></td>
             <td width="9%" ><div align="center">Valor Total</div></td>
             <td width="7%" ><div align="center">% ICMS </div></td>
           </tr>
<? 
	$Sql = "SELECT PRENFI_CLASSIFICACAOFISCAL, ".
	             " concat(substring(PRENFI_REFERENCIA,1,4),'-',substring(PRENFI_REFERENCIA,5,4),'-',substring(PRENFI_REFERENCIA,9,4),'-',substring(PRENFI_REFERENCIA,13,4)) PRENFI_REFERENCIA, ".
				 " PRENFI_UNIDADE, ".
				 " ROUND(PRENFI_QUANTIDADE,0) AS PRENFI_QUANTIDADE,  ".
				 " ROUND(PRENFI_VALORUNITARIO,2) VALOR_UNITARIO,  ".
				 " ROUND((PRENFI_QUANTIDADE * PRENFI_VALORUNITARIO),2) VALOR,  ".
				 " ITEM_NF NF,  ".
				 " DS_RESUMIDA_ITEM DESCRICAO,  ".
				 " ITEM_SERIE SERIE,  ".
				 " ITEM_NUMRAR NUMRAR ".
		    " FROM rar_prenf_item, rar_item, item_material ".
			"WHERE PRENFI_NUMPRENF = '" .$ID. "'".
			"      AND PRENFI_REFERENCIA = CD_ITEM_MATERIAL ".
			"      AND LANCA_NUMRAR = ITEM_NUMRAR".
			" ORDER BY LANCA_NUMRAR";
	$Stmt2 = mysql_query($Sql);

	while($RsI = mysql_fetch_assoc($Stmt2)) { ?>
           <tr valign="top" bordercolor="#00CCFF" class="tab_usuarios_info">
             <td><div align="center"><?=$RsI["PRENFI_REFERENCIA"]?></div></td>
             <td><?=$RsI["DESCRICAO"]?></td>
             <td><div align="center"><?=$RsI["NUMRAR"]?></div></td>
             <td><?=$RsI["NF"]."/".$RsI["SERIE"]?></td>
             <td width="11%"><div align="center"><?=$RsI["PRENFI_CLASSIFICACAOFISCAL"]?></div></td>
			 <td width="6%"><div align="center"><?=$RsI["PRENFI_UNIDADE"]?></div></td>
             <td width="6%"><div align="right"><?=$RsI["PRENFI_QUANTIDADE"]?></div></td>
             <td width="9%"><div align="right"><?=formatCurrency($RsI["VALOR_UNITARIO"])?></div></td>
             <td width="9%" align="right"><?=formatCurrency($RsI["VALOR"])?></td>
             <td width="7%" align="right"><?=$Rs["ICMS"]?></td>
           </tr>
<? } ?>
         </table></td>
       </tr>
       <tr>
         <td colspan="7"><table width="100%"  border="0" align="center">
           <tr class="">
             <td width="20%" >
               <div align="right" class="">Base c&aacute;lculo ICMS </div></td>
             <td width="10%" ><div align="left"><span class="">
                   <input name="textfield2323222223" type="text" disabled class="form" value="<?=formatCurrency($Rs["VALORTOTAL"])?>" size="10" maxlength="20" readonly>
             </span></div></td>
             <td width="25%" a href="cad_defeitos.htm"><div align="right"><strong>Valor do ICMS</strong></div></td>
             <td width="11%" a href="cad_defeitos.htm"><div align="left"><span class="">
                   <input name="txt" type="text" disabled class="form" id="txt2" value="<?=formatCurrency($Rs["VALORICMS"])?>" size="10" maxlength="20" readonly>
             </span></div></td>
             <td width="30%" a href="cad_defeitos.htm"><div align="right"><strong>Valor total dos produtos</strong></div></td>
             <td width="11%" a href="cad_defeitos.htm"><div align="left"><span class="">
                 <input name="textfield232322222" type="text" disabled class="form" value="<?=formatCurrency($Rs["VALORTOTAL"])?>" size="10" maxlength="20" readonly>
             </span></div></td>
           </tr>
		   
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
		   		   
           <tr class="listagem">
             <td >&nbsp;</td>
             <td >&nbsp;</td>
             <td a href="cad_defeitos.htm">&nbsp;</td>
             <td a href="cad_defeitos.htm">&nbsp;</td>
             <td a href="cad_defeitos.htm"><div align="right" class="style1">Valor total da NF</div></td>
             <td a href="cad_defeitos.htm"><div align="left"><span class="style1">
                   <input name="textfield2323222222" type="text" disabled class="form" value="<?=formatCurrency($ValorTotal)?>" size="10" maxlength="20">
             </span></div></td>
           </tr>
         </table>
		 <?
		 if ($Rs["SUFRAMA"] == "S"){
		 ?>
           <table width="100%"  border="0" align="center">
             <tr>
               <td width="107%" class=""><div align="center" class="listagem_autorgerada style1">Mencionar o texto abaixo no campo de observa&ccedil;&otilde;es da nota fiscal:<br>
                Desconto referente ao ICMS (Zona Franca): <?=$RsIcms["aliq_icms"]*100?>%</div></td>
              </tr>
           </table>           
		   <?
		   }
		   ?>		   <p align="center"><a href="javascript: voltar();"><img src="../img/bts/cancelar.jpg" alt="Cancelar grava&ccedil;&atilde;o dos dados" name="Image361" border="0" id="Image361"></a></p></td>
       </tr>
     </table>
</form>

<script language="javascript" type="text/javascript">
<!--
function voltar(){
	switch (document.form.DESTINO.value){
		case "1":
			document.location.href = "pesq_retaguarda_prenota.php";
			break;
		case "2":
			document.location.href = "pesq_prenf_inativa.php?cliente=<?=$cliente?>";
			break;
		case "3":
			document.location.href = "pesq_prenf_logemail.php";
			break;
		default:
			document.location.href = "pesq_nf_emitir.php";
			break;
	}
		
	/*if (document.form.DESTINO.value == "1"){
		document.location.href = "pesq_retaguarda_prenota.php";
	}else{
		if (document.form.DESTINO.value == "2"){
			document.location.href = "pesq_prenf_inativa.php?cliente=<?=$cliente?>";
		}else{
			document.location.href = "pesq_nf_emitir.php";
		}
	}*/
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
		hoje=new Date(); 
		hoje=""+ hoje.getDate()+"/"+(hoje.getMonth()+1)+"/"+hoje.getYear(); 
		if (DateDiff('d',hoje,formObj.PRENF_DATA_INFNFDEVOLUCAO.value) > 0) {
			alert("O campo \"Data NF devolução\" não pode conter uma data superior a data de hoje !");
			return;
		}
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