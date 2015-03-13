<? $Title = "Fábrica x Pares";



	include("inc/top_imp.inc.php"); 

		$SQL = "select F.NOME F_NOME, F.PESSOA F_CODIGO, sum(I.item_qtde) as QTDE ";

		$SQL.= " from rar_lancamento L, pessoa F, rar_avaliacao A, rar_item I, rar_prenf_item ri ";

		$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		$SQL.= "       and L.lanca_numrar = A.avali_numrar ";

		//$SQL.= "       and ri.lanca_numrar = l.lanca_numrar ";

		$SQL.= "       and ri.prenfi_ido = L.lanca_prenfi_ido ";

		$SQL.= "       and L.lanca_status <> '4'";

		$SQL.= "       and A.AVALI_SITUACAO <> 'I'";

		$SQL.= "       and ri.prenfi_numprenf in (" .$_GET['Ids']. ")";

		$SQL.= "       and L.lanca_pessoa in (select usucli_pessoa from rar_usuarioxcliente where usucli_usuar_ido = "  .$_SESSION['sId']. ")";

		$SQL.= " group by F.NOME, F.PESSOA ";

		$SQL.= " order by QTDE DESC, F.PESSOA, F.NOME ";

		$Stmt = mysql_query($SQL);

?>

<link href="wfa.css" rel="stylesheet" type="text/css">

<link href="../css/global.css" rel="stylesheet" type="text/css">



<table width="100%" border="0" cellpadding="0" cellspacing="1">

<? $Total = 0;

	//while(ocifetch($Stmt)) {

	while($Rs = mysql_fetch_assoc($Stmt)){ 

		$SQL = "select ITEM_REFERENCIA REFERENCIA, sum(I.item_qtde) as QTDE ";

		$SQL.= " from rar_lancamento L, pessoa F, rar_item I, rar_prenf_item ri ";

		$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

		$SQL.= "       and L.lanca_numrar = I.item_numrar ";

		//$SQL.= "       and ri.lanca_numrar = l.lanca_numrar ";

		$SQL.= "       and ri.prenfi_ido = L.lanca_prenfi_ido ";

		$SQL.= "       and L.lanca_status <> '4'";

		$SQL.= "       and ri.prenfi_numprenf in (" .$_GET['Ids']. ")";

		$SQL.= "       and F.PESSOA = '" .$Rs["F_CODIGO"]. "' ";

		$SQL.= " group by item_referencia ";

		$SQL.= " order by QTDE DESC, ITEM_REFERENCIA ";

		$Stmt2 = mysql_query($SQL);

		$Total+= intval($Rs["QTDE"]); ?>

		  <tr>

			<td colspan="2" class="imp_normal"><div align="right"></div>      

			<div align="left"><strong>F&aacute;brica:&nbsp;</strong><?=$Rs["F_CODIGO"]?> - <?=$Rs["F_NOME"]?></div>      <div align="right"></div></td>

			<td class="imp_normal"><strong>Quantidade:&nbsp;</strong><?=$Rs["QTDE"]?></td>

		  </tr>

		<? while($Rs2 = mysql_fetch_assoc($Stmt2)){ ?>

		<tr>

			<td width="6%" class="imp_normal">&nbsp;</td>

			<td width="74%" class="imp_normal">Defeito:&nbsp;<?=substr($Rs2["REFERENCIA"],0,4)."-".substr($Rs2["REFERENCIA"],4,4)."-".substr($Rs2["REFERENCIA"],8,4)."-".substr($Rs2["REFERENCIA"],12,4)?></td>

			<td width="20%" class="imp_normal">Quantidade:&nbsp;<?=$Rs2["QTDE"]?></td>

		</tr>

		<?  } ?>

		<tr>

			<td class="imp_normal_bot" colspan="3">&nbsp;</td>

  </tr>

		<? } ?>

    <tr>

    <td class="imp_normal_bot" colspan="3">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="2" class="imp_normal"><div align="right"></div>      

	<div align="right"></div></td>

    <td class="imp_normal"><div align="left"><strong>Total:</strong>&nbsp;&nbsp;<?=$Total?></div></td>

  </tr>

  <tr>

    <td colspan="2" class="imp_normal">&nbsp;</td>

    <td class="imp_normal">&nbsp;</td>

  </tr>

  <tr>

    <td colspan="3" class="imp_normal"><div align="center"></div></td>

  </tr>

</table>

<table width="100%" border="0" cellpadding="0" cellspacing="1">

  <tr>

    <td colspan="4" class="imp_normal">&nbsp;</td>

    <td class="imp_normal">&nbsp;</td>

  </tr>

  <tr class="tab_usuarios">

    <td height="20" colspan="5" style="page-break-before: always;" class="imp_normal"><div align="right"></div>

        <div align="center"><strong>Listagem detalhada de Nota Fiscal x Refer&ecirc;ncia e F&aacute;brica</strong></div></td>

  </tr>

  <? $Total = 0;

	$SQL = "select ITEM_REFERENCIA REFERENCIA, F.NOME F_NOME, F.PESSOA F_CODIGO, ROUND(ITEM_QTDE,0) QTDE,";

	$SQL.= "       prenf_numnfdevolucao NF, PRENF_SERIE SERIE, C.NOME CLIENTE_NOME, C.PESSOA CLIENTE_CODIGO ";

	$SQL.= " from rar_lancamento L, pessoa F, rar_item I, rar_prenf_item ri, rar_prenf r, pessoa C";

	$SQL.= " where L.lanca_fabri_ido = F.PESSOA ";

	$SQL.= "       and L.lanca_numrar = I.item_numrar ";

	$SQL.= "       and L.lanca_pessoa = C.PESSOA ";

	//$SQL.= "       and ri.lanca_numrar = l.lanca_numrar ";

	$SQL.= "       and ri.prenfi_ido = L.lanca_prenfi_ido ";

	$SQL.= "       and L.lanca_status <> '4'";

	$SQL.= "       and ri.prenfi_numprenf in (" .$_GET['Ids']. ")";

	$SQL.= "       and ri.prenfi_numprenf = r.prenf_numprenf ";

	$SQL.= " order by 5, 2 ";

	$Stmt2 = mysql_query($SQL);

	$Total+= intval($Rs["QTDE"]); ?>

  <tr class="tab_usuarios">

    <td width="10%" height="15" class="imp_normal"><div align="center"><strong>N&deg; NF/S&eacute;rie </strong></div></td>

    <td width="35%" class="imp_normal"><strong>Cliente</strong></td>

    <td width="5%" class="imp_normal"><div align="center"><strong>Qtde</strong></div></td>

    <td width="20%" class="imp_normal"><strong>Refer&ecirc;ncia</strong></td>

    <td width="30%" class="imp_normal"><strong>F&aacute;brica</strong></td>

  </tr>

  

  <? 

  $Nf = "";

  $NfAnt = "";

  while($Rs2 = mysql_fetch_assoc($Stmt2)){ ?>

  <? 

  	$Nf = $Rs2["NF"]."/".$Rs2["SERIE"];

  	if ($Nf != $NfAnt && $NfAnt != ""){

  ?>

  	<tr class="imp_normal_bot">

    <td><div align="center" class="imp_normal_bot"></div></td>

    <td><div align="center" class="imp_normal_bot"></div></td>

    <td><div align="center" class="imp_normal_bot"></div></td>

    <td><div align="center" class="imp_normal_bot"></div></td>

    <td><div align="center" class="imp_normal_bot"></div></td>

  </tr>

  <? } 

  $NfAnt = $Nf?>

  <tr class="tab_usuarios_info">

    <td class="imp_normal"><div align="center"><?=$Rs2["NF"]?>/<?=$Rs2["SERIE"]?></div></td>

    <td class="imp_normal"><?=$Rs2["CLIENTE_CODIGO"]?>-<?=$Rs2["CLIENTE_NOME"]?></td>

    <td class="imp_normal"><div align="center"><?=$Rs2["QTDE"]?></div></td>

    <td class="imp_normal"><?=substr($Rs2["REFERENCIA"],0,4)."-".substr($Rs2["REFERENCIA"],4,4)."-".substr($Rs2["REFERENCIA"],8,4)."-".substr($Rs2["REFERENCIA"],12,4)?></td>

    <td class="imp_normal"><?=$Rs2["F_CODIGO"]?> - <?=$Rs2["F_NOME"]?></td>

  </tr>

  <?  } ?>

  <tr>

    <td colspan="5" class="imp_normal"><div align="center"></div></td>

  </tr>

  <tr>

    <td colspan="5" class="imp_normal">&nbsp;</td>

  </tr>

</table>

<? 	include("inc/bot_imp.inc.php"); ?>

<div align="center"><a href="javascript: window.print();"><img src="imagens/imprimir.jpg" alt="Clique aqui para fechar este relat&oacute;rio" width="52" height="22" border="0" ></a>&nbsp;<a href="javascript: window.close()"><img src="imagens/fechar.jpg" alt="Clique aqui para fechar esta janela" width="52" height="22" border="0" ></a></div>

