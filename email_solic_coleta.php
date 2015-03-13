<html>
 <head>
  <title>Coletas WEBDevol!</title>
 </head>
 <body>
<?
	$html="Favor providenciar coletas abaixo com URGENCIA:";
	$Sql = "select a.CGCCPF, a.pessoa, a.nome, CLIEN_COL_DIAINI, CLIEN_COL_DIAFIM, date_format(CLIEN_COL_HRINI,'%H:%i') CLIEN_COL_HRINI, ";
	$Sql.= "       date_format(CLIEN_COL_HRFIM,'%H:%i') CLIEN_COL_HRFIM, ";
	$Sql.= "       CLIEN_COL_ENDER LOGRADOURO, CLIEN_COL_BAIRRO BAIRRO, CLIEN_COL_CIDADE NM_MUNICIPIO, CLIEN_COL_UF SG_UF, ";
	$Sql.= "       b.CLIEN_COL_FONE, c.PRENF_NUMNFDEVOLUCAO";
	$Sql.= "  from pessoa a, rar_cliente_coleta b, rar_prenf c ";
	$Sql.= " where b.CLIEN_COL_PESSOA = a.PESSOA ";
	$Sql.= "       and a.pessoa=c.prenf_pessoa_destinatario ";
	$Sql.= "       and c.prenf_numprenf in (".$_GET['Ids'].") ";
	$Sql.= " group by a.pessoa, a.nome";
    $group=mysql_query($Sql);
	while ($linha=mysql_fetch_array($group)){
	$html.="
---------------------------------------------------------------------------------------
CNPJ: $linha[CGCCPF]
$linha[nome] - $linha[pessoa]
$linha[LOGRADOURO]
$linha[BAIRRO] - $linha[NM_MUNICIPIO]/$linha[SG_UF]
$linha[CLIEN_COL_FONE]
Período para coleta: de ".DiaSemana($linha[CLIEN_COL_DIAINI])." à ".DiaSemana($linha[CLIEN_COL_DIAFIM])." das $linha[CLIEN_COL_HRINI] às $linha[CLIEN_COL_HRFIM]
Relação de notas fiscais:";
	$Sql = " select a.PRENF_NUMNFDEVOLUCAO, b.nome, a.PRENF_QTDEVOLUME, sum(PRENFI_QUANTIDADE) as PRENFI_QUANTIDADE ";
	$Sql.= " from rar_prenf a, pessoa b, rar_prenf_item ";
	$Sql.= " where a.PRENF_PESSOA_EMITENTE=b.PESSOA ";
	$Sql.= "       and prenf_numprenf = prenfi_numprenf ";
	$Sql.= "       and a.prenf_pessoa_destinatario = ".$linha[pessoa];
	$Sql.= "       and a.prenf_numprenf in (".$_GET['Ids'].")";
	$Sql.= " group by a.PRENF_NUMNFDEVOLUCAO, b.nome, a.PRENF_QTDEVOLUME ";
	$nf_s=mysql_query($Sql);
	while ($linha2=mysql_fetch_array($nf_s)){
		$Volume = intval($linha2[PRENF_QTDEVOLUME]);
		$Pares = intval($linha2[PRENFI_QUANTIDADE]);
		if($_GET['Categoria']==2){ 
			$html.="
NF$linha2[PRENF_NUMNFDEVOLUCAO] - $linha2[nome] - Qtde volumes: $Volume - Pares: $Pares";
		}else{
			$html.="
NF$linha2[PRENF_NUMNFDEVOLUCAO] - Qtde volumes: $Volume - Pares: $Pares";					   	
		}
	}
	
}

?>
</body>
</html>
