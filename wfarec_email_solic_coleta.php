<html>
 <head>
  <title>Coletas WEBDevol!</title>
 </head>
 <body>
<?
	$html="Favor providenciar coletas abaixo com URGENCIA:";
	$Sql = "select a.pessoa, a.nome, CLIEN_COL_ENDER LOGRADOURO, CLIEN_COL_BAIRRO BAIRRO, CLIEN_COL_CIDADE NM_MUNICIPIO, CLIEN_COL_UF SG_UF, b.CLIEN_COL_FONE, c.SPRNF_NF PRENF_NUMNFDEVOLUCAO";
	$Sql.= "  from pessoa a, rar_cliente_coleta b, rar_servico_nf_prod_dev c, rar_servico ";
	$Sql.= " where b.CLIEN_COL_PESSOA = a.PESSOA ";
	$Sql.= "       and a.pessoa = SERVI_PESSO_IDO ";
	$Sql.= "       and SERVI_NUMERO = SPRNF_SERVI_NUMERO ";
	$Sql.= "       and sprnf_ido in (".$_GET['Ids'].") ";
	$Sql.= " group by a.pessoa, a.nome";
    $group=mysql_query($Sql);
	while ($linha=mysql_fetch_array($group)){
	$html.="
---------------------------------------------------------------------------------------
$linha[nome]
$linha[LOGRADOURO]
$linha[BAIRRO] - $linha[NM_MUNICIPIO]/$linha[SG_UF]
$linha[CLIEN_COL_FONE]
Relação de notas fiscais:";
	$Sql = " select sprnf_nf, b.nome, sprnf_qtdevolume ";
	$Sql.= " from pessoa b, rar_servico_nf_prod_dev, rar_servico  ";
	$Sql.= " where SPRNF_PESSOA_DESTINATARIO =b.PESSOA ";
	$Sql.= "       and sprnf_servi_numero = servi_numero ";
	$Sql.= "       and servi_pesso_ido = ".$linha[pessoa];
	$Sql.= "       and sprnf_ido in (".$_GET['Ids'].")";
	$nf_s=mysql_query($Sql);
	while ($linha2=mysql_fetch_array($nf_s)){
		$Volume = intval($linha2[sprnf_qtdevolume]);
		$html.=" NF$linha2[sprnf_nf] - $linha2[nome] - Qtde volumes: $Volume";
	}
	
}

?>
</body>
</html>
