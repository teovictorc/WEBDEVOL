<? $Title = "Gerenciamento de etapas";

	include("inc/top_imp.inc.php"); 



	$SQL = "select LANCA_NUMRAR, NOME, date_format(LANCA_DATAABERTURA,'%d/%m/%Y') LANCA_DATAABERTURA,";

	$SQL.= "       date_format(AVALI_AREZ_DATA,'%d/%m/%Y') AVALI_AREZ_DATA, AVALI_SITUACAO ";

	$SQL.= " from rar_lancamento L, pessoa C, rar_avaliacao A, rar_item I";

	$SQL.= " where L.lanca_PESSOA = C.PESSOA ";

	$SQL.= "       and L.lanca_numrar = I.item_numrar ";

	$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

	$SQL.= "       and L.lanca_status <> '4'";

	if ($_SESSION["Menu"] == "3"){

		$SQL.= "    and L.lanca_numrar like 'M%'";

	}else{

		$SQL.= "    and L.lanca_numrar not like 'M%'";

	}

	$SQL.= "      " .$SqlCriterios;

	$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

	$SQL.= " order by L.LANCA_DATAABERTURA, nome, lanca_numrar";

	//die($SQL);

	$Stmt = mysql_query($SQL);

?>

<!-- Objeto de controle de impressão de relatorios -->

<!-- MeadCo ScriptX Control -->



<object id="factory" style="display:none" viewastext

classid="clsid:1663ed61-23eb-11d2-b92f-008048fdd814"

codebase="ScriptX.cab#Version=5,60,0,360">

</object>

<script defer>

//(Header, Footer, Margins & Orientation) nesta versao so funciona

function window.onload() {

  factory.printing.header = "WFAWeb - Relatório de Gerenciamento de Etapas"

  factory.printing.footer = "<?=$Title." - ".$Categoria?>"

  //true=potrait false=landscape

  factory.printing.portrait = false

}

</script>

<script>

function abrirDetalhe(NumPreNF){

	abrir_janela_popup('rel_gerenciamento_detalhe.php?ID='+NumPreNF,'popup_nf','width=600,height=500,top=0,left=0, scrollbars=yes,status=no,resizable=no,dependent=yes');

}

function abrir_janela_popup(theURL,winName,features) {

	window.open(theURL,winName,features);

}



function ConsultarReclamacao(NumRar){

	abrir_janela_popup('rel_consulta_reclamacao.php?Id='+NumRar,'ConsultaReclamacao','width=750,height=540,top=0,left=0, scrollbars=yes,status=yes,resizable=yes,dependent=yes');

}

</script>



<table width="100%" border="0" cellpadding="0" cellspacing="1">

  <tr>

    <td width="10%" class="imp_normal_total"><div align="center"><strong>N&ordm; RAR </strong></div></td>

    <td width="26%" class="imp_normal_total"><div align="left"><strong>Cliente</strong></div></td>

    <td width="7%" class="imp_normal_total"><div align="center"><strong>Abertura</strong></div></td>

    <td width="7%" class="imp_normal_total"><div align="center"><strong>Avalia&ccedil;&atilde;o</strong></div></td>

    <td width="7%" class="imp_normal_total"><div align="center"><strong>Pr&eacute;-Nota</strong></div></td>

    <td width="7%" class="imp_normal_total"><div align="center"><strong>NF Devolu&ccedil;&atilde;o</strong></div></td>

    <td width="7%" class="imp_normal_total"><div align="center"><strong>Data preench. NF </strong></div></td>

    <td width="7%" class="imp_normal_total"><div align="center"><strong>Solicita&ccedil;&atilde;o<br>Coleta</strong></div></td>

    <td width="7%" class="imp_normal_total"><div align="center"><strong>Coleta Cliente</strong></div></td>

    <td width="7%" class="imp_normal_total"><div align="center"><strong>Chegada Transp. </strong></div></td>

	<?

	if (substr($_POST["LANCA_CATEGORIA"],0,1) == "2"){

		$Titulo1 = "Chegada Fornecedor";

		$Titulo2 = "Informado crédito";

	}else{

		$Titulo1 = "Chegada Andarella";

		$Titulo2 = "Importação Sistema Andarella";

	}
	
	$Titulo1 = "Chegada Fornecedor";

		$Titulo2 = "Informado crédito";

	?>

    <td width="7%" class="imp_normal_total"><div align="center"><strong><?=$Titulo1?></strong></div></td>

    <td width="8%" class="imp_normal_total"><div align="center"><strong><?=$Titulo2?></strong></div></td>

    <td width="7%" class="imp_normal_total"><div align="center"><strong>Cr&eacute;dito concedido</strong></div></td>

  </tr>

<?  



	$TotalG = 0;

	while($Rs = mysql_fetch_assoc($Stmt)){

		if ($Rs["AVALI_SITUACAO"] == "I"){

			$AUTOR_DATAAUTORIZACAO= "<img src='imagens/improcedente.gif' width='15' height='15'>";

			$PRENF_DATA_INFNFDEVOLUCACAO= "<img src='imagens/improcedente.gif' width='15' height='15'>";

			$PRENF_DATA_COLETA= "<img src='imagens/improcedente.gif' width='15' height='15'>";

			$PRENF_DATA_SOLIC_COLETA= "<img src='imagens/improcedente.gif' width='15' height='15'>";

			$CREDITO_DATA= "<img src='imagens/improcedente.gif' width='15' height='15'>";

			$PRENF_DATA_RECEBTO_COLETA= "<img src='imagens/improcedente.gif' width='15' height='15'>";

			$PRENF_DATA_RECEBTO_AREZZO= "<img src='imagens/improcedente.gif' width='15' height='15'>";

			$PRENF_DATA_IMPORT_AREZZO= "<img src='imagens/improcedente.gif' width='15' height='15'>";

			$PRENF_NUMPRENF = "<img src='imagens/improcedente.gif' width='15' height='15'>";

			$PRENF_NUMNFDEVOLUCAO = "<img src='imagens/improcedente.gif' width='15' height='15'>";

		}else{

			$SQL = "select date_format(PRENF_DATA_INFNFDEVOLUCACAO,'%d/%m/%Y') PRENF_DATA_INFNFDEVOLUCACAO,";

			$SQL.= "       date_format(PRENF_DATA_NFDEVOLUCAO,'%d/%m/%Y') PRENF_DATA_NFDEVOLUCAO,";

			$SQL.= "       date_format(PRENF_DATA_COLETA ,'%d/%m/%Y') PRENF_DATA_COLETA, ";

			$SQL.= "       date_format(PRENF_DATA_SOLIC_COLETA, '%d/%m/%Y') PRENF_DATA_SOLIC_COLETA, ";

			$SQL.= "       date_format(PRENF_DATA_RECEBTO_COLETA ,'%d/%m/%Y') PRENF_DATA_RECEBTO_COLETA, ";

			$SQL.= "       date_format(PRENF_DATA_RECEBTO_AREZZO  ,'%d/%m/%Y') PRENF_DATA_RECEBTO_AREZZO , ";

			$SQL.= "       date_format(PRENF_DATA_IMPORT_AREZZO  ,'%d/%m/%Y') PRENF_DATA_IMPORT_AREZZO, ";

			$SQL.= "       PRENF_NUMPRENF, PRENF_NUMNFDEVOLUCAO, PRENF_SERIE, PRENF_PESSOA_DESTINATARIO, ";

			$SQL.= "       PRENF_AUTOR_NUMAUT, PRENF_CATEGORIA, PRENF_PESSOA_EMITENTE ";

			$SQL.= " from rar_avaliacao, rar_prenf, rar_prenf_item, rar_lancamento l ";

			$SQL.= " where AVALI_NUMRAR = l.LANCA_NUMRAR ";

			$SQL.= "       and prenf_numprenf = prenfi_numprenf";

			$SQL.= "       and lanca_prenfi_ido = prenfi_ido";

			$SQL.= "       and l.lanca_numrar = '" . $Rs["LANCA_NUMRAR"] . "'";

			//die($SQL);

			$StmtAut = mysql_query($SQL);

			if ($Rs2 = mysql_fetch_assoc($StmtAut)){  

				$SQL = "select date_format(AUTOR_DATAAUTORIZACAO,'%d/%m/%Y') AUTOR_DATAAUTORIZACAO ";

				$SQL.= "  from rar_autorizacao ";

				$SQL.= " where AUTOR_NUMAUT  = '" . $Rs2["PRENF_AUTOR_NUMAUT"] . "'";

				$StmtAutor = mysql_query($SQL);

				if ($Rs3 = mysql_fetch_assoc($StmtAutor)){

					$AUTOR_DATAAUTORIZACAO= $Rs3["AUTOR_DATAAUTORIZACAO"];

				}else{

					$AUTOR_DATAAUTORIZACAO= "";

				}

				$PRENF_DATA_INFNFDEVOLUCACAO= $Rs2["PRENF_DATA_INFNFDEVOLUCACAO"];

				$PRENF_DATA_NFDEVOLUCAO= $Rs2["PRENF_DATA_NFDEVOLUCAO"];

				$PRENF_DATA_COLETA= $Rs2["PRENF_DATA_COLETA"];

				$PRENF_DATA_RECEBTO_COLETA= $Rs2["PRENF_DATA_RECEBTO_COLETA"];

				$PRENF_DATA_RECEBTO_AREZZO= $Rs2["PRENF_DATA_RECEBTO_AREZZO"];

				$PRENF_DATA_IMPORT_AREZZO= $Rs2["PRENF_DATA_IMPORT_AREZZO"];

				$PRENF_NUMPRENF = $Rs2["PRENF_NUMPRENF"];

				$PRENF_NUMNFDEVOLUCAO  = $Rs2["PRENF_NUMNFDEVOLUCAO"];

				$PRENF_DATA_SOLIC_COLETA = $Rs2["PRENF_DATA_SOLIC_COLETA"];

			}else{

				$AUTOR_DATAAUTORIZACAO= "";

				$PRENF_DATA_INFNFDEVOLUCACAO= "";

				$PRENF_DATA_NFDEVOLUCAO= "";

				$PRENF_DATA_COLETA= "";

				$PRENF_DATA_RECEBTO_COLETA= "";

				$PRENF_DATA_RECEBTO_AREZZO= "";

				$PRENF_DATA_IMPORT_AREZZO= "";

				$PRENF_NUMPRENF = "";

				$PRENF_NUMNFDEVOLUCAO  = "";

				$PRENF_DATA_SOLIC_COLETA = "";

			};

			

			if ($Rs2["PRENF_PESSOA_EMITENTE"] == "18800" || $Rs2["PRENF_PESSOA_EMITENTE"] == "19000") {

				$Categoria = "1,2,3,4";

			}else{

				$Categoria = $_POST['LANCA_CATEGORIA'];

			}

			//busca informacao sobre valor creditado

			$SQL = "select date_format(data_liquidacao,'%d/%m/%Y') As data_liquidacao, round(valor_pago,2) valor_pago ";

			$SQL.= " from creditos_pagos";

			$SQL.= " where pessoa = '".$Rs2["PRENF_PESSOA_DESTINATARIO"]."'";

			$SQL.= "       and num_nf ='".$Rs2["PRENF_NUMNFDEVOLUCAO"]."'";

			$SQL.= "       and categoria in (".$Categoria.")";

			//$SQL.= "       and serie_nf in ('".$Rs2["PRENF_SERIE"]."', 'U', 'UNI')";

			//die($SQL."<BR>");

			$StmtCred = mysql_query($SQL);

			if ($Rs3 = mysql_fetch_assoc($StmtCred)){

				$CREDITO_DATA  = $Rs3["data_liquidacao"];

				$CREDITO_VALOR = $Rs3["valor_pago"];

			}else{

				$CREDITO_DATA  = "";

				$CREDITO_VALOR = "";

			};

		};

		

		if ($Cor == "#DBEDF2"){

			$Cor = "#FFFFFF";

		}else{

			$Cor = "#DBEDF2";

		}

		?>

		



		<tr valign="top" bgcolor="<?=$Cor?>">

		<td align="center" class="imp_normal"><div align="center"><a href="javascript: ConsultarReclamacao('<?=$Rs["LANCA_NUMRAR"]?>')"><?=$Rs["LANCA_NUMRAR"]?></a></div></td>

		<td class="imp_normal"><?=$Rs["NOME"]?></td>

		<td width="7%" class="imp_normal"><div align="center"><?=$Rs["LANCA_DATAABERTURA"]?></div></td>

		<td width="7%" align="right" class="imp_normal"><div align="center"><?=$Rs["AVALI_AREZ_DATA"]?></div></td>

		<td width="7%" align="right" class="imp_normal"><div align="center"><?=$AUTOR_DATAAUTORIZACAO?>

		<? if ($PRENF_NUMPRENF != "" && $Rs["AVALI_SITUACAO"] != "I"){ ?>

		    <br>

	       N.&ordm;  <?=$PRENF_NUMPRENF?>

          <br>

		 <? }?>

		</div></td>

		<td width="7%" align="right" class="imp_normal"><div align="center"><?=$PRENF_DATA_INFNFDEVOLUCACAO?>

			  <? if ($PRENF_NUMNFDEVOLUCAO != "" && $Rs["AVALI_SITUACAO"] != "I"){ ?>

		  <br>

		  N&ordm; <?=$PRENF_NUMNFDEVOLUCAO?>

		  <? }?>

		</div></td>

		<td width="7%" align="center" class="imp_normal"><?=$PRENF_DATA_NFDEVOLUCAO?></td>

		<td width="7%" align="center" class="imp_normal"><?=$PRENF_DATA_SOLIC_COLETA?></td>

		<td width="7%" align="right" class="imp_normal"><div align="center"><?=$PRENF_DATA_COLETA?></div></td>

		<td width="7%" align="right" class="imp_normal"><div align="center"><?=$PRENF_DATA_RECEBTO_COLETA?></div></td>

		<td width="7%" align="right" class="imp_normal"><div align="center"><?=$PRENF_DATA_RECEBTO_AREZZO?></div></td>

		<td width="8%" align="right" class="imp_normal"><div align="center"><?=$PRENF_DATA_IMPORT_AREZZO?></div></td>

        <td width="7%" align="center" valign="middle" class="imp_normal">

		<? if ($CREDITO_DATA != "" && $Rs["AVALI_SITUACAO"] != "I"){ 

			$Link = "javascript:abrirDetalhe(".$PRENF_NUMPRENF.");";

			}?>

		  

		  <? if ($CREDITO_DATA != "" && $Rs["AVALI_SITUACAO"] != "I"){ ?>

		  	<a href="<?=$Link?>">

		  <? }?>

		  <?=$CREDITO_DATA?>

		  <? if ($CREDITO_DATA != "" && $Rs["AVALI_SITUACAO"] != "I"){ ?>

		  <br> 

		  R$		  

		  <?=$CREDITO_VALOR?>

		  <? }?>

		  <? if ($CREDITO_DATA != "" && $Rs["AVALI_SITUACAO"] != "I"){ ?>

		  	</a>

		  <? }?>

		  

		  

		  </td>

  </tr>

	<? } ?>

</table>



<table width="100%"  border="0">

  <tr>

    <th scope="col" class="imp_normal">&nbsp;</th>

    <th scope="col">&nbsp;</th>

  </tr>

  <tr>

    <th width="30%" scope="col" class="imp_normal"><div align="left"><img src="imagens/improcedente.gif" width="15" height="15"> - Reclama&ccedil;&atilde;o improcedente</div></th>

    <th width="70%" scope="col"><a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></th>

  </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>