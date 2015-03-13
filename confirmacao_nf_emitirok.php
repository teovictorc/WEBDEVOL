<? include("inc/conn.inc.php"); 

	verifyAcess("CLINFEEMITIR","S");
	$Sql = "SELECT * FROM rar_prenf ".
			"WHERE PRENF_PESSOA_DESTINATARIO = '" .$_POST['PESSOA']. "'".
			"      AND PRENF_NUMNFDEVOLUCAO = '" .$_POST['PRENF_NUMNFDEVOLUCAO']. "'".
			"      AND PRENF_SERIE = '" .$_POST['PRENF_SERIE']. "'";
	$Stmt = mysql_query($Sql);
	if ($Rs = mysql_fetch_assoc($Stmt))
		die('<script>alert("Já existe uma nota fiscal com este número + série informada para este código de cliente !\nFavor informar outro número de nota fiscal + Série.");history.go(-1);</script>');

	if (trim($_POST['ID'])) {
			$Sql = "UPDATE rar_prenf SET ".
					"PRENF_NUMNFDEVOLUCAO = '" .$_POST['PRENF_NUMNFDEVOLUCAO']. "',  ".
					"PRENF_SERIE = '" .$_POST['PRENF_SERIE']. "',  ".
					"PRENF_MOTIVODEVOLUCAO = Null,  ".
					"PRENF_DATA_INFNFDEVOLUCACAO = '" .formatadata($_POST['PRENF_DATA_INFNFDEVOLUCAO']). "',  ".
					"PRENF_DATA_NFDEVOLUCAO = NOW(),  ".
					"PRENF_DATA_SOLIC_COLETA = NOW(), ".
					"PRENF_DATA_RECEBTO_COLETA = NOW(), ".
					"PRENF_QTDEVOLUME = '" .$_POST['PRENF_QTDEVOLUME']. "',  ".
					"PRENF_OBSTRANSPORTADORA = '" .str_replace("'","''",$_POST['PRENF_OBSTRANSPORTADORA']). "'  ".
					"WHERE PRENF_NUMPRENF = '" .$_POST['ID']. "'";
		$Stmt = mysql_query($Sql);
	}

	$DiasSemanas['S'] = "segunda-feira";
	$DiasSemanas['T'] = "terça-feira";
	$DiasSemanas['Q'] = "quarta-feira";
	$DiasSemanas['I'] = "quinta-feira";
	$DiasSemanas['X'] = "sexta-feira";
	$DiasSemanas['B'] = "sabado";
	$DiasSemanas['D'] = "domingo";

	$Sql = "SELECT PD.PESSOA CODIGO_CLIENTE, PD.NOME NOME_CLIENTE, ".
			"CLIEN_COL_ENDER C_ENDERECO,CLIEN_COL_BAIRRO C_BAIRRO, ".
			"CLIEN_COL_CIDADE C_CIDADE, CLIEN_COL_UF C_UF, PD.CEP C_CEP,  ".
			"CLIEN_COL_DIAINI C_DIAI, CLIEN_COL_DIAFIM C_DIAF, ".
			"date_format(CLIEN_COL_HRINI,'%h:%i') C_HORAI, date_format(CLIEN_COL_HRFIM,'%h:%i') C_HORAF, ".
			"PE.NOME D_NOME, PE.LOGRADOURO D_ENDERECO, ".
			"PE.BAIRRO D_BAIRRO, PE.NM_MUNICIPIO D_CIDADE, ".
			"PE.SG_UF D_UF, PE.CEP D_CEP, ".
			"PRENF_NUMNFDEVOLUCAO NNF, PRENF_QTDEVOLUME VOLUME, ".
			"PRENF_OBSTRANSPORTADORA OBS, ROUND(PRENF_QTDEVOLUME * 0.75,2) PESO, ".
			"(SELECT SUM(PRENFI_QUANTIDADE) QTDE FROM rar_prenf_item  ".
			"	WHERE PRENFI_NUMPRENF = PRENF_NUMPRENF GROUP BY PRENF_PESSOA_EMITENTE) QTDE ".
			"FROM rar_prenf, pessoa PD, rar_cliente_coleta, pessoa PE ".
			"WHERE PRENF_PESSOA_DESTINATARIO = PD.PESSOA  ".
			"AND CLIEN_COL_PESSOA = PRENF_PESSOA_DESTINATARIO ".
			"AND PRENF_PESSOA_DESTINATARIO = PE.PESSOA ".
			"AND PRENF_NUMPRENF = '" .$_POST['ID']. "'";
			
	$Stmt = mysql_query($Sql);
	if ($Rs = mysql_fetch_assoc($Stmt)) {
		$Html = "<html>";
		$Html.= "<head>";
		$Html.= "<title>Email Solicita&ccedil;&atilde;o de Coleta WEBDevol</title>";
		$Html.= "<meta http-equiv='Content-Type' content='text/html; charset=iso-8859-1'>";
		$Html.= "<style type='text/css'>";
		$Html.= "<!--";
		$Html.= "body {";
		$Html.= "	margin-left: 0px;";
		$Html.= "	margin-top: 0px;";
		$Html.= "	margin-right: 0px;";
		$Html.= "	margin-bottom: 0px;";
		$Html.= "}";
		$Html.= ".style1 {";
		$Html.= "	font-family: tahoma;";
		$Html.= "	font-weight: bold;";
		$Html.= "	font-size: 12px;";
		$Html.= "	border: 1px solid #333333;";
		$Html.= "}";
		$Html.= ".style2 {color: #FF0000}";
		$Html.= ".style3 {font-size: 12px; font-family: tahoma;}";
		$Html.= ".style5 {";
		$Html.= "	font-size: 11px;";
		$Html.= "	font-weight: bold;";
		$Html.= "}";
		$Html.= ".style6 {font-size: 10px; font-family: tahoma; }";
		$Html.= ".style7 {font-size: 11px}";
		$Html.= ".style8 {color: #FFFFFF}";
		$Html.= ".style9 {font-family: tahoma; font-weight: bold; font-size: 12px; border: 1px solid #333333; color: #FFFFFF; }";
		$Html.= ".style10 {font-size: 11px; font-family: tahoma; }";
		$Html.= "-->";
		$Html.= "</style>";
		$Html.= "</head>";
		$Html.= "<body>";
		$Html.= "<table width='100%'  border='0'>";
		$Html.= "  <tr bordercolor='#000000' class='style1'>";
		$Html.= "    <td height='30' colspan='6'><p align='center' class='style1'>Solicita&ccedil;&atilde;o de Coleta WEBDevol</p></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr>";
		$Html.= "    <td width='24%' class='style1'>N&uacute;mero da autoriza&ccedil;&atilde;o</td>";
		$Html.= "    <td width='26%' class='style1 style2'><div align='center'>" .$_POST['ID']. "</div></td>";
		$Html.= "    <td width='25%'>&nbsp;</td>";
		$Html.= "    <td width='25%' colspan='3'>&nbsp;</td>";
		$Html.= "  </tr>";
		$Html.= "  <tr bgcolor='#003399'>";
		$Html.= "    <td colspan='6'><p class='style1 style8'>:: Dados do remetente</p>    </td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td class='style3 style5 style7'>C&oacute;digo da loja</td>";
		$Html.= "    <td colspan='5'><span class='style7'>" .$Rs["CODIGO_CLIENTE"]. "</span></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td class='style6'><span class='style5'>Nome do cliente </span></td>";
		$Html.= "    <td colspan='5'><span class='style7'>" .$Rs["NOME_CLIENTE"]. "</span></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td class='style6'><span class='style5'>Fone</span></td>";
		$Html.= "    <td colspan='5'><span class='style7'>-- IMPOSSIVEL --</span></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr>";
		$Html.= "    <td>&nbsp;</td>";
		$Html.= "    <td>&nbsp;</td>";
		$Html.= "    <td>&nbsp;</td>";
		$Html.= "    <td colspan='3'>&nbsp;</td>";
		$Html.= "  </tr>";
		$Html.= "  <tr bgcolor='#003399'>";
		$Html.= "    <td colspan='6' class='style9'>:: Dados para coleta</td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td class='style3'><span class='style7'><strong>Endere&ccedil;o</strong></span></td>";
		$Html.= "    <td colspan='5'><span class='style7'>" .$Rs["C_ENDERECO"]. "</span></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td class='style3'><span class='style7'><strong>Bairro</strong></span></td>";
		$Html.= "    <td colspan='5'><span class='style7'>" .$Rs["C_BAIRRO"]. "</span></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td class='style3'><span class='style5'>Cidade</span></td>";
		$Html.= "    <td colspan='5'><span class='style7'>" .$Rs["C_CIDADE"]. "</span></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td class='style3'><span class='style7'><strong>UF</strong></span></td>";
		$Html.= "    <td colspan='5'><span class='style7'>" .$Rs["C_UF"]. "</span></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td class='style3'><span class='style7'><strong>CEP</strong></span></td>";
		$Html.= "    <td colspan='5'><span class='style7'>" .$Rs["C_CEP"]. "</span></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr>";
		$Html.= "    <td class='style3'><span class='style7'><strong>Dias para coleta</strong></span></td>";
		$Html.= "    <td colspan='5' class='style10'>De: " .$DiasSemanas[$Rs["C_DIAI"]] ." a ". $DiasSemanas[$Rs["C_DIAF"]]. " </td>";
		$Html.= "  </tr>";
		$Html.= "  <tr>";
		$Html.= "    <td class='style3'><span class='style7'><strong>Hor&aacute;rio para coleta </strong></span></td>";
		$Html.= "    <td colspan='5' class='style10'>Das " .$Rs["C_HORAI"]. " &agrave;s " .$Rs["C_HORAF"]. " </td>";
		$Html.= "  </tr>";
		$Html.= "  <tr>";
		$Html.= "    <td>&nbsp;</td>";
		$Html.= "    <td>&nbsp;</td>";
		$Html.= "    <td>&nbsp;</td>";
		$Html.= "    <td colspan='3'>&nbsp;</td>";
		$Html.= "  </tr>";
		$Html.= "  <tr>";
		$Html.= "    <td colspan='6' bgcolor='#003399' class='style9'>:: Dados do destinat&aacute;rio</td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td><span class='style7'><strong>Nome do destinat&aacute;rio</strong></span></td>";
		$Html.= "    <td colspan='5'><span class='style7'>" .$Rs["D_NOME"]. "</span></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td><span class='style7'><strong>Endere&ccedil;o</strong></span></td>";
		$Html.= "    <td colspan='5'><span class='style7'>" .$Rs["D_ENDERECO"]. "</span></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td><span class='style7'><strong>Bairro</strong></span></td>";
		$Html.= "    <td colspan='5'><span class='style7'>" .$Rs["D_BAIRRO"]. "</span></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td><span class='style7'><strong>Cidade</strong></span></td>";
		$Html.= "    <td colspan='5'><span class='style7'>" .$Rs["D_CIDADE"]. "</span></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td><span class='style7'><strong>UF</strong></span></td>";
		$Html.= "    <td colspan='5'><span class='style7'>" .$Rs["D_UF"]. "</span></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td><span class='style7'><strong>CEP</strong></span></td>";
		$Html.= "    <td colspan='5'><span class='style7'>" .$Rs["D_CEP"]. "</span></td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td>&nbsp;</td>";
		$Html.= "    <td colspan='5'>&nbsp;</td>";
		$Html.= "  </tr>";
		$Html.= "  <tr bgcolor='#003399'>";
		$Html.= "    <td colspan='6' class='style9'>:: Dados da mercadoria</td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td><span class='style7'><strong>Tipo de mercadoria</strong></span></td>";
		$Html.= "    <td colspan='2'><span class='style7'>Cal&ccedil;ado</span></td>";
		$Html.= "    <td colspan='3'>&nbsp;</td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td><span class='style7'><strong>N&ordm; NF</strong></span></td>";
		$Html.= "    <td colspan='2'><span class='style7'>" .$Rs["NNF"]. "</span></td>";
		$Html.= "    <td colspan='3'>&nbsp;</td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td><span class='style7'><strong>Peso</strong></span></td>";
		$Html.= "    <td colspan='2'><span class='style7'>" .$Rs["PESO"]. " kg </span></td>";
		$Html.= "    <td colspan='3'>&nbsp;</td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td><span class='style7'><strong>Quantidade de pares</strong></span></td>";
		$Html.= "    <td colspan='2'><span class='style7'>" .$Rs["QTDE"]. "</span></td>";
		$Html.= "    <td colspan='3'>&nbsp;</td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td><span class='style7'><strong>Volume</strong></span></td>";
		$Html.= "    <td colspan='2'><span class='style7'>" .$Rs["VOLUME"]. "</span></td>";
		$Html.= "    <td colspan='3'>&nbsp;</td>";
		$Html.= "  </tr>";
		$Html.= "  <tr class='style3'>";
		$Html.= "    <td><span class='style7'><strong>Observa&ccedil;&otilde;es</strong></span></td>";
		$Html.= "    <td colspan='2'><span class='style7'>" .$Rs["OBS"]. "</span></td>";
		$Html.= "    <td colspan='3'>&nbsp;</td>";
		$Html.= "  </tr>";
		$Html.= "</table>";
		$Html.= "</body>";
		$Html.= "</html>";
	}


?>

<script language='JavaScript' type='text/JavaScript'>
<!--	
	function abrir_janela_popup(theURL,winName,features) { //v2.0
		window.open(theURL,winName,features);
	}

	abrir_janela_popup('imp_prenota.php?Id=<?=$_POST['ID']?>','prenota','width=800,height=540,top=0,left=0, scrollbars=yes,status=yes,resizable=yes,dependent=yes');	
	document.location.href = "pesq_nf_emitir.php";

//-->

</script>

